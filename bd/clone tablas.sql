-- con estos comandos hacemos el clon de una tabla
CREATE TABLE historico_pedidos LIKE pedidos;
CREATE TABLE historico_pedidos SELECT * FROM  pedidos;

DESCRIBE historico_pedidos;
DESCRIBE historico_pedidos_select;