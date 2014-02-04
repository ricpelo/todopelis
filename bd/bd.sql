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
  alta     date
);

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