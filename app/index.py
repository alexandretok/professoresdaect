from app import app
from app.database import db
from app.models import Professor, Depoimento, Voto, Leciona, Disciplina 
from sqlalchemy import func
from flask import request, session
import flask as f
import os

def mk_int(s):
	s = s.strip()
	return int(s) if s else 0

@app.teardown_appcontext
def shutdown_session(exception=None):
    db.remove()

@app.errorhandler(404)
def page_not_found(e):
    return f.render_template('404.html'), 404

@app.errorhandler(405)
def page_not_found(e):
    return f.render_template('404.html'), 404


@app.route("/")
def index():
	return f.render_template('index.html')

@app.route("/professor/pesquisa/search/<nome>")
def prof_pesquisa(nome):
	professores = []
	DEPOIMENTO_MAX = 200
	for prof in Professor.query.filter(Professor.nome.ilike("%"+nome+"%")).all():
		depoimentoMaisRelevante = Depoimento.query.filter_by(professor=prof.id).order_by(Depoimento.up.desc(),Depoimento.down).first().depoimento
		tamanhoDoDepoimento = len(depoimentoMaisRelevante)
		depoimentoMaisRelevante = depoimentoMaisRelevante[:DEPOIMENTO_MAX]
		votos = [v.voto for v in Voto.query.filter_by(professor=prof.id).all()]
		try:
			media = sum(votos)/len(votos)
		except ZeroDivisionError:
			media = 0
		professores.append({
			'nome': prof.nome, 
			'foto': prof.foto,
			'depoimento': depoimentoMaisRelevante, 
			'tamanho_do_depoimento': tamanhoDoDepoimento,
			'mediaVotos': media, 
			'friendlyUrl': prof.getUrlFriendlyName() 
		})
	return f.render_template('professor/pesquisa.html', professores=professores, depoimento_max=DEPOIMENTO_MAX)

@app.route("/professor/<nome>")
def prof_info(nome):
	for prof in Professor.query.all():
		if prof.getUrlFriendlyName() == nome:
			break	
	votos = [v.voto for v in Voto.query.filter_by(professor=prof.id).all()]
	leciona = [{'nome' : Disciplina.query.filter_by(id=leciona.disciplina).first().nome, 'id' : leciona.disciplina } for leciona in Leciona.query.filter_by(professor=prof.id).all()]
	try: 
		media = sum(votos)/len(votos)
	except ZeroDivisionError:
		media = 0
	depoimentos = [ d for d in Depoimento.query.filter_by(professor=prof.id).order_by(Depoimento.up.desc(),Depoimento.down).all() ]
 
	professor = {
		'id' : prof.id,
		'url' : nome,
		'nome' : prof.nome,
		'foto' : prof.foto,
		'votos' : len(votos),
		'media' : media,
		'leciona' : leciona, 
		'depoimentos' : depoimentos
	}
	return f.render_template('professor/view.html', professor=professor) 

@app.route("/disciplina/pesquisa/search/<nome>")
def disc_pesquisa(nome):
	disciplinas = '' 
	for disc in Disciplina.query.filter(Disciplina.nome.ilike("%"+nome+"%")).all():
		disciplinas += '{ "label" : "'+disc.departamento+str(disc.materia)+' - '+disc.nome+'", "id" : "'+str(disc.id)+'"},'
	disciplinas= '['+disciplinas[:-1]+']' 
	return disciplinas

@app.route("/disciplina/professores/<id>")
def disc_info(id):
	professores = []
	lecionam = Leciona.query.filter_by(disciplina=id).all()
	DEPOIMENTO_MAX = 200
	for leciona in lecionam:
		prof = Professor.query.filter_by(id=leciona.professor).first()
		try:	
			depoimentoMaisRelevante = Depoimento.query.filter_by(professor=prof.id).order_by(Depoimento.up.desc(),Depoimento.down).first().depoimento
		except AttributeError as e:
			depoimentoMaisRelevante = ''
		tamanhoDoDepoimento = len(depoimentoMaisRelevante)
		depoimentoMaisRelevante = depoimentoMaisRelevante[:DEPOIMENTO_MAX]
		votos = [v.voto for v in Voto.query.filter_by(professor=prof.id).all()]
		try:	
			media = sum(votos)/len(votos)
		except ZeroDivisionError:
			media = 0
		professores.append({
			'nome': prof.nome, 
			'foto': prof.foto,
			'depoimento': depoimentoMaisRelevante, 
			'tamanho_do_depoimento': tamanhoDoDepoimento,
			'mediaVotos': media, 
			'friendlyUrl': prof.getUrlFriendlyName() 
		})
	professores = sorted(professores, key=lambda k: -k['mediaVotos'])
	return f.render_template('professor/pesquisa.html', professores=professores, depoimento_max=DEPOIMENTO_MAX)

@app.route("/depoimento/novo", methods=['POST'])
def depoimento_novo():
	if request.form['url'] is not None:
		dep = Depoimento(professor=mk_int(request.form['id_professor']), nome=request.form['nome'], depoimento=request.form['depoimento'], disciplina=mk_int(request.form['id_disciplina']))	
		db.add(dep)
		db.commit()
		return f.redirect('/professor/'+request.form['url'], code=303) 
	else:
		return f.render_template('404.html'), 404
	
@app.route("/voto/computar", methods=['POST'])
def computar_voto():
	if request.form['nota'] is not None:
		if session.get(request.form['id_professor']) is not None:
			return 'PROIBIDO'
		vot = Voto(professor=request.form['id_professor'], voto=request.form['nota'], ip=request.headers.get("X-Real-IP"))
		session[request.form['id_professor']] = True
		db.add(vot)
		db.commit()
		return 'OK'
	else:
		return f.render_template('404.html'), 404

@app.route("/depoimento/naogostei/", methods=['POST'])
def depoimento_naogostei():
	if request.form['id_depoimento']:
		if session.get(request.form['id_depoimento']) is not None:
			return 'FAIL'
		Depoimento.query.filter_by(id=request.form['id_depoimento']).first().down+=1
		db.commit()
		return 'OK'
	else:
		return f.render_template('404.html'), 404
@app.route("/depoimento/gostei/", methods=['POST'])
def depoimento_gostei():
	if request.form['id_depoimento']:
		if session.get(request.form['id_depoimento']) is not None:
			return 'FAIL'
		Depoimento.query.filter_by(id=request.form['id_depoimento']).first().up+=1
		db.commit()
		return 'OK'
	else:
		return f.render_template('404.html'), 404

