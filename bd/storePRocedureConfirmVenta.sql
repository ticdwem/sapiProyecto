
DELIMITER //
DROP PROCEDURE IF EXISTS confirmVenta //
	CREATE  PROCEDURE confirmVenta(
	IN _idNota INT, 
	IN _numCliente INT, -- numero de cliente
	IN _numAnden INT, -- numeroi de anden
	IN _totalVenta FLOAT -- total de la venta pot nota
	)
	BEGIN
		DECLARE _resultSum float;
		DECLARE _saldo FLOAT;

-- obtenemos el saldo del el total de 
	SELECT saldoCreditoCliente INTO _saldo FROM cliente WHERE idCliente = _numCliente;	
		-- sumamos los datos 
		SELECT sumSomting(_saldo, _totalVenta) INTO _resultSum;
		-- actualizamos 
		UPDATE cliente	SET saldoCreditoCliente=_resultSum WHERE idCliente=_numCliente;
		
		
		-- tenemos un trigger cuando eliminamos de la tabla pedidos este inserta en la tabla ventas
		
		DELETE FROM pedidos 
       WHERE idnotaPedido = _idNota And
               idClientePedido = _numCliente and 
               idAlmacenPedidos= _numAnden;
	END
	
//