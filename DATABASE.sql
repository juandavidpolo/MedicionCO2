CREATE DATABASE tesis
	DEFAULT CHARACTER SET utf8;
USE tesis;
CREATE TABLE usuarios (
	id_usuario INT NOT NULL UNIQUE AUTO_INCREMENT,
	name VARCHAR(64) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	PRIMARY KEY(id_usuario)
);
CREATE TABLE cuentaUsuario(
        id_account INT NOT NULL UNIQUE AUTO_INCREMENT,
	id_usuario INT NOT NULL,
	urlConfirmacion VARCHAR(255) NOT NULL,
        estado VARCHAR(255) NOT NULL,
	FOREIGN KEY(id_usuario)
                REFERENCES cuentaUsuario(id_usuario);
);
CREATE TABLE equipo1 (
	id_measurement INT NOT NULL UNIQUE AUTO_INCREMENT,
	ppm INT NOT NULL,
        latitud VARCHAR(255) NOT NULL,
        longitud VARCHAR(255) NOT NULL,
        bateria VARCHAR(255) NOT NULL,
	fecha DATETIME TIMESTAMP
);
CREATE TABLE recuperacion(
        id_recover INT NOT NULL UNIQUE AUTO_INCREMENT,
        id_usuario INT NOT NULL,
        urlSecret VARCHAR(255) NOT NULL,
        estado VARCHAR(255) NOT NULL,
        fecha DATETIME,
        fechaL DATETIME,
        FOREIGN KEY(id_usuario)
            REFERENCES cuentaUsuario(id_usuario)
);