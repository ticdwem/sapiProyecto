create VIEW viewPedidosProducto as
SELECT pd.*, pro.nombreProducto,pro.DescripcionProducto,pro.precioProductoUnidad,pro.UnidadMedidaProducto,pro.presentacionProducto FROM pedidos pd
INNER JOIN producto pro
ON pd.idProductoPedido = pro.idProducto
-- WHERE pd.idnotaPedido = 6810



