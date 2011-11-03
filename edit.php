<?php
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
//print_r($_GET);
//print_r($_POST);
if(!empty($_GET['disc']))
{
  $disc = $_GET['disc'];
}else
{
  $disc = 'null';
}

$mov = new Movies();
$edit = $mov->edit_movie($_GET['id'], $_GET['tit'], utf8_decode($_GET['plot']), $_GET['length'], $_GET['dir'], $_GET['cast'], $_GET['yea'], $_GET['rank'], $disc, $_SESSION["session_video_user_25"]);
}
?>