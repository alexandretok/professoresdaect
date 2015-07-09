# -*- coding: utf-8 -*-
from sqlalchemy import create_engine, MetaData
from sqlalchemy.orm import scoped_session, sessionmaker
from sqlalchemy.ext.declarative import declarative_base

engine = create_engine('postgresql://postgres:postgres@localhost/webapp', convert_unicode=True )
db = scoped_session(sessionmaker(autocommit=False,
                                         autoflush=False,
                                         bind=engine))
meta = MetaData(schema="professores")
Base = declarative_base(metadata=meta)
Base.query = db.query_property()

def init_db():
    # import all modules here that might define models so that
    # they will be registered properly on the metadata.  Otherwise
    # you will have to import them first before calling init_db()
    import app.models
    Base.metadata.create_all(bind=engine)
