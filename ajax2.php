<?php
include_once 'movies.class.php';
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
$film = new Films();

echo json_encode($film->buscarFilm($_SESSION["session_video_user_25"], $_GET['term']));

}else
{
echo "error";
}
?>