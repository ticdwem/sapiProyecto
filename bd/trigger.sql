DELIMITER //
CREATE TRIGGER trgr_ventaTerminada BEFORE DELETE ON pedidos
FOR EACH ROW 
	BEGIN 
		INSERT INTO ventaterminada
				(idPeddios, idnotaPedido, idUsuarioPedido, idClientePedido, idProductoPedido, pzProductoPedido, loteProductoPedido, pesoProductoPedido, fechaAltaProductoPedido, idAlmacenPedidos, statusProductoPedido, fechaEntregaPedido)
		VALUES 
				(OLD.idPeddios, OLD.idnotaPedido, OLD.idUsuarioPedido, OLD.idClientePedido, OLD.idProductoPedido, OLD.pzProductoPedido, OLD.fechaAltaProductoPedido, OLD.statusProductoPedido,OLD.fechaEntregaPedido);
	END;
//