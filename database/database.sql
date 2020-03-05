DROP DATABASE pensiones;

CREATE DATABASE pensiones;

USE pensiones;

CREATE TABLE postal (
  id int(11) primary key auto_increment,
  codigo int(11) DEFAULT NULL,
  colonia varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  municipio varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  estado varchar(255) CHARACTER SET utf8 DEFAULT NULL
);

CREATE TABLE documento(
    id_documento int primary key auto_increment,
    nombre_documento varchar(100),
    descripcion text,
    activo boolean
);
CREATE TABLE modulo(
    id_modulo int primary key auto_increment,
    nombre_modulo varchar(100),
    descripcion text,
    activo boolean
);
CREATE TABLE privilegiousuario(
    id_privilegio_usuario int primary key auto_increment,
    nombre_privilegio varchar(100)
);
CREATE TABLE tipousuario(
    id_tipo_usuario int primary key auto_increment,
    nombre_tipo_usuario varchar(100)
);
CREATE TABLE tipousuarioprivilegio(
    id_tipo_usuario int primary key auto_increment,
    id_privilegio_usuario int,
    foreign key (id_privilegio_usuario) references privilegiousuario(id_privilegio_usuario),
    foreign key (id_tipo_usuario) references tipousuario(id_tipo_usuario)
);

CREATE TABLE usuario(
    id_usuario int primary key auto_increment,
    id_tipo_usuario int,
    username varchar(30),
    password varchar(255),
    nombre varchar(50),
    ap_pat varchar(30),
    ap_mat varchar(30),
    email varchar(80),
    telefono varchar(10),
    imagen varchar(255),
    activo boolean,
    foreign key(id_tipo_usuario) references tipousuario(id_tipo_usuario)
);

CREATE TABLE tipoconceptotransaccion(
    id_tipo_concepto_transaccion int primary key auto_increment,
    nombre_tipo_concepto varchar(100),
    signo_concepto varchar(5),
    descripcion text,
    activo boolean
);
CREATE TABLE conceptotransaccion(
    id_concepto_transaccion int primary key auto_increment,
    id_tipo_concepto_transaccion int,
    id_modulo int,
    nombre_concepto_transaccion varchar(100),
    descripcion text,
    activo boolean,
    foreign key (id_tipo_concepto_transaccion) references tipoconceptotransaccion(id_tipo_concepto_transaccion),
    foreign key (id_modulo) references modulo(id_modulo)
);

CREATE TABLE institucionbancaria(
    id_institucion_bancaria int primary key auto_increment,
    nombre_institucion_bancaria varchar(80),
    razon_social varchar(255)
);
CREATE TABLE genero(
    id_genero int primary key auto_increment,
    nombre_genero varchar(100)
);

CREATE TABLE cliente(
    id_cliente int primary key auto_increment,
    id_postal int,
    id_institucion_bancaria int,
    id_genero int,
    nombre_cliente varchar(80),
    ap_pat varchar(30),
    ap_mat varchar(30),
    rfc varchar(20),
    curp varchar(30),
    fecha_nacimiento date,
    estado_nacimiento varchar(50),
    email varchar(100),
    telefono varchar(10),
    imagen varchar(255),
    calle varchar(255),
    noexterior varchar(10),
    nointerior varchar(10),
    nss varchar(50),
    alta_imss date,
    baja_imss date,
    clabe_interbancaria varchar(20),
    observacion text,
    activo boolean,
    foreign key (id_postal) references postal(id),
    foreign key (id_institucion_bancaria) references institucionbancaria(id_institucion_bancaria),
    foreign key (id_genero) references genero(id_genero)
)AUTO_INCREMENT = 1000000;

CREATE TABLE documentocliente(
    id_documento int,
    id_cliente int,
    observacion text,
    url_documento text,
    primary key (id_cliente, id_documento),
    foreign key (id_cliente) references cliente(id_cliente),
    foreign key (id_documento) references documento(id_documento)
);

CREATE TABLE transaccion(
    id_transaccion int primary key auto_increment,
    id_concepto_transaccion int,
    id_usuario int,
    id_cliente int,
    monto decimal(12,2),
    fecha_registro date,
    descripcion text,
    activo boolean,
    foreign key (id_concepto_transaccion) references conceptotransaccion(id_concepto_transaccion),
    foreign key (id_usuario) references usuario(id_usuario),
    foreign key (id_cliente) references cliente(id_cliente)
);

