DROP TABLE IF EXISTS "Reserva" CASCADE;
DROP TABLE IF EXISTS "Bus" CASCADE;
DROP TABLE IF EXISTS "Usuario" CASCADE;

CREATE TABLE "Usuario" (
  "id_usuario" serial,
  "nombre" varchar(50)  not null,
  "apellido" varchar(50) not null,
  "correo" varchar(100) not null,
  "clave" varchar(100) not null,
  "roles" json not null,
  "tipo" varchar(100) not null,
  "estado" varchar(1),
  CONSTRAINT "PK_Usuario"
  	PRIMARY KEY ("id_usuario")
);

CREATE TABLE "Bus" (
  "id_bus" serial,
  "modelo" varchar(100) not null,
  "matricula" varchar(50) not null,
  "capacidad" integer not null,
  "condicion" varchar(200) not null,
  "estado" varchar(1),
  CONSTRAINT "PK_Bus"
	PRIMARY KEY ("id_bus")
);

CREATE TABLE "Reserva" (
  "id_reserva" serial,
  "id_usuario" integer,
  "id_bus" integer,
  "descripcion" varchar(500),
  "fecha" date not null,
  "periodo" interval not null,
  "observacion" varchar(200),
  "estado" varchar(1),
  CONSTRAINT "PK_Reserva"
  	PRIMARY KEY ("id_reserva"),
  CONSTRAINT "FK_Reserva_id_bus"
    FOREIGN KEY ("id_bus") REFERENCES "Bus"("id_bus"),
  CONSTRAINT "FK_Reserva_id_usuario"
    FOREIGN KEY ("id_usuario") REFERENCES "Usuario"("id_usuario")
);
