SELECT * FROM camioneta cta
WHERE NOT EXISTS (SELECT * FROM rutacamioenta rc WHERE rc.camionetaIdCAmioneta = cta.idCamioneta AND rc.fechaSalida = '20220804')