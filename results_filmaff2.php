<?php 
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
?><!DOCTYPE html>
<html>
	<head>
	<meta charset=iso-8859-1/>
	<title>Detalle </title>
	<link href="estilo_min.css" rel="stylesheet"/>
	</head>
	<body>
</body>
</html>
		
<?php
include_once('simple_html_dom.php');
//print_r($_GET);
//print_r($_POST);
$html = file_get_html('http://www.filmaffinity.com/es/advsearch.php?stext='.$_GET["nom"].'&stype[]=title&genre=&country=&fromyear=&toyear=');

echo "<div id='page_wrapper'>"; //div wrapper

	echo "<div style='float:left;width:200px;margin-right:8%;margin-left:7%;margin-top:2%'>
		  <a href='movies.php' title='Ver Movies'><img src='clapboard2.png' alt='logo' width=200px height=167px/></a>
		  </div>"; //logo
		  
	echo "<h2 class='title'>Resultados de la busqueda ".$_GET['nom']."</h2>"; //header
	
	
	//buscar imagenes
	foreach($html->find("table tr td table tr td table tr td table tr td a img") as $image) 
	{
		$links['item'] = $image->src; 	
		$images[] = $links;	
	}
	$tot = sizeof($images);
	
	echo "<div style='float:left;'>"; //cover contenedor
	
		if(isset($images))
		{
			for($i = 0; $i < $tot; $i++)
			{
			echo "<div style='height:75px; width:100px; border: solid 1px blue'>";
			echo "<img src='".$images[$i]['item']."'/><br />";
			echo "</div>";
			}
		}else
		{
		echo "";
		}
	echo "</div>"; //cover contenedor

	//buscar links
	foreach($html->find("table tr td table tr td table tr td table tr td table tr td b a") as $element) 
	{
		$links['link'] = $element->href; 
		$links['text'] = $element->plaintext; 	
		$elements[] = $links;		
	}
	$tot2 = sizeof($elements);
	
	echo "<div style='float:left;margin-left:1px'>"; //titulo contenedor
		if(isset($elements))
		{
			for($i = 0; $i < $tot2; $i++)
			{
			echo "<div style='height:75px; width:300px; border: solid 1px blue'>";
			echo "<a href='movie_data.php?mid=".$elements[$i]['link']."'>".$elements[$i]['text']."</a><br>";
			echo "</div>";
			}
		}else
		{
		echo "no hay resultados";
		echo "<br /><a href='home.php'>Volver</a>";
		}
	echo "</div>"; //titulo contenedor
	
echo "</div>";  //div wrapper

}else
{
echo "debe loguearse";
}
?>
