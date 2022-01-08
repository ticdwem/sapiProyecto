CREATE TABLE almacenCentral(
idACentral INT NOT NULL AUTO_INCREMENT COMMENT 'este es un controlador',
idProductoACentral INT  NOT NULL COMMENT 'este es el id de los productos. de la tabla producto',
loteACentral	INT	NOT NULL COMMENT 'lote del producto, este servira para agrupar a los productos',
pesoACentral FLOAT(6,3) NOT NULL DEFAULT 0.0 COMMENT 'aqui tenemos el peso total en cada producto dependiendo del almacen',
cantidadPzACentral INT NOT NULL COMMENT 'este campo contiene el total de las piezas existentes en el almacen',
almacenACentral INT NOT NULL COMMENT ' este campo es una relacion indirecta al alamacen',
fechaACentral DATE NOT NULL DEFAULT '0000-00-00' COMMENT 'este campo contiene la fecna en que fie registrado el producto',
precioTotal	FLOAT(8.3) NULL COMMENT 'este campo se suman los totales',
FOREIGN KEY (idProductoACentral) REFERENCES producto (idProducto),
PRIMARY KEY (idACentral)
);