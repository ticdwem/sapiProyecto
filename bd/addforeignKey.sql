ALTER TABLE ventaterminada ADD CONSTRAINT fk_ventaterminadaNotaVenta FOREIGN KEY (idNotaVendida,idClientePedido) REFERENCES notaventa(idNotaVendida,idCliente)