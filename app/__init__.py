from flask import Flask
#from . import models

#class CustomFlask(Flask):
#    jinja_options = Flask.jinja_options.copy()
#    jinja_options['autoescape']=False

#app = CustomFlask(__name__)
app = Flask(__name__)

from app import index
