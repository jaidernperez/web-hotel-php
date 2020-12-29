/*==============================================================*/
/* Table: HABITACION                                            */
/*==============================================================*/
create table HABITACION
(
   ID_HABITACION        serial,
   ID_TIPO              integer                        not null,
   NOMBRE               varchar(30)                    not null,
   PRECIO               float                          not null,
   DISPONIBILIDAD       boolean                        not null,
   IMAGEN               varchar(200)                   null,
   constraint PK_HABITACION primary key (ID_HABITACION)
);

/*==============================================================*/
/* Table: PERSONA                                               */
/*==============================================================*/
create table PERSONA
(
   ID_PERSONA           serial,
   CEDULA               varchar(20)                    not null,
   NOMBRES              varchar(50)                    not null,
   APELLIDOS            varchar(50)                    not null,
   CORREO               varchar(50)                    not null,
   TELEFONO             varchar(20)                    null,
   constraint PK_PERSONA primary key (ID_PERSONA)
);

/*==============================================================*/
/* Table: RESERVACION                                           */
/*==============================================================*/
create table RESERVACION
(
   ID_RESERVACION       serial,
   ID_HABITACION        integer                        not null,
   ID_PERSONA           integer                        not null,
   FECHA_INICIO         date                           not null,
   FECHA_FINAL          date                           null,
   PRECIO_TOTAL         float                          null,
   ESTADO               boolean                        null,
   constraint PK_RESERVACION primary key (ID_RESERVACION)
);

/*==============================================================*/
/* Table: ROL                                                   */
/*==============================================================*/
create table ROL
(
   ID_ROL               serial,
   NOMBRE               varchar(30)                    not null,
   constraint PK_ROL primary key (ID_ROL)
);

/*==============================================================*/
/* Table: TIPO_HABITACION                                       */
/*==============================================================*/
create table TIPO_HABITACION
(
   ID_TIPO              serial,
   NOMBRE               varchar(30)                    not null,
   constraint PK_TIPO_HABITACION primary key (ID_TIPO)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO
(
   ID_USUARIO           serial,
   ID_ROL               integer                        not null,
   ID_PERSONA           integer                        not null,
   NOMBRE_USUARIO       varchar(30)                    not null,
   CLAVE                varchar(256)                   not null,
   IMAGEN               varchar(800)                   null,
   constraint PK_USUARIO primary key (ID_USUARIO)
);

alter table HABITACION
   add constraint FK_HABITACI_REFERENCE_TIPO_HAB foreign key (ID_TIPO)
      references TIPO_HABITACION (ID_TIPO)
      on update cascade
      on delete restrict;

alter table RESERVACION
   add constraint FK_RESERVAC_REFERENCE_HABITACI foreign key (ID_HABITACION)
      references HABITACION (ID_HABITACION)
      on update cascade
      on delete restrict;

alter table RESERVACION
   add constraint FK_RESERVAC_REFERENCE_PERSONA foreign key (ID_PERSONA)
      references PERSONA (ID_PERSONA)
      on update cascade
      on delete restrict;

alter table USUARIO
   add constraint FK_USUARIO_REFERENCE_ROL foreign key (ID_ROL)
      references ROL (ID_ROL)
      on update cascade
      on delete restrict;

alter table USUARIO
    add constraint FK_USUARIO_REF_PERSONA foreign key (ID_PERSONA)
        references PERSONA (ID_PERSONA)
        on update cascade
        on delete restrict;

INSERT INTO TIPO_HABITACION(NOMBRE) 
VALUES('Sencilla'),
      ('Doble'),
      ('Suite'),
      ('Familiar');

INSERT INTO ROL(NOMBRE) 
VALUES('Admin'),
      ('Empleado'),
      ('Invitado');

INSERT INTO PERSONA(CEDULA, NOMBRES, APELLIDOS, CORREO, TELEFONO) 
VALUES('0000000000', 'Super', 'Admin', 'admin@admin.co', '0000000');   

INSERT INTO USUARIO(ID_ROL, ID_PERSONA, NOMBRE_USUARIO, CLAVE)
VALUES (1,1,'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');
