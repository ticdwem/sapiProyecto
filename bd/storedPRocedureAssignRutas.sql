
DELIMITER //
DROP PROCEDURE IF EXISTS rutasManana //
	CREATE  PROCEDURE rutasManana(
	IN _date DATE,
	IN _idruta INT
	)
	BEGIN
		DECLARE _countarRutas INT;
		-- DECLARE _pzInterno INT;
	
		SELECT COUNT(rc.idRutaCamioneta) INTO _countarRutas FROM rutacamioenta rc WHERE rc.fechaSalida = _date AND rc.rutaIdRutaCamioneta = _idruta;
		
		if(_countarRutas > 0) then
			SELECT rc.rutaIdRutaCamioneta AS idRuta,cta.idCamioneta AS _camioneta,cta.placaCamioneta AS placa,rt.nombreRuta AS nomRuta,rc.idchofer AS idChofer,us.nombreUsuario AS nameChofer,us.telefonoContacto AS contacto FROM rutacamioenta rc 
			INNER JOIN ruta rt 
			ON rc.rutaIdRutaCamioneta = rt.idRuta
			INNER JOIN camioneta cta
			ON rc.camionetaIdCAmioneta = cta.idCamioneta
			INNER JOIN usuario us
			ON rc.idchofer = us.idUsuario
				WHERE rc.fechaSalida = _date AND rc.rutaIdRutaCamioneta = _idruta;
				
		END if;
 
	END
	
//