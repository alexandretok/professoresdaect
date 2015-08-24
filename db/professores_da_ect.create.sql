DROP SCHEMA IF EXISTS professores_da_ect CASCADE;
CREATE SCHEMA professores_da_ect;
UPDATE pg_database SET encoding = pg_char_to_encoding('UTF8') where datname = 'professores_da_ect';
SET SEARCH_PATH TO professores_da_ect;

--
-- Estrutura para a tabela professores
--

DROP TABLE IF EXISTS professores;
CREATE TABLE professores (
  id serial PRIMARY KEY,
  nome varchar(100) NOT NULL,
  aprovado integer NOT NULL DEFAULT '0',
  foto varchar(100) DEFAULT NULL
);

ALTER SEQUENCE professores_id_seq RESTART WITH 125;

--
-- Estrutura para a tabela materias
--

DROP TABLE IF EXISTS materias;
CREATE TABLE materias (
  id SERIAL UNIQUE,
  departamento varchar(10) NOT NULL,
  codigo integer NOT NULL,
  nome varchar(100) NOT NULL,
  PRIMARY KEY (departamento, codigo)
);

INSERT INTO materias VALUES (0, '-', 0, 'Não informado');

--
-- Estrutura para a tabela depoimentos
--

DROP TABLE IF EXISTS depoimentos;
CREATE TABLE depoimentos (
  id serial PRIMARY KEY,
  professor integer NOT NULL references professores(id),
  nome varchar(45) NOT NULL DEFAULT 'Anônimo',
  materia integer references materias(id),
  depoimento text NOT NULL,
  aprovado integer NOT NULL DEFAULT '0',
  up integer NOT NULL DEFAULT '0',
  down integer NOT NULL DEFAULT '0'
);

ALTER SEQUENCE depoimentos_id_seq RESTART WITH 1348;

--
-- Estrutura para a tabela leciona 
--

DROP TABLE IF EXISTS leciona;
CREATE TABLE leciona (
  professor integer references professores(id),
  materia integer references materias(id)
);

--
-- Estrutura para a tabela sugestoes
--

DROP TABLE IF EXISTS sugestoes;
CREATE TABLE sugestoes (
  id serial PRIMARY KEY,
  sugestao text NOT NULL
);

--
-- Estrutura para a tabela voto
--

DROP TABLE IF EXISTS votos;
CREATE TABLE votos (
  id serial PRIMARY KEY,
  professor integer NOT NULL references professores(id),
  voto smallint NOT NULL,
  ip varchar(45) NOT NULL
);

ALTER SEQUENCE votos_id_seq RESTART WITH 2822;


--
-- Estrutura para a tabela livros 
--

DROP TABLE IF EXISTS livros;
CREATE TABLE livros (
  id serial PRIMARY KEY,
  titulo varchar(100) NOT NULL,
  autor varchar(100) NOT NULL,
  isbn integer NOT NULL DEFAULT '0'
);

--
-- Estrutura para a tabela materias_e_livros 
--

DROP TABLE IF EXISTS materias_e_livros;
CREATE TABLE materias_e_livros (
  materia integer NOT NULL references materias(id),
  livro integer NOT NULL references livros(id)
);

--
-- Estrutura para a tabela anuncios 
--

DROP TABLE IF EXISTS anuncios;
CREATE TABLE anuncios (
  id serial PRIMARY KEY,
  livro integer NOT NULL references livros(id),
  anunciante varchar(100) NOT NULL,
  anuncio varchar(300) NOT NULL,
  capa varchar(100) DEFAULT NULL

);

