
DELIMITER //
DROP PROCEDURE IF EXISTS stockPRduct //
	CREATE  PROCEDURE stockPRduct(
	IN _idProd INT,
	IN _Almc INT,
	IN _pzOut INT
	)
	BEGIN
		DECLARE _total INT;
		DECLARE _pzInterno INT;
	
		SELECT ac.cantidadPzACentral INTO _pzInterno FROM almacencentral ac WHERE ac.idProductoACentral = _idProd AND ac.almacenACentral = _Almc;
		
		IF(_pzInterno >= _pzOut) THEN	
			SET _total = (SELECT restaArticulos(_pzInterno, _pzOut));
		ELSE 
			SET _total = -1;
		END IF;
		SELECT _total;
	END
	
//