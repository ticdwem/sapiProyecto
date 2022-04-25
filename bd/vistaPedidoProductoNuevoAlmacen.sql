
select `pd`.`idPeddios` AS `idPeddios`,
`pd`.`idnotaPedido` AS `idnotaPedido`,
`pd`.`idUsuarioPedido` AS `idUsuarioPedido`,
`pd`.`idClientePedido` AS `idClientePedido`,
`pd`.`idProductoPedido` AS `idProductoPedido`,
`pd`.`pzProductoPedido` AS `pzProductoPedido`,
`pd`.`fechaAltaProductoPedido` AS `fechaAltaProductoPedido`,
`pd`.`statusProductoPedido` AS `statusProductoPedido`,
`pd`.`fechaEntregaPedido` AS `fechaEntregaPedido`,
`pd`.`idAlmacenPedidos` AS `almacen`,
`pro`.`nombreProducto` AS `nombreProducto`,
`pro`.`DescripcionProducto` AS `DescripcionProducto`,
`pro`.`precioProductoUnidad` AS `precioProductoUnidad`,
`pro`.`UnidadMedidaProducto` AS `UnidadMedidaProducto`,
`pro`.`presentacionProducto` AS `presentacionProducto` 
from (`pedidos` `pd` 
			join `producto` `pro` 
				on(
					 (`pd`.`idProductoPedido` = `pro`.`idProducto`)
					)
		)