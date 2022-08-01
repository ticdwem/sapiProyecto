
DELIMITER //
DROP PROCEDURE IF EXISTS rutasManana //
	CREATE  PROCEDURE rutasManana(
	IN _date date
	)
	BEGIN
		DECLARE _countarRutas INT;
		-- DECLARE _pzInterno INT;
	
		SELECT COUNT(rc.idRutaCamioneta) INTO _countarRutas FROM rutacamioenta rc WHERE rc.fechaSalida = _date;
		
		if(_countarRutas = 0) then
			INSERT INTO rutacamioenta
				(camionetaIdCAmioneta,rutaIdRutaCamioneta,idchofer,fechaSalida)
			SELECT 1,ruta.idRuta,1,_date from ruta;
		END if;
		
			SELECT * FROM rutacamioenta rc WHERE rc.fechaSalida = _date;
 
	END
	
//