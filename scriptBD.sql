create table usuario(
	id_usuario serial,
	nombre varchar(150) not null,
	email varchar(100) not null,
	tipo varchar(100),
	clave varchar(150) not null,
	estado varchar(1) not null,
	roles json,
	CONSTRAINT id_usuario PRIMARY KEY (id_usuario)
);

create table bus(
	id_bus serial,
	informacion varchar(150),
	estado_bus varchar(50),
	estado varchar(1) not null,
	CONSTRAINT id_bus PRIMARY KEY (id_bus)
);

create table reserva(
	id_reserva serial,
	id_bus int,
	id_usuario int,
	horario timestamp,
	observacion varchar(250),
	estado_reserva varchar(150),
	estado varchar(1) not null,
	CONSTRAINT id_reserva PRIMARY KEY (id_reserva),
	CONSTRAINT fk_bus FOREIGN KEY (id_bus)  REFERENCES bus(id_bus),
	CONSTRAINT fk_usuario FOREIGN KEY (id_usuario)  REFERENCES usuario(id_usuario)
);

insert into bus(id_bus,informacion, estado_bus, estado) values(1,'Marca: Mercedes Benz, Capacidad:100, Placa:ABC254', 'Disponible','A');
insert into bus(id_bus,informacion, estado_bus, estado) values(2,'Marca: Mercedes Benz, Capacidad:100, Placa:FFF000', 'Disponible','A');
insert into bus(id_bus,informacion, estado_bus, estado) values(3,'Marca: CHEVT, Capacidad:50, Placa:ZET456', 'Disponible','A');

select * from reserva where id_usuario is not null;

SELECT * FROM BUS;
select * from reserva;
select * from usuario;