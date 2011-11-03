<?php
require_once("class_movies.php");

$sql = "select * from movies_users";
$res = mysql_query($sql, Conectar::con());
if($res)
{
	echo "<div></div>";
}else
{
$sql = "use movies_fa";
$result = mysql_query($sql);
$new_table = "CREATE TABLE movies_users (
		  id_user int(11) NOT NULL AUTO_INCREMENT,
		  nombre varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
		  password varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
		  PRIMARY KEY (id_user)
		) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;";
$res = mysql_query($new_table);
 if($res)
       {
       echo "<script type='text/javascript'>
       alert('tabla creada');
       //window.location='index.php';
       </script>";
       }else
	   {
	   echo "Error";
	   }
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>:: Movies2k11 - Nuevo Usuario ::</title>
<link href="estilo_min.css" type="text/css" rel="stylesheet" />
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/Ed_Gein_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
		Cufon.replace('span,a,h2,p',{
			textShadow: '0px 0px 1px #ffffff'
		});
</script>
</head>
<body onload="document.form.reset();document.form.nom.focus();">
<div id='page_wrapper'>

	<div class="index_body">
		<div id='logo'>
			<a title='Movies 2k11'><img src='clapboard2.png' alt='logo' /></a>
		</div>
	</div>


	<center>
	<form action="add_users.php" name="form" method="post" id="logueo">

			<h2 class="titleIndex">Ingrese sus datos</h2><br />
			<p>Tenga paciencia, un nombre de usuario y password le seran enviados a su casilla de e-mail</p><br />
			<p>Nombre: </p><input type="text" name="nom" />
			<br />
			<p>E-mail: </p><input type="text" name="mail" />
			<br /><br />

			<a href="#" class="titleIndex2" title="Enviar" onclick="document.form.submit();">Enviar</a>

	</form>
	</center>
</div>
</body>
</html>