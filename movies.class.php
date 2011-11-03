<?php
require_once("class.php");

class Films
{
    public function buscarFilm($user, $nombreFilm){
        $datos = array();

        $sql = "SELECT * FROM $user
                WHERE titulo LIKE '%$nombreFilm%'
                ";

        $resultado = mysql_query($sql, Conectar::con());

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['titulo'],
                             "tit" => $row['id_movie']);
        }

        return $datos;
    }
}
