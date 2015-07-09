#!/usr/bin/python
# -*- coding: utf-8 -*-
from app import app
from flask.ext.session import Session

if __name__ == "__main__":
	
	app.config['SESSION_TYPE'] = 'filesystem'
	app.config['SECRET_KEY'] = 'key'

	sess = Session()

	sess.init_app(app)
	app.debug = True
	#app.run(host="0.0.0.0", port=80, debug=True)
	app.run()
