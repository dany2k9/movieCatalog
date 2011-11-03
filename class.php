<?php
session_start();
class Conectar
{
    public static function con()
    {
        $conexion=mysql_connect("localhost", "root", "");
		mysql_select_db("movies_fa");
        return $conexion;
    }

}
//
?>