ALTER VIEW viewRutaCamionetaAsignada as
SELECT rc.*,rt.nombreRuta,us.nombreUsuario,CONCAT(cta.idCamioneta,' -- ',cta.placaCamioneta) AS _camioneta FROM rutacamioenta rc
INNER JOIN ruta rt
ON rc.rutaIdRutaCamioneta = rt.idRuta
INNER JOIN usuario us
ON rc.idchofer = us.idEmpleadoUsuario
INNER JOIN camioneta cta
ON rc.camionetaIdCAmioneta = cta.idCamioneta
