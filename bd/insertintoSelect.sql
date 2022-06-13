INSERT INTO ventaterminada
	(idnotaPedido, 
	idUsuarioPedido, 
	idClientePedido, 
	idProductoPedido, 
	pzProductoPedido, 
	loteProductoPedido,
	pesoProductoPedido, 
	fechaAltaProductoPedido, 
	idAlmacenPedidos, 
	statusProductoPedido, 
	fechaEntregaPedido, 
	idUsuarioVenta, 
	idNotaVendida)

SELECT
		 	idnotaPedido, 
			idUsuarioPedido,
			idClientePedido, 
			idProductoPedido, 
			pzProductoPedido, 
			loteProductoPedido, 
			pesoProductoPedido, 
			fechaAltaProductoPedido, 
			idAlmacenPedidos, 
			statusProductoPedido,
			fechaEntregaPedido, 
			idUsuarioVenta,
			idNotaVendida
	FROM pedidos
	WHERE pedidos.idnotaPedido = 1581022

