SELECT np.fechaAltaNotaPedido AS fechaInicial,np.fechaEnregaNotaPedido AS fechaFin,np.idNotaPedido AS nota,np.idClienteNotaPedido AS clente,cl.nombreCliente AS nameCl,rt.nombreRuta AS rutaname
FROM notapedido np
INNER JOIN cliente cl
ON np.idClienteNotaPedido = cl.idCliente
INNER JOIN domiciliocliente dc
ON dc.clienteId = cl.idCliente
INNER JOIN ruta rt
ON dc.rutaId = rt.idRuta