<?php
require_once("class_movies.php");
/* print_r($_GET);
print_r($_POST); */
if($_SESSION["session_video_user_25"])
{ 

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
.styinput 
{ 
 BORDER-RIGHT: #000000 1px solid; 
 BORDER-TOP: #000000 1px solid; 
 FONT-SIZE: 10px; 
 BORDER-LEFT: #000000 1px solid; 
 WIDTH: 110px; 
 COLOR: #000000; 
 BORDER-BOTTOM: #000000 1px solid; 
 FONT-FAMILY: Verdana, Arial, sans-serif; 
 BACKGROUND-COLOR: #ffffff 
}
	</style>
</head>
<body>
	
	<form method="post" action="edit_ima.php" enctype="multipart/form-data">
	<input class="styinput" type="file" name="ima_new" required size="1" id="ima_new"/>
	<br />
	<input type="submit" value="Confirmar"/>
	<input type="hidden" name="id" value="<?php echo $_GET["id_movie"]; ?>"/>
	</form>
	
</body>
</html>
<?php 


}
?>