<?php
require_once("class_movies.php");
//print_r($_POST);
$obj = new Movies();
$obj->create_user($_POST['nom'], $_POST['pass']);
mkdir($_POST["nom"].'_images', 0777);
mkdir($_POST["nom"].'_images/thumbs', 0777);

?>