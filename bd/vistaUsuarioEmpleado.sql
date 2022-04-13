CREATE VIEW usuarioEmpleado AS 
SELECT * FROM empleado em
INNER JOIN usuario us
ON em.idEmpleado = us.idEmpleadoUsuario;

SELECT * FROM usuarioempleado WHERE nombreUsuario = 'mike trujillo'