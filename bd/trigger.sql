DELIMITER //
CREATE TRIGGER trgr_ventaTerminada BEFORE DELETE ON pedidos
FOR EACH ROW 
	BEGIN 
		INSERT INTO ventaterminada
	(idPeddios, idnotaPedido, idUsuarioPedido, idClientePedido, idProductoPedido, pzProductoPedido, fechaAltaProductoPedido, statusProductoPedido,fechaEntregaPedido)
	VALUES (NEW.idPeddios, NEW.idnotaPedido, NEW.idUsuarioPedido, NEW.idClientePedido, NEW.idProductoPedido, NEW.pzProductoPedido, NEW.fechaAltaProductoPedido, NEW.statusProductoPedido,NEW.fechaEntregaPedido);
	END;
//