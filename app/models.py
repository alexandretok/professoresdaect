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

class Materia(Base):
    __tablename__ = 'materias'

    id = Column(Integer, Sequence('materias_id_seq',quote=False,metadata=meta))
    departamento = Column(String(10), primary_key=True)
    codigo = Column(Integer, primary_key=True)
    nome = Column(Unicode(100))

    def __repr__(self):
        return self.departamento.encode('utf-8')+str(self.codigo)+" - "+self.nome.encode('utf-8')

    def getUrlFriendlyName(self):
        return unidecode(self.nome).replace(" ", "-").lower()

class Depoimento(Base):
    __tablename__ = 'depoimentos'

    id = Column(Integer, Sequence('depoimentos_id_seq',quote=False,metadata=meta), primary_key=True)
    professor = Column(Integer, ForeignKey('professores.id'))
    nome = Column(Unicode(45),default=u'Anônimo')
    materia = Column(Integer, ForeignKey('materias.id'))
    depoimento = Column(Unicode)
    aprovado = Column(Integer, default=0)
    up = Column(Integer, default=0)
    down = Column(Integer, default=0)

    def __repr__(self):
        return "<Depoimento " +self.depoimento.encode('utf-8')+">"

class Leciona(Base):
    __tablename__ = 'leciona'

    professor = Column(Integer, ForeignKey('professores.id'), primary_key=True)
    materia = Column(Integer, ForeignKey('materias.id'), primary_key=True)

    def __repr__(self):
        return "<Professor " +str(self.professor)+" leciona "+str(self.materia)+">"

class Voto(Base):
    __tablename__ = 'votos'

    id = Column(Integer, Sequence('votos_id_seq',quote=False,metadata=meta), primary_key=True)
    professor = Column(Integer, ForeignKey('professores.id'))
    voto = Column(Integer)
    ip = Column(String(45))

    def __repr__(self):
        return "<Voto " +self.voto+">"

class Livro(Base):
    __tablename__ = 'livros'

    id = Column(Integer, Sequence('livros_id_seq',quote=False,metadata=meta), primary_key=True)
    titulo = Column(String(100))
    autor = Column(String(100))
    isbn = Column(Integer)

    def __repr__(self):
        return "<Livro " +self.titulo+">"

class MateriaELivro(Base):
    __tablename__ = 'materias_e_livros'

    materia = Column(Integer, ForeignKey('materias.id'), primary_key=True)
    livro = Column(Integer, ForeignKey('livros.id'), primary_key=True)

    def __repr__(self):
        return "<Livro de ID " +self.livro+" usado na materia de ID "+self.materia+">"

class Anuncio(Base):
    __tablename__ = 'anuncios'

    id = Column(Integer, Sequence('anuncios_id_seq',quote=False,metadata=meta), primary_key=True)
    livro = Column(Integer, ForeignKey('livros.id'))
    anunciante = Column(String(100))
    anuncio = Column(String(300))
    capa = Column(String(100))


    def __repr__(self):
        return "<"+self.autor+" anunciou o livro de id "+self.livro+" com a seguinte mensagem: "+anuncio+">"
