<?php

/* 
 * creamos la conexion a la base de datos en una clase estatica
 */
class Database{
    /* public static function connect(){
        $conexion = new mysqli('107.180.2.159', 'pilarica2021', 'GR^lAr]{nI{L', 'sapi');
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    } */
    public static function connect(){
        $conexion = new mysqli('192.168.1.20', 'pilarica', 'Pilarica2021', 'sapi');
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}

