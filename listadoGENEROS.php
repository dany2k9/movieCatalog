<?php
require_once("class_movies.php");
//print_r($_POST); 
if($_SESSION["session_video_user_25"])
{

$sql = "select DISTINCT genres".$_SESSION["session_video_user_25"].".generos, ".$_SESSION["session_video_user_25"].".titulo, ".$_SESSION["session_video_user_25"].".img_thumb FROM genres".$_SESSION["session_video_user_25"].", ".$_SESSION["session_video_user_25"]."
where
generos = '".$_POST['variable']."' and
".$_SESSION["session_video_user_25"].".titulo = genres".$_SESSION["session_video_user_25"].".id_movie order by genres".$_SESSION["session_video_user_25"].".id_movie asc";
$res = mysql_query($sql, Conectar::con());

	while($reg=mysql_fetch_array($res))
	{
	?>
	<a href='#' onclick='return false' onmousedown='javascript:swapContent("<? echo $reg['titulo']?>");' id='linkBtn' onblur=''><img src="<? echo $reg['img_thumb']?>" title="<? echo rtrim($reg['titulo'])?>" id='thumbIndex'/></a>
	<?
	} 

$sql2 = "SELECT * FROM ".$_SESSION["session_video_user_25"]." WHERE disco IS NOT NULL and disco != 0 and disco = '".$_POST['variable2']."' order by titulo asc";
$res2 = mysql_query($sql2, Conectar::con()); 

	while($reg2=mysql_fetch_array($res2))
	{
	?>
	<a href='#' onclick='return false' onmousedown='javascript:swapContent("<? echo $reg2['titulo']?>");' id='linkBtn' onblur=''><img src="<? echo $reg2['img_thumb']?>" title="<? echo rtrim($reg2['titulo'])?>" id='thumbIndex'/></a>
	<?
	} 
} 
?>

