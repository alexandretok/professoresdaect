from app.models import Professor, Depoimento, Voto, Leciona, Materia, Livro, MateriaELivro, Anuncio


def get_professores_by_name(name):
	return Professor.query.filter(Professor.nome.ilike("%"+name+"%")).all()


def get_most_relevant_depoimento(prof_id):
	return Depoimento.query.filter_by(professor=prof_id).order_by(Depoimento.up.desc(), Depoimento.down).first().depoimento


def get_professors_votes(prof_id):
    return Voto.query.filter_by(professor=prof_id).all()


def get_professors():
    return Professor.query.all()


def get_materias_name_by_id(mat_id):
    return Materia.query.filter_by(id=mat_id).first().nome


def get_professors_materias(prof_id):
    return Leciona.query.filter_by(professor=prof_id).all()


def get_professors_depoimentos(prof_id):
    return Depoimento.query.filter_by(professor=prof_id).order_by(Depoimento.up.desc(), Depoimento.down).all()
