drop table paises cascade;
create table paises (
  id      bigserial constraint pk_paises primary key,
  nombre  varchar(30) not null constraint uq_paises_nombre_unico unique,
  bandera text
);

drop table peniculas cascade;
create table peniculas (
  id       bigserial    constraint pk_peniculas primary key,
  titulo   varchar(100) not null,
  ano      numeric(4),
  duracion numeric(3),
  sinopsis text,
  cartel   text,
  estreno  date,
  alta     date,
  dvd      date
);

insert into peniculas (titulo, cartel, estreno, dvd)
values ('La Gran Estafa', 'uploads/carteles/gran_estafa.jpg', current_date - 1, current_date + 20);
insert into peniculas (titulo, cartel, estreno, dvd)
values ('Ataque de los Tomates asesinos', 'uploads/carteles/ataque_tomates.jpg', current_date + 10, null);

create index idx_peniculas_titulo on peniculas (titulo);
create index idx_peniculas_ano on peniculas (ano);

drop table personas cascade;

create table personas (
  id     bigserial constraint pk_personas primary key,
  nombre varchar(100) not null constraint uq_personas_nombre_unico unique
);

drop table cargos cascade;
create table cargos (
  id     bigserial   constraint pk_cargos primary key,
  nombre varchar(50) not null constraint uq_cargos_nombre_unico unique
);

drop table participan cascade;
create table participan (
  id           bigserial constraint pk_participan primary key,
  id_peniculas bigint    not null constraint fk_participan_peniculas
                         references peniculas (id) on update cascade 
                         on delete cascade,
  id_personas  bigint    not null constraint fk_participan_personas
                         references personas (id) on update cascade
                         on delete cascade,
  id_cargos    bigint    not null constraint fk_participan_cargos
                         references cargos (id) on update cascade 
                         on delete no action
);

drop table generos cascade;
create table generos (
  id     bigserial   constraint pk_generos primary key,
  nombre varchar(50) not null constraint uq_generos_nombre_unico unique
  );


drop table comentarios cascade;
create table comentarios (
  id           bigserial   constraint pk_comentarios primary key,
  critica      text,
  id_usuarios  bigint      not null constraint fk_comentarios_usuarios
                           references usuarios (id) on update cascade
                           on delete cascade,
  id_peniculas bigint      not null constraint fk_comentarios_peniculas
                           references peniculas (id) on update cascade
                           on delete cascade
);

drop table generos_peniculas cascade;
create table generos_peniculas(
  id_peniculas bigint constraint fk_generos_peniculas_peniculas
                      references peniculas (id) on update cascade
                      on delete cascade,
  id_generos bigint   constraint fk_generos_peniculas_generos
                      references generos (id)on update cascade
                      on delete cascade,
  constraint pk_generos_peniculas primary key (id_peniculas, id_generos)
);

drop table paises_peniculas cascade;
create table paises_peniculas(
  id_paises      bigint constraint fk_paises_peniculas_paises
                      references paises (id) on update cascade
                      on delete no action,
  id_peniculas bigint constraint fk_paises_peniculas_peniculas
                      references peniculas (id) on update cascade
                      on delete cascade,
  constraint pk_paises_peniculas primary key (id_paises, id_peniculas)
);
drop table usuarios cascade;

create table usuarios (
  id       bigserial   constraint pk_usuarios primary key,
  usuario  varchar(15) not null constraint uq_usuarios_usuario unique,
  password char(32)    not null
);


/************************************VISTAS*****************************************/

create view generos_de_penicula as
  select * from generos g join generos_peniculas p 
           on g.id = p.id_generos;

create view paises_de_penicula as
  select * from paises p join paises_peniculas pp 
           on p.id = pp.id_paises;

create view actores
  select * from personas per join participan par
           on per.id = par.id_personas join cargos car
           on par.id_cargos = car.id
           where car.nombre = 'actor';

create view directores
  select * from personas per join participan par
           on per.id = par.id_personas join cargos car
           on par.id_cargos = car.id
           where car.nombre = 'director';

