
DELIMITER //
DROP PROCEDURE IF EXISTS RutaAsignada //
	CREATE  PROCEDURE RutaAsignada()
	BEGIN
		DECLARE _total INT;
	
		SELECT COUNT(rutaIdRutaCamioneta) INTO _total FROM viewrutacamionetaasignada where statusRuta = 0 AND fechaSalida = CURDATE() ORDER BY rutaIdRutaCamioneta;
		
		IF(_total > 0) THEN	
			UPDATE rutacamioenta SET rutacamioenta.statusRuta = 1; 
		END IF;
	END
	
//