DELIMITER //
DROP TRIGGER IF EXISTS trgr_ventaTerminada;
CREATE TRIGGER trgr_ventaTerminada BEFORE DELETE ON pedidos
FOR EACH ROW 
	BEGIN 
		INSERT INTO ventaterminada
				(idPeddios, idnotaPedido, idUsuarioPedido, idClientePedido, idProductoPedido, pzProductoPedido, loteProductoPedido, pesoProductoPedido, fechaAltaProductoPedido, idAlmacenPedidos, statusProductoPedido, fechaEntregaPedido,dateDrop)
		VALUES 
				(OLD.idPeddios, OLD.idnotaPedido, OLD.idUsuarioPedido, OLD.idClientePedido, OLD.idProductoPedido, OLD.pzProductoPedido,OLD.loteProductoPedido,OLD.pesoProductoPedido,OLD.fechaAltaProductoPedido,OLD.idAlmacenPedidos ,OLD.statusProductoPedido,OLD.fechaEntregaPedido,CURRENT_TIMESTAMP);
	END;
//