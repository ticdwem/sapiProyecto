 /* SELECT * FROM historico_pedidos p
WHERE p.fechaAltaProductoPedido BETWEEN (CURDATE() - interval 34 DAY) AND CURDATE()
GROUP BY p.idnotaPedido; */

SELECT p.fechaAltaProductoPedido FROM historico_pedidos p
WHERE p.fechaAltaProductoPedido BETWEEN (CURDATE() - interval 34 DAY) AND CURDATE()
GROUP BY p.fechaAltaProductoPedido;