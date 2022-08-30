
DELIMITER //
DROP PROCEDURE IF EXISTS confirmVenta //
	CREATE  PROCEDURE confirmVenta(
		IN _idNotaPedido INT,
		IN _numCliente INT,
		IN _numAnden INT,
		IN _totalVenta FLOAT,
		IN _notaVenta VARCHAR(20),
		IN _limCredito FLOAT,
		IN _descuento FLOAT,
		IN _Usuario
		 INT
	)
	BEGIN
		DECLARE _resultSum float;
		DECLARE _saldo FLOAT;
		DECLARE _lastInsert INT;

		-- obtenemos el saldo del el total del cliente
		SELECT saldoCreditoCliente INTO _saldo FROM cliente WHERE idCliente = _numCliente;	
		-- sumamos los datos 
		SELECT sumSomting(_saldo, _totalVenta) INTO _resultSum;
		-- actualizamos 
		UPDATE cliente	SET saldoCreditoCliente=_resultSum WHERE idCliente=_numCliente;
		
		-- insertamos en la tabla de notas
		INSERT INTO notaventa
			(idNotaVenta, idClienteNotaVenta, idUsuarioNotaVenta, fechaAltaNotaVenta, fechaEntregaNotaVenta, comentarioNotaVenta, idAlmacenVenta, statusNotaVenta, nombreNotaVenta, telNotaVenta, rutaNotaVenta, idNotaPedido,TotalNotaVenta)
		SELECT 
       	_notaVenta,idClienteNotaPedido,idUsuarioNotaPedido,fechaAltaNotaPedido,fechaEnregaNotaPedido,comentarioNotaPedidos,_numAnden,'4',nombreNotaPedido,telNotaPEdido,rutaNotaPEdido,idNotaPedido,_totalVenta
		FROM notapedido
		WHERE idNotaPedido = _idNotaPedido;
		
		
		-- pasamos los productos a la tabla de ventas
		INSERT INTO venta
	   	(idPeddios, idnotaPedido, idProductoPedido, pzProductoPedido, detalleEntrega, loteProductoPedido, pesoProductoPedido, idNotaVendida, precio, subtotal)
		SELECT idPeddios, idnotaPedido, idProductoPedido, pzProductoPedido, detalleEntrega, loteProductoPedido, pesoProductoPedido, idNotaVendida,(SELECT producto.precioProductoUnidad FROM producto WHERE producto.idProducto = idProductoPedido), (pesoProductoPedido*(SELECT producto.precioProductoUnidad FROM producto WHERE producto.idProducto = idProductoPedido))
		FROM pedidos	
		WHERE idnotaPedido = _idNotaPedido;

	-- una vez que insertamos en la tabla de ventaterminada procedemos a eliminar dfe la tabla de pedidos
		DELETE FROM notapedido np
       WHERE idNotaPedido = _idNotaPedido And
          np.idClienteNotaPedido = _numCliente;
          
   -- tambien eliminamos los productos de pedidos
   	DELETE FROM pedidos pe
   	WHERE pe.idnotaPedido = _idNotaPedido;
	END
	
//