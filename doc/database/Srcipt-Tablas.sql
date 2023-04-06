DROP TABLE IF EXISTS reserva;

DROP TABLE IF EXISTS usuario;

DROP TABLE IF EXISTS unidad;

create table usuario(
    id_usuario serial,
    nombre varchar(255),
    correo varchar(255) unique,
    clave varchar(255),
    estado varchar(1),
    roles json,
    constraint pk_usuario primary key (id_usuario)
);

create table unidad(
    id_unidad serial,
    codigo varchar(5),
    capacidad int,
    estado varchar(1),
    placa varchar(7),
    constraint pk_unidad primary key (id_unidad)
);

create table reserva(
    id_reserva serial,
    disponibilidad varchar(1),
    detalle varchar(255),
    observacion varchar(255),
    estado varchar(1),
    id_usuario int,
    id_unidad int,
    constraint pk_reserva primary key (id_reserva),
    constraint fk_usuario foreign key (id_usuario) references usuario (id_usuario),
    constraint fk_unidad foreign key (id_unidad) references unidad (id_unidad)
);