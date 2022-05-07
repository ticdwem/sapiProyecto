DELIMITER //
	CREATE FUNCTION restaArticulos(_numUno INT, _numDos int) 
	RETURNS INT 
	DETERMINISTIC
	BEGIN
		DECLARE contador INT;	
		SET contador = _numUno - _numDos;	
		RETURN contador;	
	END

//