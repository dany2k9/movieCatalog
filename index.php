<?php
require_once("class_movies.php");
$conexion = new Movies();
$sql = $conexion->check_db();

if($sql)
{
	 echo "<div></div>";

}else
{
$sql = "create database movies_fa";
$res = mysql_query($sql);
 if($res)
       {
       echo "<script type='text/javascript'>
       alert('db creada');
       window.location='index.php';
       </script>";
       }
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>:: Movies2k11 - Login ::</title>
	<link href="estilo_min.css" type="text/css" rel="stylesheet" />
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/Ed_Gein_400.font.js" type="text/javascript"></script>
	<script type="text/javascript">
			Cufon.replace('span,a,h2',{
				textShadow: '0px 0px 1px #ffffff'
			});
	</script>	
</head>
<body onload="document.form.reset();document.form.login.focus();">
<div id='page_wrapper'>
	<div class="index_body">
		<div id='logo'>
			<a title='Movies 2k11'><img src='clapboard2.png' alt='logo' /></a>
		</div>
	</div>

	<center>
	<form action="logueo.php" name="form" method="post" id="logueo">

		<h2 class="titleIndex">Ingrese su nombre de usuario</h2><br />
		<input type="text" name="login" />
		<br />
		<input type="password" name="pass" />
		<br />
		<a href="#" class="titleIndex2" onclick="document.form.submit();" title="Entrar">Entrar</a>
		<br />
		<a href="new_users.php" class="titleIndex2" title="Crear Usuario">Crear Usuario</a>

	</form>
	</center>

<?php
if(isset($_GET) and $_GET["m"] == 1)
{
	?>
	<div style="float:left;margin-top:20px;margin-left:39%;text-align:center">
	<font color="#FF0000"><strong>El usuario y/o Password no pueden estar vacio</strong></font>
	</div>
	<?

}
if(isset($_GET) and $_GET["m"] == 2)
{
	?>
	<div style="float:left;margin-top:20px;margin-left:40%;text-align:center">
	<font color="#FF0000"><strong>El usuario no existe en la base de datos</strong></font>
	</div>
	<?
}
?>
</div>
</body>
</html>