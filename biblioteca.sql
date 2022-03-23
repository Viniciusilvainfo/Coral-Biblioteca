drop table alugar;
drop table livros;
drop table usuarios;

create table usuarios (
    email varchar(100) not null,
    nome varchar(100) not null,
    senha varchar(100) not null,
    primary key(email)
);

create table livros (
    id int auto_increment not null,
    autores varchar(100) not null,
    titulo varchar(100) not null,
    ano int(4) not null,
    editora varchar(100) not null,
    quantidade int(1) not null,
    primary key(id)
);

create table alugar (
    transacao int auto_increment not null,
    usuario varchar(100) not null,
    livro int not null,
    ativo char(3) null,
    foreign key (usuario) references usuarios(email),
    foreign key (livro) references livros(id),
    primary key(transacao)
);

insert into livros (autores,titulo, ano, editora, quantidade) values ('joao', 'pequeno principe', 2021, 'faber', 2), ('ana clara', 'matematica avancada', 2020, 'fabers', 1), ('bruno', 'aprendendo a ler', 2009, 'educacao', 3), ('thiago', 'harry potter', 2005, 'ficcoes', 1);