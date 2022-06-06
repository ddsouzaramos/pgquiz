create database pgquiz;

create table perguntas
(
    id_pergunta serial not null primary key,
    descricao varchar(max)
);

create table respostas
(
    id_resposta serial not null primary key,
    id_pergunta integer not null,
    descricao varchar(max),
    alternativa_correta boolean not null
);