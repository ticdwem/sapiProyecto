alter VIEW viewPreventa as
SELECT pe.idnotaPedido,pe.idUsuarioPedido,us.nombreUsuario,pe.idClientePedido,cli.nombreCliente,rta.idRuta,rta.nombreRuta,pe.statusProductoPedido FROM pedidos pe
INNER JOIN cliente cli
ON pe.idClientePedido = cli.idCliente
INNER JOIN domiciliocliente domcli
ON cli.idCliente = domcli.clienteId
INNER JOIN ruta rta
ON domcli.rutaId = rta.idRuta
INNER JOIN usuario us
ON pe.idUsuarioPedido = us.idUsuario
