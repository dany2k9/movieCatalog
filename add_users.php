<?php
require_once("class_movies.php");
print_r($_POST);
/* $obj = new Movies();
$obj->create_user($_POST['nom'], $_POST['pass']);
mkdir($_POST["nom"].'_images', 0777);
mkdir($_POST["nom"].'_images/thumbs', 0777); */
$adireccion="soporte@moviecatalog.herobo.com";
$asunto="Nuevo usuario desde el sitio web";
$contenidomail="Nombre : ".$_POST["nom"]."\n"
               ."Email : ".$_POST["mail"]."\n";
$dedireccion= $_POST["mail"];
mail($adireccion, $asunto, $contenidomail, $dedireccion);

if(mail)
{
	header("Location: index.php");
}else
{
	"Error";
}
?>