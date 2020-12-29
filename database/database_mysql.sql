drop database if exists db_hotel;
create database if not exists db_hotel character set utf8mb4 collate utf8mb4_bin;
use db_hotel;

/*==============================================================*/
/* table: habitacion                                            */
/*==============================================================*/
create table habitacion
(
    id_habitacion        integer auto_increment         not null,
    id_tipo              integer                        not null,
    nombre               varchar(30)                    not null,
    precio               float                          not null,
    disponibilidad       smallint                       not null,
    constraint pk_habitacion primary key (id_habitacion)
);

/*==============================================================*/
/* table: persona                                               */
/*==============================================================*/
create table persona
(
    id_persona           integer auto_increment         not null,
    cedula               varchar(20)                    not null,
    nombres              varchar(50)                    not null,
    apellidos            varchar(50)                    not null,
    correo               varchar(50)                    not null,
    telefono             varchar(20)                    null,
    constraint pk_persona primary key (id_persona)
);

/*==============================================================*/
/* table: reservacion                                           */
/*==============================================================*/
create table reservacion
(
    id_reservacion       integer auto_increment         not null,
    id_habitacion        integer                        not null,
    id_persona           integer                        not null,
    fecha_inicio         date                           not null,
    fecha_final          date                           null,
    precio_total         float                          null,
    estado               smallint                       null,
    constraint pk_reservacion primary key (id_reservacion)
);

/*==============================================================*/
/* table: rol                                                   */
/*==============================================================*/
create table rol
(
    id_rol               integer auto_increment         not null,
    nombre               varchar(30)                    not null,
    constraint pk_rol primary key (id_rol)
);

/*==============================================================*/
/* table: tipo_habitacion                                       */
/*==============================================================*/
create table tipo_habitacion
(
    id_tipo              integer auto_increment         not null,
    nombre               varchar(30)                    not null,
    constraint pk_tipo_habitacion primary key (id_tipo)
);

/*==============================================================*/
/* table: usuario                                               */
/*==============================================================*/
create table usuario
(
    id_usuario           integer auto_increment         not null,
    id_rol               integer                        not null,
    id_persona           integer                        not null,
    nombre_usuario       varchar(30)                    not null,
    clave                varchar(256)                   not null,
    imagen               varchar(200)                   null,
    constraint pk_usuario primary key (id_usuario)
);

alter table habitacion
    add constraint fk_habitaci_reference_tipo_hab foreign key (id_tipo)
        references tipo_habitacion (id_tipo)
        on update cascade
        on delete restrict;

alter table reservacion
    add constraint fk_reservac_reference_habitaci foreign key (id_habitacion)
        references habitacion (id_habitacion)
        on update cascade
        on delete restrict;

alter table reservacion
    add constraint fk_reservac_reference_persona foreign key (id_persona)
        references persona (id_persona)
        on update cascade
        on delete restrict;

alter table usuario
    add constraint fk_usuario_reference_rol foreign key (id_rol)
        references rol (id_rol)
        on update cascade
        on delete restrict;

alter table usuario
    add constraint fk_usuario_ref_persona foreign key (id_persona)
        references persona (id_persona)
        on update cascade
        on delete restrict;

insert into tipo_habitacion(nombre)
values('Sencilla'),
      ('Doble'),
      ('Suite'),
      ('Familiar');

insert into rol(nombre)
values('Admin'),
      ('Empleado'),
      ('Invitado');

insert into persona(cedula, nombres, apellidos, correo, telefono)
values('0000000000', 'Super', 'Admin', 'admin@admin.co', '0000000');

insert into usuario(id_rol, id_persona, nombre_usuario, imagen, clave)
values (1,1,'admin', 'img_-ca954182160928154131734540410876502.png',
        'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');

