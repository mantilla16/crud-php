<?php

    /*
    * Clase para conexion a la base de datos
    * Esta clase maneja la conexión a la base de datos MySQL utilizando MySQLi.
    * Se conecta a la base de datos "tienda" en el host "localhost" con el usuario "root" y sin contraseña.
    * Se usa una instancia estática para evitar múltiples conexiones a la base de datos.
    */
class Database {

    private static $conexion;

    public static function conectar() {
        if (!isset(self::$conexion)) {
            $host = "sql10.freesqldatabase.com";
            $usuario = "sql10773860";
            $password = "K77cVIcqkA";
            $database = "sql10773860";
            $port =3306;

            self::$conexion = new mysqli($host, $usuario, $password, $database, $port);

            if (self::$conexion->connect_error) {
                die("Error al conectar a la base de datos: " . self::$conexion->connect_error);
            }
        }
        return self::$conexion;
    }
}

?>
