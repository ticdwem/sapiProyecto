SELECT us.idEmpleadoUsuario, us.nombreUsuario FROM usuario us 
WHERE 
us.gerarquiaUsuario = 5 AND 
NOT EXISTS (SELECT * FROM rutacamioenta rc WHERE rc.idchofer = us.idUsuario AND rc.fechaSalida = '2022-08-04')