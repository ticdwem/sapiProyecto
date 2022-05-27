
DELIMITER //
DROP PROCEDURE IF EXISTS updateVentaLote //
	CREATE  PROCEDURE updateVentaLote(
	IN _lote INT, /* lote del producto*/
	IN _peso FLOAT,  /*Peso del porducto*/
	IN _producto INT, /* id del prodcuto*/
	IN _nota INT, /*numero de nota de pedidos*/
	IN _notaVenta VARCHAR(20), /* numero de nota de venta*/
	IN _numPiezas INT, /* numero de piezas*/
	IN _idUsuario INT, /* id del usuario que hace la venta*/
	IN _almacen INT /* id del almacen */
	)
	BEGIN
		DECLARE _totalProductos INT;
		DECLARE _resultRest INT;
		DECLARE _resultPesoCentral FLOAT;
		DECLARE _pesoAlmacen FLOAT;
		DECLARE _totalPeso FLOAT;

-- obtenemos el total de piezas en la tabla de almacen central de cada producto
	SELECT ac.cantidadPzACentral INTO _totalProductos FROM almacencentral ac 
																		WHERE ac.idProductoACentral = _producto 
																		AND ac.almacenACentral = _almacen;
		-- restamos la cantidad total de piezas en almacen central y las piezas que mandamos 
		SELECT restaArticulos(_totalProductos, _numPiezas) INTO _resultRest;
	
	
	
		-- actualizamos la tabla pedidos
		UPDATE pedidos SET                                
                         loteProductoPedido=_lote,
                         pesoProductoPedido=_peso,
                         idUsuarioVenta = _idUsuario,
                         idNotaVendida = _notaVenta
                     WHERE 
                          idProductoPedido=_producto  AND 
                           idnotaPedido=_nota AND 
                           idAlmacenPedidos = _almacen;
   
	   SELECT sacarPeso(_producto, _lote, _almacen) INTO _pesoAlmacen;
	   SELECT restSomting(_pesoAlmacen,_peso) INTO _totalPeso;
		/* actuzlaizamos las piez<as*/
		UPDATE almacencentral
								SET	
									cantidadPzACentral= _resultRest,
									pesoACentral = _totalPeso
								WHERE
									idProductoACentral=_producto AND 
									loteACentral= _lote AND 
									almacenACentral=_almacen;
	END
	
//