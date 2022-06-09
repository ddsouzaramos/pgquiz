create extension if not exists "uuid-ossp";

create table public.usuarios
(
    id_usuario uuid default uuid_generate_v4(),
    email varchar(80),
    nomecompleto varchar(100),
    senha varchar(32),
    primary key (id_usuario),
    constraint uk_usuarios unique (email)
);

create table public.perguntas
(
    id_pergunta uuid default uuid_generate_v4(),
    descricao varchar(1000),
    primary key (id_pergunta)
);

create table public.respostas
(
    id_resposta uuid default uuid_generate_v4(),
    id_pergunta uuid not null,
    descricao varchar(1000),
    correta boolean not null,
    ordem smallint not null,
    primary key (id_resposta),
    foreign key (id_pergunta) references public.perguntas (id_pergunta) on delete cascade
);

create table public.ranking
(
    nome varchar(100) not null,
    pontos smallint not null,
    primary key (nome)
);

insert into public.usuarios (email, nomecompleto, senha) values ('admin@admin.com.br', 'Administrador', md5('123456'))