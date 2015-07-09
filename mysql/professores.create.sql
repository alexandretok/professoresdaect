DROP SCHEMA IF EXISTS professores CASCADE;
CREATE SCHEMA professores;
UPDATE pg_database SET encoding = pg_char_to_encoding('UTF8') where datname = 'professores';
SET SEARCH_PATH TO professores;

--
-- Table structure for table professores
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
-- Table structure for table disciplinas
--

DROP TABLE IF EXISTS disciplinas;
CREATE TABLE disciplinas (
  id SERIAL UNIQUE,
  departamento varchar(10) NOT NULL,
  materia integer NOT NULL,
  nome varchar(100) NOT NULL,
  PRIMARY KEY (departamento, materia)
);

INSERT INTO disciplinas VALUES (0, '-', 0, 'Não informado');

--
-- Table structure for table depoimentos
--

DROP TABLE IF EXISTS depoimentos;
CREATE TABLE depoimentos (
  id serial PRIMARY KEY,
  professor integer NOT NULL references professores(id),
  nome varchar(45) NOT NULL DEFAULT 'Anônimo',
  disciplina integer references disciplinas(id),
  depoimento text NOT NULL,
  aprovado integer NOT NULL DEFAULT '0',
  up integer NOT NULL DEFAULT '0',
  down integer NOT NULL DEFAULT '0'
);

ALTER SEQUENCE depoimentos_id_seq RESTART WITH 1348;

--
-- Table structure for table leciona 
--

DROP TABLE IF EXISTS leciona;
CREATE TABLE leciona (
  professor integer references professores(id),
  disciplina integer references disciplinas(id)
);

--
-- Table structure for table sugestoes
--

DROP TABLE IF EXISTS sugestoes;
CREATE TABLE sugestoes (
  id serial PRIMARY KEY,
  sugestao text NOT NULL
);

--
-- Table structure for table voto
--

DROP TABLE IF EXISTS votos;
CREATE TABLE votos (
  id serial PRIMARY KEY,
  professor integer NOT NULL references professores(id),
  voto smallint NOT NULL,
  ip varchar(45) NOT NULL
);

ALTER SEQUENCE votos_id_seq RESTART WITH 2822;
