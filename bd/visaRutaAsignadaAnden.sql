CREATE OR REPLACE VIEW RutaAsignadaANden AS 
SELECT rt.idRuta,rt.nombreRuta,al.idAlmacen,al.nombreAlmacen,al.letraAlmacen FROM ruta rt 
INNER JOIN almacen al
ON rt.agruparRutaAlmacen = al.idAlmacen