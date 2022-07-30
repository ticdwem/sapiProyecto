CREATE TABLE camioneta(
idCamioneta INT NOT NULL DEFAULT 0 COMMENT 'este es el numero con que es identificado la camioneta',
placaCamioneta VARCHAR(20) NOT NULL COMMENT ' esta es el numero de la placa de cada camioneta',
modeloCamioneta VARCHAR(50) NULL COMMENT 'este es el modelo de la camioneta',
marcaCamioneta VARCHAR(50) NULL COMMENT ' este es la amrca de la camioneta',
statusCamioneta INT NOT NULL DEFAULT 1 COMMENT '1 = camioneta activa, 2 = camioneta en reparacion, 3= camioneta descompuesta',
PRIMARY KEY(idCamioneta)
);