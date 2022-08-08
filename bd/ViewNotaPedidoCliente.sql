-- DROP VIEW if EXISTS notapedidocliente;
CREATE OR REPLACE VIEW ViewNotaPedidoCliente as 
SELECT 
np.idNotaPedido AS nota,
np.idClienteNotaPedido AS idCliente,
cl.nombreCliente AS nameCliente,
np.fechaEnregaNotaPedido AS entrega, 
np.comentarioNotaPedidos AS comentario, 
np.nombreNotaPedido AS nombreAdicional,
np.statusNotaPEdido AS _status,
np.rutaNotaPEdido
FROM notapedido np
INNER JOIN cliente cl
ON np.idClienteNotaPedido = cl.idCliente

-- WHERE statusNotaPEdido = 2 OR statusNotaPEdido = 3 AND rutaNotaPEdido = 1
