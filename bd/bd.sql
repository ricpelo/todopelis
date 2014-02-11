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
  alta     date   default(CURRENT_DATE),
  dvd      date
);

create index idx_peniculas_titulo on peniculas (titulo);
create index idx_peniculas_ano on peniculas (ano);

drop table personas cascade;

create table personas (
  id     bigserial constraint pk_personas primary key,
  nombre varchar(100) not null,
  ano    numeric(4)
);

drop table cargos cascade;
create table cargos (
  id     bigserial   constraint pk_cargos primary key,
  nombre varchar(50) not null constraint uq_cargos_nombre_unico unique
);

drop table participan cascade;
create table participan ( 
  id_peniculas bigint    not null constraint fk_participan_peniculas
                         references peniculas (id) on update cascade 
                         on delete cascade,
  id_personas  bigint    not null constraint fk_participan_personas
                         references personas (id) on update cascade
                         on delete cascade,
  id_cargos    bigint    not null constraint fk_participan_cargos
                         references cargos (id) on update cascade 
                         on delete no action,
  constraint pk_participan primary key (id_peniculas, id_personas, id_cargos)
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
create table paises_peniculas (
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
  password char(32)    not null,
  email    varchar(75) not null constraint uq_usuarios_email unique
);

create index idx_usuarios_usuario_password on usuarios (usuario, password);

drop table admin cascade;

create table admin (
  id       bigserial   constraint pk_admin primary key,
  id_usuarios  bigserial constraint fk_admin_usuarios references usuarios (id) on update cascade on delete no action
);


drop table ci_sessions cascade;

CREATE TABLE ci_sessions (
  session_id varchar(40) DEFAULT '0' NOT NULL,
  ip_address varchar(45) DEFAULT '0' NOT NULL,
  user_agent varchar(120) NOT NULL,
  last_activity numeric(10) DEFAULT 0 NOT NULL,
  user_data text NOT NULL,
  PRIMARY KEY (session_id)
);

create index last_activity_idx on ci_sessions (last_activity);
  
/************************************VISTAS*****************************************/

drop view generos_de_penicula;
create view generos_de_penicula as
  select * from generos g join generos_peniculas p 
           on g.id = p.id_generos;

drop view paises_de_penicula;
create view paises_de_penicula as
  select * from paises p join paises_peniculas pp 
           on p.id = pp.id_paises;

drop view actores;
create view actores as
 select per.nombre as nombre,id_personas,id_peniculas from personas per join participan par
           on per.id = par.id_personas join cargos car
           on par.id_cargos = car.id
           where car.nombre = 'actor';

drop view directores;
create view directores as
 select per.nombre as nombre,id_personas,id_peniculas from personas per join participan par
           on per.id = par.id_personas join cargos car
           on par.id_cargos = car.id
           where car.nombre = 'director';
           
drop view comentarios_v;
create view comentarios_v as
 select c.*, u.usuario from comentarios c join usuarios u
           on u.id = c.id_usuarios;

/************************************INSERTS*****************************************/

insert into usuarios (usuario, password, email) values ('pepe', md5('pepe'), 'pepe@pepe.com');
insert into usuarios (usuario, password, email) values ('maria', md5('juan'), 'juan@juan.com');

insert into admin (id_usuarios) values (1);


INSERT INTO cargos (nombre) VALUES ('director');
INSERT INTO cargos (nombre) VALUES ('actor');

INSERT INTO generos (nombre) VALUES ('Suspense');
INSERT INTO generos (nombre) VALUES ('Comedia');
INSERT INTO generos (nombre) VALUES ('Ciencia Ficción');
INSERT INTO generos (nombre) VALUES ('Drama');

INSERT INTO paises (nombre,bandera) VALUES ('Espein','uploads/carteles/Spain.png');
INSERT INTO paises (nombre,bandera) VALUES ('Freinch','uploads/carteles/France.png');
INSERT INTO paises (nombre,bandera) VALUES ('Jinlang','uploads/carteles/England.png');
INSERT INTO paises (nombre,bandera) VALUES ('Iuesei','uploads/carteles/United-States.png');

INSERT INTO personas (nombre) VALUES ('George Lucas');
INSERT INTO personas (nombre) VALUES ('Liam Neeson');
INSERT INTO personas (nombre) VALUES ('Ewan McGregor');
INSERT INTO personas (nombre) VALUES ('Natalie Portman');
INSERT INTO personas (nombre) VALUES ('Charles Chaplin');

INSERT INTO peniculas (titulo, ano, duracion, cartel, estreno, alta, sinopsis)
  VALUES('Tiempos modernos',1936, 89,'uploads/carteles/modernos.jpg',current_date-70,current_date,
         'Extenuado por el frenético ritmo de la cadena de montaje, un obrero metalúrgico acaba perdiendo la razón.');
INSERT INTO peniculas (titulo, ano, duracion, cartel, estreno, alta, sinopsis)
  VALUES('La guerra de las galaxias. Episodio I: La amenaza fantasma',1999,131,'uploads/carteles/galaxias.jpg',current_date-15,current_date,
         'La infancia de Darth Vader, el pasado de Obi-Wan Kenobi');


insert into peniculas (titulo, cartel, estreno, dvd)
  values ('La Gran Estafa', 'uploads/carteles/gran_estafa.jpg', current_date - 1, current_date + 20);
insert into peniculas (titulo, cartel, estreno, dvd)
  values ('Ataque de los Tomates asesinos', 'uploads/carteles/ataque_tomates.jpg', current_date + 10, null);

INSERT INTO participan (id_peniculas,id_personas,id_cargos)
       VALUES (1,5,1);
INSERT INTO participan (id_peniculas,id_personas,id_cargos)
       VALUES (1,5,2);
INSERT INTO participan (id_peniculas,id_personas,id_cargos)
       VALUES (2,1,1);
INSERT INTO participan (id_peniculas,id_personas,id_cargos)
       VALUES (2,2,2);
INSERT INTO participan (id_peniculas,id_personas,id_cargos)
       VALUES (2,3,2);
INSERT INTO participan (id_peniculas,id_personas,id_cargos)
       VALUES (2,4,2);


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
       
       
INSERT INTO comentarios (critica, id_usuarios, id_peniculas)
       VALUES ('Fanstástica película!!', 1, 1);
INSERT INTO comentarios (critica, id_usuarios, id_peniculas)
       VALUES ('Una de mis favoritas', 2, 1);
INSERT INTO comentarios (critica, id_usuarios, id_peniculas)
       VALUES ('Que la fuerza os acompañe!', 1, 2);
INSERT INTO comentarios (critica, id_usuarios, id_peniculas)
       VALUES ('Increible esta película', 2, 2);
