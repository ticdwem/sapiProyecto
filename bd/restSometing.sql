DELIMITER //
	CREATE FUNCTION restSomting(_numUno FLOAT , _numDos FLOAT ) 
	RETURNS FLOAT  
	DETERMINISTIC
	BEGIN
		DECLARE contador FLOAT ;	
		SET contador = _numUno - _numDos;	
		RETURN contador;	
	END

//