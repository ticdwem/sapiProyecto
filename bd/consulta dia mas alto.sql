/*SELECT pds.idnotaPedido,pds.idClientePedido,pds.fechaAltaProductoPedido,pds.fechaEntregaPedido  FROM pedidos pds WHERE fechaEntregaPedido BETWEEN '2022-06-17' AND (SELECT MAX(pd.fechaEntregaPedido) FROM pedidos pd)
GROUP BY pds.idnotaPedido;*/

SELECT pds.idnotaPedido,pds.idClientePedido,pds.fechaAltaProductoPedido,pds.fechaEntregaPedido,cl.nombreCliente,dc.rutaId,rt.nombreRuta
 FROM pedidos pds 
INNER JOIN cliente cl
ON pds.idClientePedido = cl.idCliente
INNER JOIN domiciliocliente dc
ON dc.clienteId = cl.idCliente
INNER JOIN ruta rt
ON rt.idRuta = dc.rutaId
WHERE fechaEntregaPedido BETWEEN '2022-06-17' AND (SELECT MAX(pd.fechaEntregaPedido) FROM pedidos pd) GROUP BY pds.idnotaPedido;