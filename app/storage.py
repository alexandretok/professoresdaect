from app.models import Professor, Depoimento, Voto, Leciona, Materia, Livro,\
    MateriaELivro, Anuncio
from app.database import db


def drop_connection():
    db.remove()


def get_professores_by_name(name):
    return Professor.query.filter(Professor.nome.ilike("%"+name+"%")).all()


def get_professors_depoimentos(prof_id):
    return Depoimento.query.filter_by(professor=prof_id).order_by(
                Depoimento.up.desc(), Depoimento.down
            ).all()


def get_most_relevant_depoimento(prof_id):
    return Depoimento.query.filter_by(professor=prof_id).order_by(
                    Depoimento.up.desc(), Depoimento.down
                ).first().depoimento


def get_professors_votes(prof_id):
    return Voto.query.filter_by(professor=prof_id).all()


def get_professors():
    return Professor.query.all()


def get_materias_name_by_id(mat_id):
    return Materia.query.filter_by(id=mat_id).first().nome


def get_professors_materias(prof_id):
    return Leciona.query.filter_by(professor=prof_id).all()


def get_materias(nome):
    return Materia.query.filter(Materia.nome.ilike("%"+nome+"%")).all()


def get_professors_by_materia(id):
    return Leciona.query.filter_by(materia=id).all()


def get_professor_by_id(id):
    return Professor.query.filter_by(id=id).first()


def get_most_relevant_depoimento(prof_id):
    try:
        return Depoimento.query.filter_by(professor=prof_id).order_by(
                    Depoimento.up.desc(), Depoimento.down
                ).first().depoimento
    except AttributeError:
        return ''


def get_voto_average(prof_id):
    votos = [v.voto for v in Voto.query.filter_by(professor=prof_id).all()]
    try:
        return int(sum(votos)/len(votos))
    except ZeroDivisionError:
        return 0


def add_depoimento(professor, nome, depoimento, materia):
    dep = Depoimento(professor=professor, nome=nome, depoimento=depoimento,
                     materia=materia
                     )
    db.add(dep)
    db.commit()


def add_voto(professor, voto, ip):
    db.add(Voto(professor=professor, voto=voto, ip=ip))
    db.commit()


def voto_downvote(depoimento):
    Depoimento.query.filter_by(id=depoimento).first().down += 1
    db.commit()


def voto_upvote(depoimento):
    Depoimento.query.filter_by(id=depoimento).first().up += 1
    db.commit()


def get_livros_by_name(name):
    return Livro.query.filter(Livro.titulo.ilike("%"+name+"%")).all()


def get_books_courses(livro):
    # First? Um livro pode ser adotado por mais de uma matéria
    # TODO: refazer a lógica para o caso de mais de uma matéria,
    # considerar uma lista de matérias instead?
    return MateriaELivro.query.join(
                                    Materia,
                                    Materia.id == MateriaELivro.materia
                                    ).filter_by(livro=livro).first()


def get_anuncios_by_livro(livro):
    return Anuncio.query.filter_by(livro=livro).all()
