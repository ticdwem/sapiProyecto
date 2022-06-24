
DELIMITER //
DROP PROCEDURE IF EXISTS CambioDeAlmacen //
	CREATE  PROCEDURE CambioDeAlmacen(
	IN _idAlmacenInicial INT,
	IN _idAlmacenFinal INT,
	IN _pz INT,
	IN _peso FLOAT,
	IN _lote INT,
	IN _idProducto INT
	)
	BEGIN

	   DECLARE _psoUnoFinal FLOAT;
	   DECLARE _totalpz INT;
	   DECLARE _psoDosFinal FLOAT;
	   DECLARE _totalpzDos INT;
	   DECLARE _restarPzTotal INT;
	   DECLARE _restarPesoTotal FLOAT;
	   DECLARE _sumPz INT;
	   DECLARE _sumPeso FLOAT;
	   DECLARE _precioProducto FLOAT;
	   DECLARE _precioTotal FLOAT;
	   DECLARE _precioFinalAlmacenDestino FLOAT;
	   DECLARE _precioFinalSumado FLOAT;
	   DECLARE _totalALmacenIncial FLOAT;
	   DECLARE _restarTotales FLOAT;
	
	 	select sacarCantidad(_idProducto,_lote,_idAlmacenInicial) INTO _totalpz;
	 	select sacarPeso(_idProducto,_lote,_idAlmacenInicial) INTO _psoUnoFinal;
	 	
	 	-- restamos las piezas
	 	select restaArticulos(_totalpz,_pz) INTO _restarPzTotal;
	 	
	 	-- restamos los pesos 
	 	select restSomting(_psoUnoFinal,_peso) INTO _restarPesoTotal;
	 	
	 	-- obtenermos los datos del almcaen destino
	 	select sacarCantidad(_idProducto,_lote,_idAlmacenFinal)INTO _totalpzDos;
	 	select sacarPeso(_idProducto,_lote,_idAlmacenFinal)INTO _psoDosFinal;
	 	
	 	SELECT precioProductoUnidad INTO _precioProducto FROM producto WHERE idProducto = _idProducto;
	 	SELECT precioTotalProduto(_peso, _precioProducto) INTO _precioTotal;
	 	
	 	/*
		  * este if actualiza la tabla destino, si en la tabla destino no existe el producto este sera insertardo;
		  * de lo contrario, sacamos su precio final que tiene lo sumamos con el precio que que vamos a sacar de la 
		  * los productos. sumamos la cantidad que scamos de la tabla origen mas lo que tiene la tabla destino, de la
		  * misma manera en el peso, y al final actualoizamos todo en la tabla origen
		 */
		IF(_totalpzDos IS NULL OR _totalpzDos = '')  then 			 
		 
		 INSERT INTO almacencentral
				(idProductoACentral, loteACentral, pesoACentral, cantidadPzACentral, almacenACentral, fechaACentral, precioTotal)
			VALUES (_idProducto, _lote, _peso, _pz, _idAlmacenFinal, NOW(), _precioTotal);
		 
		 ELSE
		 
		 	SELECT ac.precioTotal INTO _precioFinalAlmacenDestino FROM almacencentral ac WHERE ac.almacenACentral = _idAlmacenFinal AND ac.idProductoACentral = _idProducto;
		 
		 	SELECT sumSomting(_pz,_totalpzDos) INTO _sumPz;
	    	SELECT sumSomting(_peso,_psoDosFinal) INTO _sumPeso;
			     	 
	    	SELECT sumSomting(_precioTotal,_precioFinalAlmacenDestino) INTO _precioFinalSumado;
		
		
			UPDATE almacencentral
					SET						
						pesoACentral=_sumPeso,
						cantidadPzACentral=_sumPz,
						precioTotal = _precioFinalSumado
					WHERE 
						idProductoACentral=_idProducto
						and
						almacenACentral = _idAlmacenFinal;
		END IF;
			
			SELECT ac.precioTotal INTO _totalALmacenIncial FROM almacencentral ac 
			WHERE ac.almacenACentral = _idAlmacenInicial
			AND ac.idProductoACentral = _idProducto;
		
		
		 select restSomting(_precioTotal,_precioTotal ) INTO _restarTotales;
		
		UPDATE almacencentral
			SET				
				pesoACentral=_restarPesoTotal,
				cantidadPzACentral=_restarPzTotal,
				precioTotal=_restarTotales
			WHERE 	
					idProductoACentral=_idProducto AND 
					loteACentral=_lote AND
					almacenACentral=_idAlmacenInicial;
					
	 	
	END
	
//