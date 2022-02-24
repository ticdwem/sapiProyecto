/*select cli.idCliente AS idCliente,cli.nombreCliente AS nombreCliente,cli.rfcCliente AS rfcCliente,cont.nombreContatoCliente AS nombreContatoCliente,cont.telPrinContactoCliente AS telPrinContactoCliente,
cont.telSecundarioContactoCliente AS telSecundarioContactoCliente,cont.correoContactoSecundario AS correoContactoSecundario 
FROM 
	cliente cli join contactocliente cont on((cli.idCliente = cont.idContactoCliente))*/
CREATE VIEW clientePedido AS  
SELECT cli.idCliente AS id,cli.nombreCliente AS nombre, domcli.rutaId AS idruta, rta.nombreRuta AS nomRuta, concli.nombreContatoCliente AS nomCon, concli.telPrinContactoCliente,concli.telSecundarioContactoCliente AS telSecundario
	FROM cliente cli
		INNER JOIN domiciliocliente domcli
			ON domcli.clienteId = cli.idCliente
		INNER JOIN contactocliente concli
			ON concli.idDomContactoCliente = domcli.idDomicilioCliente
		INNER JOIN ruta rta
			ON rta.idRuta = domcli.rutaId;

