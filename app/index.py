from app import app
from app import storage
from flask import request, session
import flask as f
import os


def mk_int(s):
    s = s.strip()
    return int(s) if s else 0


@app.teardown_appcontext
def shutdown_session(exception=None):
    storage.drop_connection()


@app.errorhandler(404)
def page_not_found(e):
    return f.render_template('404.html'), 404


@app.errorhandler(405)
def page_not_found(e):
    return f.render_template('404.html'), 404


@app.route("/")
def index():
    return f.render_template('index.html')


@app.route("/professor/pesquisa/<nome>")
def prof_pesquisa(nome):
    professores = []
    DEPOIMENTO_MAX = 200
    for prof in storage.get_professores_by_name(nome):
        depoimentoMaisRelevante = storage.get_most_relevant_depoimento(prof.id)
        tamanhoDoDepoimento = len(depoimentoMaisRelevante)
        depoimentoMaisRelevante = depoimentoMaisRelevante[:DEPOIMENTO_MAX]
        votos = [v.voto for v in storage.get_professors_votes(prof.id)]
        try:
            media = int(sum(votos)/len(votos))
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
    return f.render_template('professor/pesquisa.html',
                             professores=professores,
                             depoimento_max=DEPOIMENTO_MAX
                             )


@app.route("/professor/<nome>")
def prof_info(nome):
    for prof in storage.get_professors():
        if prof.getUrlFriendlyName() == nome:
            break
    votos = [v.voto for v in storage.get_professors_votes(prof.id)]
    leciona = [
                {
                    'nome': storage.get_materias_name_by_id(leciona.materia),
                    'id': leciona.materia
                } for leciona in storage.get_professors_materias(prof.id)
              ]
    try:
        media = int(sum(votos)/len(votos))
    except ZeroDivisionError:
        media = 0
    depoimentos = [d for d in storage.get_professors_depoimentos(prof.id)]

    professor = {
        'id': prof.id,
        'url': nome,
        'nome': prof.nome,
        'foto': prof.foto,
        'votos': len(votos),
        'media': media,
        'leciona': leciona,
        'depoimentos': depoimentos
    }
    return f.render_template('professor/view.html', professor=professor)


@app.route("/materia/pesquisa/<nome>")
def matr_pesquisa(nome):
    materias = ''
    for matr in storage.get_materias(nome):
        materias += '{"label": "'+str(matr)+'", "id": "'+str(matr.id)+'"},'
    materias = '['+materias[:-1]+']'
    return materias


@app.route("/materia/professores/<id>")
def matr_info(id):
    professores = []
    lecionam = storage.get_professors_by_materia(id)
    DEPOIMENTO_MAX = 200
    for leciona in lecionam:
        prof = storage.get_professor_by_id(leciona.professor)
        depoimentoMaisRelevante = storage.get_most_relevant_depoimento(prof.id)
        tamanhoDoDepoimento = len(depoimentoMaisRelevante)
        depoimentoMaisRelevante = depoimentoMaisRelevante[:DEPOIMENTO_MAX]
        media = storage.get_voto_average(prof.id)
        professores.append({
            'nome': prof.nome,
            'foto': prof.foto,
            'depoimento': depoimentoMaisRelevante,
            'tamanho_do_depoimento': tamanhoDoDepoimento,
            'mediaVotos': media,
            'friendlyUrl': prof.getUrlFriendlyName()
        })
    professores = sorted(professores, key=lambda k: -k['mediaVotos'])
    return f.render_template('professor/pesquisa.html',
                             professores=professores,
                             depoimento_max=DEPOIMENTO_MAX
                             )


@app.route("/depoimento/novo", methods=['POST'])
def depoimento_novo():
    if request.form['url'] is not None:
        # Bad Request is a KeyError
        # TODO: Fix this error
        # try:
        #    print request.form
        # dep_info = (
        #             mk_int(request.form['id_professor']),
        #             request.form['nome'],
        #             request.form['depoimento'],
        #             mk_int(request.form['id_materia'])
        #             )
        # except KeyError as e:
        #    print e.message
        storage.add_depoimento(
                                mk_int(request.form['id_professor']),
                                request.form['nome'],
                                request.form['depoimento'],
                                mk_int(request.form['id_materia'])
                               )
        return f.redirect('/professor/'+request.form['url'], code=303)
    else:
        return f.render_template('404.html'), 404


@app.route("/voto/computar/", methods=['POST'])
def computar_voto():
    if request.form['nota'] is not None:
        if session.get(request.form['id_professor']) is not None:
            return 'PROIBIDO'
        storage.add_voto(
                            professor=request.form['id_professor'],
                            voto=request.form['nota'],
                            ip=request.headers.get("X-Real-IP")
                        )
        session[request.form['id_professor']] = True
        return 'OK'
    else:
        return f.render_template('404.html'), 404


@app.route("/depoimento/naogostei/", methods=['POST'])
def depoimento_naogostei():
    if request.form['id_depoimento']:
        if session.get(request.form['id_depoimento']) is not None:
            return 'FAIL'
        storage.voto_downvote(request.form['id_depoimento'])
        return 'OK'
    else:
        return f.render_template('404.html'), 404


@app.route("/depoimento/gostei/", methods=['POST'])
def depoimento_gostei():
    if request.form['id_depoimento']:
        if session.get(request.form['id_depoimento']) is not None:
            return 'FAIL'
        storage.voto_upvote(request.form['id_depoimento'])
        return 'OK'
    else:
        return f.render_template('404.html'), 404


@app.route("/livro/pesquisa/<nome>")
def livro_pesquisa(nome):
    anuncios = []
    for livr in storage.get_livros_by_name(nome):
        materia = storage.get_books_courses(livr.id)
        for anunc in storage.get_anuncios_by_livro(livr.id):
            anuncios.append({
                'titulo': livr.titulo,
                'autor': livr.autor,
                'isbn': livr.isbn,
                'materia': str(materia),
                'anunciante': anunc.anunciante,
                'anuncio': anunc.anuncio,
                'capa': anunc.capa
            })
    return f.render_template('livro/pesquisa.html', anuncios=anuncios)


@app.route("/livro/<nome>")
def livro_info(nome):
    for prof in storage.get_professors():
        if prof.getUrlFriendlyName() == nome:
            break
    votos = [v.voto for v in storage.get_professors_votes(prof.id)]
    leciona = [
                {
                    'nome': storage.get_materias_name_by_id(leciona.materia),
                    'id': leciona.materia
                } for leciona in storage.get_professors_materias(prof.id)
              ]
    try:
        media = int(sum(votos)/len(votos))
    except ZeroDivisionError:
        media = 0
    depoimentos = [d for d in storage.get_professors_depoimentos(prof.id)]

    professor = {
        'id': prof.id,
        'url': nome,
        'nome': prof.nome,
        'foto': prof.foto,
        'votos': len(votos),
        'media': media,
        'leciona': leciona,
        'depoimentos': depoimentos
    }
    return f.render_template('professor/view.html', professor=professor)


@app.route("/livro/anunciar")
def livro_anunc():
    return f.render_template('livro/anunciar.html')
