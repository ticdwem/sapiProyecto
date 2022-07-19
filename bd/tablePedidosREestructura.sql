DROP TABLE if EXISTS pedidos;
CREATE TABLE pedidos (
	idPeddios INT(10) NOT NULL AUTO_INCREMENT COMMENT 'este es un id solo para control',
	idnotaPedido INT(10) NOT NULL COMMENT 'este mas el idPedidos conformaran el para los pedidos',
	idProductoPedido INT(10) NOT NULL COMMENT 'este es la relacion con la tabla producto',
	pzProductoPedido INT(10) NOT NULL COMMENT 'este contiene la cantidad de piezas del producto solicitad',
	detalleEntrega TEXT NOT NULL COMMENT 'aqui se registra y se dan instrucciones de como debe ser entregado el producto, tambien se describe si es un pedido especial' COLLATE 'utf8mb4_0900_ai_ci',
	loteProductoPedido INT(10) NOT NULL DEFAULT '0' COMMENT 'lote ,este sera llenado una vez que se esta haciendo la venta',
	pesoProductoPedido FLOAT NOT NULL DEFAULT '0',
	idNotaVendida VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	comentarioNotaPedidos TEXT NULL DEFAULT NULL COMMENT 'este contiene el comentario para la nota que viene del area de cobranza' COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`idPeddios`) USING BTREE,
	INDEX `idProductoPedido` (`idProductoPedido`) USING BTREE,
	INDEX `pedidos_ibfk_3` (`idnotaPedido`) USING BTREE,
	CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idProductoPedido`) REFERENCES `producto` (`idProducto`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idnotaPedido`) REFERENCES `notapedido` (`idNotaPedido`) ON UPDATE NO ACTION ON DELETE NO ACTION
);