/************************************INSERTS*****************************************/


INSERT INTO cargos (id,nombre) VALUES (1,'director');
INSERT INTO cargos (id,nombre) VALUES (2,'actor');

INSERT INTO generos (id,nombre) VALUES (1,'Suspense');
INSERT INTO generos (id,nombre) VALUES (2,'Comedia');
INSERT INTO generos (id,nombre) VALUES (3,'Ciencia Ficción');
INSERT INTO generos (id,nombre) VALUES (4,'Drama');

INSERT INTO paises (id,nombre,bandera) VALUES (1,'Espein','espein.gif');
INSERT INTO paises (id,nombre,bandera) VALUES (2,'Freinch','freinch.gif');
INSERT INTO paises (id,nombre,bandera) VALUES (3,'Jinlang','jinlang.gif');
INSERT INTO paises (id,nombre,bandera) VALUES (4,'Iuesei','iuesei.gif');

INSERT INTO personas (id,nombre) VALUES (1,"George Lucas");
INSERT INTO personas (id,nombre) VALUES (2,"Liam Neeson");
INSERT INTO personas (id,nombre) VALUES (3,"Ewan McGregor");
INSERT INTO personas (id,nombre) VALUES (4,"Natalie Portman");
INSERT INTO personas (id,nombre) VALUES (5,"Charles Chaplin");

INSERT INTO peniculas (id, titulo, ano, duracion, cartel, estreno, alta, sinopsis)
  VALUES(1,'Tiempos modernos',1936, '89 mins.','uploads/carteles/modernos.jpg',1936,current_date,
         'Extenuado por el frenético ritmo de la cadena de montaje, un obrero metalúrgico acaba perdiendo la razón.');
INSERT INTO peniculas (id, titulo, ano, duracion, cartel, estreno, alta, sinopsis)
  VALUES(2,'La guerra de las galaxias. Episodio I: La amenaza fantasma',1999,'131 mins.','uploads/carteles/galaxias.jpg',1999,current_date
         'La infancia de Darth Vader, el pasado de Obi-Wan Kenobi y el resurgimiento de los Sith y los caballeros Jedi dominados por el Lado Oscuro');

insert into peniculas (id, titulo, cartel, estreno, dvd)
  values (3,'La Gran Estafa', 'uploads/carteles/gran_estafa.jpg', current_date - 1, current_date + 20);
insert into peniculas (titulo, cartel, estreno, dvd)
  values (4,'Ataque de los Tomates asesinos', 'uploads/carteles/ataque_tomates.jpg', current_date + 10, null);

INSERT INTO participan (id,id_peniculas,id_personas,id_cargos)
       VALUES (1,1,5,1);
INSERT INTO participan (id,id_peniculas,id_personas,id_cargos)
       VALUES (2,1,5,2);
INSERT INTO participan (id,id_peniculas,id_personas,id_cargos)
       VALUES (3,2,1,1);
INSERT INTO participan (id,id_peniculas,id_personas,id_cargos)
       VALUES (4,2,2,2);
INSERT INTO participan (id,id_peniculas,id_personas,id_cargos)
       VALUES (4,2,3,2);
INSERT INTO participan (id,id_peniculas,id_personas,id_cargos)
       VALUES (4,2,4,2);

INSERT INTO generos_peniculas(id_peniculas, id_generos)
       VALUES(1,2);
INSERT INTO generos_peniculas(id_peniculas, id_generos)
       VALUES(2,1);
INSERT INTO generos_peniculas(id_peniculas, id_generos)
       VALUES(2,3);
INSERT INTO generos_peniculas(id_peniculas, id_generos)
       VALUES(2,4);


INSERT INTO paises_peniculas(id_peniculas,id_paises)
       VALUES(1,1);
INSERT INTO paises_peniculas(id_peniculas,id_paises)
       VALUES(1,3);
INSERT INTO paises_peniculas(id_peniculas,id_paises)
       VALUES(2,2);
INSERT INTO paises_peniculas(id_peniculas,id_paises)
       VALUES(2,4);
