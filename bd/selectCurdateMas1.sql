SELECT  pr.nombreProducto AS nameP,pr.DescripcionProducto AS descripcion,np.fechaEnregaNotaPedido AS entrega,pd.idProductoPedido AS codigo, sum(pd.pzProductoPedido) AS suma FROM pedidos pd
INNER JOIN notapedido np
ON pd.idnotaPedido = np.idNotaPedido
INNER JOIN producto pr
ON pd.idProductoPedido = pr.idProducto
WHERE np.fechaEnregaNotaPedido = CURDATE()+1
GROUP BY pd.idProductoPedido
ORDER BY pd.idProductoPedido;

-- SELECT * FROM pedidos;
