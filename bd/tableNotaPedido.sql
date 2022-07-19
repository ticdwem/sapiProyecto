ALTER TABLE notaPedido(
idnotaPedido INT (10) NOT NULL COMMENT 'identificador de la nota',
idClienteNotaPedido INT NOT NULL COMMENT 'identificador de los cliente',
idUsuarioNotaPedido INT NOT NULL COMMENT 'dentificador de el cliente',
fechaAltaNotaPedido DATE NOT NULL COMMENT ' fecha de cracion de la nota',
fechaEnregaNotaPedido DATE NOT NULL COMMENT 'fecha de entrega de los productos',
comentarioNotaPedidos TEXT NULL COMMENT 'este contiene el comentario para la nota que viene del area de cobranza',
idAlmacenPedidos CHAR(2) DEFAULT 0 COMMENT 'este sera una relacion con almacenes',
statusNotaPEdido CHAR(1) DEFAULT 1 COMMENT '1.- indica pediodo capturado 2.- asignado Andenes 3.- asignado a algún almacen',

PRIMARY KEY(notaPedido),
FOREIGN KEY (idClienteNotaPedido) REFERENCES cliente (idCliente),
FOREIGN KEY (idUsuarioNotaPedido) REFERENCES usuario (idUsuario)

);