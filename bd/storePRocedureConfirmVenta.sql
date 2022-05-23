
DELIMITER //
DROP PROCEDURE IF EXISTS confirmVenta //
	CREATE  PROCEDURE confirmVenta(
	IN _idNotaPedido INT, 
	IN _numCliente INT, 
	IN _numAnden INT, 
	IN _totalVenta FLOAT
	IN _notaVenta VARCHAR(20), 
	IN _limCredito FLOAT,
	IN _descuento	FLOAT, 
	IN _Usuario INT 
	)
	BEGIN
		DECLARE _resultSum 
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
				
		/* Error de SQL (1054): Unknown column 'idClientePedido' in 'field list' */
		
		-- tenemos un trigger cuando eliminamos de la tabla pedidos este inserta en la tabla ventas
		
		DELETE FROM pedidos 
       WHERE idnotaPedido = _idNotaPedido And
               idClientePedido = _numCliente and 
               idAlmacenPedidos= _numAnden;
	END
	
//