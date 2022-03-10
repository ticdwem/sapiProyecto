DELIMITER //
CREATE TRIGGER historico_pedido AFTER INSERT ON pedidos
FOR EACH ROW 
	BEGIN 
		INSERT INTO historico_pedidos
	(idPeddios, idnotaPedido, idUsuarioPedido, idClientePedido, idProductoPedido, pzProductoPedido, fechaAltaProductoPedido, statusProductoPedido)
	VALUES (NEW.idPeddios, NEW.idnotaPedido, NEW.idUsuarioPedido, NEW.idClientePedido, NEW.idProductoPedido, NEW.pzProductoPedido, NEW.fechaAltaProductoPedido, NEW.statusProductoPedido);
	END;
//