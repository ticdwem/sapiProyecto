
DELIMITER //
DROP PROCEDURE IF EXISTS confirmVenta //
	CREATE  PROCEDURE confirmVenta(
	IN _idNotaPedido INT, -- numero de nota de venta del pedido
	IN _numCliente INT, -- numero de cliente
	IN _numAnden INT, -- numeroi de anden
	IN _totalVenta FLOAT, -- total de la venta pot nota
	IN _notaVenta FLOAT, -- numero de nota de la venta
	IN _limCredito FLOAT, -- limite de credito
	IN _descuento	FLOAT, -- descuento que se ha asignado al cliente
	IN _Usuario INT -- numero de empleadi que realizo la venta
	)
	BEGIN
		DECLARE _resultSum float;
		DECLARE _saldo FLOAT;
		DECLARE _lastInsert INT;

-- obtenemos el saldo del el total de 
	SELECT saldoCreditoCliente INTO _saldo FROM cliente WHERE idCliente = _numCliente;	
		-- sumamos los datos 
		SELECT sumSomting(_saldo, _totalVenta) INTO _resultSum;
		-- actualizamos 
		UPDATE cliente	SET saldoCreditoCliente=_resultSum WHERE idCliente=_numCliente;
		
		
		-- insertamos en la tabla de notas
		INSERT INTO notaventa
			(idNotaVendida, idCliente, limiteCredito, descuento, usuarioNotaVenta)
				VALUES (_notaVenta, _numCliente, _limCredito, _descuento, _Usuario);
				
		
		
		-- tenemos un trigger cuando eliminamos de la tabla pedidos este inserta en la tabla ventas
		
		DELETE FROM pedidos 
       WHERE idnotaPedido = _idNotaPedido And
               idClientePedido = _numCliente and 
               idAlmacenPedidos= _numAnden;
	END
	
//