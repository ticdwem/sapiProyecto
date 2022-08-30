-- con estos comandos hacemos el clon de una tabla e insertamos losmismos datos
-- CREATE TABLE notaVenta SELECT * FROM  pedidos; 

-- con este comando clonamos la tabla sin llenarla
CREATE TABLE notaVenta LIKE notapedido;
CREATE TABLE Ventas LIKE pedidos;

-- DESCRIBE historico_pedidos;
-- DESCRIBE historico_pedidos_select;