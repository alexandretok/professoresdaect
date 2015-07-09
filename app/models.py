# -*- coding: utf-8 -*-
from sqlalchemy import Column, Integer, String, Unicode, ForeignKey, Sequence
from app.database import Base, meta
from unidecode import unidecode

class Professor(Base):
    __tablename__ = 'professores'

    id = Column(Integer, Sequence('professores_id_seq',quote=False,metadata=meta), primary_key=True)
    nome = Column(Unicode(100))
    aprovado = Column(Integer, default=0)
    foto = Column(String(100))

    def __repr__(self):
	return "<Professor " +self.nome.encode('utf-8')+">"

    def getUrlFriendlyName(self):
    	return unidecode(self.nome).replace(" ", "-").lower()

class Disciplina(Base):
    __tablename__ = 'disciplinas'

    id = Column(Integer, Sequence('disciplinas_id_seq',quote=False,metadata=meta))
    departamento = Column(String(10), primary_key=True)
    materia = Column(Integer, primary_key=True)
    nome = Column(Unicode(100))

    def __repr__(self):
	return "<Disciplina " +self.nome.encode('utf-8')+">"

    def getUrlFriendlyName(self):
    	return unidecode(self.nome).replace(" ", "-").lower()


class Depoimento(Base):
    __tablename__ = 'depoimentos'

    id = Column(Integer, Sequence('depoimentos_id_seq',quote=False,metadata=meta), primary_key=True)
    professor = Column(Integer, ForeignKey('professores.id'))
    nome = Column(Unicode(45),default=u'Anônimo')
    disciplina = Column(Integer, ForeignKey('disciplinas.id'))
    depoimento = Column(Unicode)
    aprovado = Column(Integer, default=0)
    up = Column(Integer, default=0)
    down = Column(Integer, default=0)

    def __repr__(self):
	return "<Depoimento " +self.depoimento.encode('utf-8')+">"

class Leciona(Base):
    __tablename__ = 'leciona'

    professor = Column(Integer, ForeignKey('professores.id'), primary_key=True)
    disciplina = Column(Integer, ForeignKey('disciplinas.id'), primary_key=True)

    def __repr__(self):
	return "<Professor " +str(self.professor)+" leciona "+str(self.disciplina)+">"

class Voto(Base):
    __tablename__ = 'votos'

    id = Column(Integer, Sequence('votos_id_seq',quote=False,metadata=meta), primary_key=True)
    professor = Column(Integer, ForeignKey('professores.id'))
    voto = Column(Integer)
    ip = Column(String(45))

    def __repr__(self):
	return "<Voto " +self.voto+">"
