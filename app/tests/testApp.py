import flask as f
from jinja2 import Environment, PackageLoader
import unittest
import TestRunner
from app import app

class TestAppRoutes(unittest.TestCase):
    app.config['TESTING'] = True
    env = Environment(loader=PackageLoader('app', 'templates'))

    @staticmethod
    def render_template(template, **kwargs):
        return TestStringMethods.env.get_template(template).render(**kwargs)


    @staticmethod
    def get_test_client():
        test_app = app.test_client()
        test_app._get = test_app.get
        def get(*args, **kwargs):
            response = test_app._get(*args, **kwargs)
            response.value = response.get_data(as_text=True)
            return response
        test_app.get = get
        return test_app

    def setUp(self):
        self.app = self.get_test_client()
        #self.app = app.test_client()

    def test_index(self):
        response = self.app.get('/')
        self.assertEqual(response.value, self.render_template('index.html'))


    def test_isupper(self):
        self.assertTrue('FOO'.isupper())
        self.assertTrue('Foo'.isupper())

    def test_split(self):
        s = 'hello world'
        self.assertEqual(s.split(), ['hello', 'world'])
        # check that s.split fails when the separator is not a string
        with self.assertRaises(TypeError):
            s.split(2)

if __name__ == '__main__':
    TestRunner.main()
    #unittest.main()
