<?php
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
/* $conexion=mysql_connect("localhost", "root", "");
mysql_select_db("movies_fa"); */

$sql = "select * from movies_users";
$res = mysql_query($sql, Conectar::con());
if($res)
{
	echo "<div></div>";
}else
{
//echo "error";
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
<link href="estilo_min.css" type="text/css" rel="stylesheet" />

<div id='page_wrapper'>
	<div style="width:100%;height:305px;margin-top:-3px;background-color:#1a82f7;">
		<div style='width:200px;margin-left:356px;margin-top:0;'>
			<a title='Movies 2k11'><img src='clapboard2.png' alt='logo' /></a>
		</div>

	</div>

	<center>
	<div style="float:left;border:1px solid #ccc;margin:10px 0 0 370px;width:300px;padding:15px;background-color:#1a82f7;">
	<form action="add_user.php" name="form" method="post">

			<h2 class="titleIndex">Ingrese sus datos</h2>
			<p style="font-family:Impact, Arial, Helvetica, sans-serif;font-size:18px;line-height:31px;color:#FFF;">Nombre: </p><input type="text" name="nom" />
			<br />
			<p style="font-family:Impact, Arial, Helvetica, sans-serif;font-size:18px;line-height:31px;color:#FFF;">Password: </p><input type="password" name="pass" />
			<br /><br />

			<a href="#" class="titleIndex2" title="Agregar" onclick="document.form.submit();">Agregar</a>

	</form>
	</div>
	</center>
</div>
<?php

}else
{
//echo "debe loguearse";
echo "<script type='text/javascript'>
       alert('Debe loguearse');
       window.location='index.php';
       </script>";
}
?>