drop table notaventa;
drop table ventaterminada;

CREATE TABLE `notaventa` (
	`idNotaVendida` VARCHAR(20) NOT NULL COMMENT 'id de la nota vendida' COLLATE 'utf8mb4_0900_ai_ci',
	`idCliente` INT(10) NOT NULL COMMENT 'id del cliente ',
	`limiteCredito` FLOAT(9,2) NOT NULL COMMENT 'limite de credito cuando se cendio la nota',
	`descuento` FLOAT(7,2) NOT NULL COMMENT 'descuento cuando se hizo la nota',
	`usuarioNotaVenta` INT(10) NULL DEFAULT NULL COMMENT 'id del usuario que ha realizado la venta',
	PRIMARY KEY (`idCliente`, `idNotaVendida`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;


CREATE TABLE `ventaterminada` (
	`idPeddios` INT(10) NOT NULL AUTO_INCREMENT COMMENT 'este es un id solo para control',
	`idnotaPedido` INT(10) NOT NULL COMMENT 'este mas el idPedidos conformaran el para los pedidos',
	`idUsuarioVenta` INT(10) NOT NULL COMMENT 'id del usuario que ha dado de alta los pedidos',
	`idNotaVendida` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`idCliente` INT(10) NOT NULL COMMENT 'este es la relacion con la tabla cliente',
	`idProductoPedido` INT(10) NOT NULL COMMENT 'este es la relacion con la tabla producto',
	`pzProductoPedido` INT(10) NULL DEFAULT NULL COMMENT 'este contiene la cantidad de piezas del producto solicitad',
	`loteProductoPedido` INT(10) NOT NULL DEFAULT '0' COMMENT 'lote ,este sera llenado una vez que se esta haciendo la venta',
	`pesoProductoPedido` FLOAT NOT NULL DEFAULT '0',
	`fechaAltaProductoPedido` DATE NULL DEFAULT NULL COMMENT 'contiene la fecha que fue dado de alta el pedido',
	`idAlmacenPedidos` CHAR(2) NOT NULL DEFAULT '0' COMMENT 'este sera una relacion con almacenes' COLLATE 'utf8mb4_0900_ai_ci',
	`statusProductoPedido` CHAR(1) NULL DEFAULT NULL COMMENT 'este nos dira cuando fue atendido el pedido' COLLATE 'utf8mb4_0900_ai_ci',
	`fechaEntregaPedido` DATE NOT NULL COMMENT 'este dato guarda la fecha de entrega de los pedidos',
	`dateDrop` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`idPeddios`) USING BTREE)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;