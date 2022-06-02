/*CREATE VIEW almacenCentralProducto as
SELECT pr.idProducto,pr.nombreProducto,pr.presentacionProducto,ac.*
 FROM almacencentral ac 
INNER JOIN producto pr

idProducto, nombreProducto, loteACentral, cantidadPzACentral, almacenACentral

ON ac.idProductoACentral = pr.idProducto
*/
-- SELECT * FROM almacenCentralProducto acp WHERE acp.idProducto LIKE '%llo%' OR acp.nombreProducto LIKE '%llo%' AND acp.almacenACentral = 3
 
-- SELECT * FROM almacenCentralProducto acp WHERE  acp.almacenACentral = 3 and acp.idProducto LIKE '%501%' OR acp.nombreProducto LIKE '%501%' 
-- SELECT * FROM almacenCentralProducto acp WHERE  acp.almacenACentral = 3 AND acp.idProducto LIKE '%50%'

INSERT INTO pedidos 
							(idnotaPedido, 
							idUsuarioPedido, 
							idClientePedido, 
							idProductoPedido, 
							pzProductoPedido, 
							fechaAltaProductoPedido, 
							statusProductoPedido,
							fechaEntregaPedido)
							 VALUES ('1481022', 
							 '1', 
							 '58', 
							 '501', 
							 '25', 
							 now(), 
							 '1',
							 '2022-05-30')