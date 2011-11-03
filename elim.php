<?php
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
$tit = addslashes($_GET["tit"]);
$tra= new Movies;
$tra->del_movie($_SESSION["session_video_user_25"], $tit);
print_r($_GET);
}else
{
echo "error";
}
?>