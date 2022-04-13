CREATE TABLE empleado(
   idEmpleado INT NOT NULL AUTO_INCREMENT  COMMENT ' identificador del empleado, primary key y auto incremental',
	nombrEmpleado VARCHAR(50) NOT NULL COMMENT 'nombre de empleado',
	apellidosEmpleado	VARCHAR(50) COMMENT 'apellods del empleado',
	statusEmpleado	CHAR(1) NOT NULL COMMENT 'este campo recibe si esta activo el empleado',
	PRIMARY KEY(idEmpleado)
);

CREATE TABLE usuario (
	idUsuario INT NOT NULL AUTO_INCREMENT COMMENT 'es el identificador del usurio',
	idEmpleadoUsuario INT NOT NULL COMMENT 'foreign key de tabla empleado',
	nombreUsuario VARCHAR(50) NOT NULL COMMENT ' contiene le nombre del usuario',
	passwordUsuario VARCHAR(100) NULL DEFAULT NULL ,
	statusUsuario CHAR(1) NOT NULL COMMENT 'identifica si el usuario esta actvo',
	PRIMARY KEY (idUsuario),
	FOREIGN KEY (idEmpleadoUsuario) REFERENCES empleado(idEmpleado)
);

CREATE TABLE menu(
	idMenu	INT NOT NULL AUTO_INCREMENT COMMENT 'identificador principal del menu',
	nombreMenu VARCHAR(100) NOT NULL COMMENT 'nombre del menu',
	iconoMenu VARCHAR(50) NOT NULL COMMENT 'icono del menu',
	PRIMARY KEY(idMenu)  
);

CREATE TABLE menuEmpleado(
 idMenu INT NOT NULL COMMENT 'relacion del menu',
 idUsuario INT NOT NULL COMMENT 'relacion de usuario',
 PRIMARY KEY(idMenu,idUsuario),
 FOREIGN KEY (idMenu) REFERENCES menu(idMenu),
 FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);