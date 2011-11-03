<?php
require_once("class_movies.php");
//print_r($_POST);
//print_r($_GET);  
if($_SESSION["session_video_user_25"])
{

//////////////////////////paginacion////////////////////////////////////////////////////////////

$sql = mysql_query("select * FROM ".$_SESSION["session_video_user_25"]." WHERE ".$_POST['search_type']." LIKE '%".$_POST['query']."%'", Conectar::con());

$nr = mysql_num_rows($sql);
//si estamos en una pagina diferente a la primera
if(isset($_POST['pn'])){
	$pn = preg_replace('#[^0-9]#i','',$_POST['pn']);		
}else{
	//si estamos en la primera pagina no se ha enviado pn via GET
	$pn = 1;
}
$cinco = 10;
$veinte = 15;
$todas = $nr;

if(isset($_POST['itemsPerPage'])){
	$itemsPerPage = $_POST['itemsPerPage'];
}else{
	$itemsPerPage = $nr;
} 
$lastPage = ceil($nr / $itemsPerPage);

//si estamos en la primera pagina, se muestran el numero 1 sin link y el 2 ($add1), 
//se pasa por cabecera pn = pn + 1

	$limit = 'LIMIT '.($pn - 1)*$itemsPerPage.','.$itemsPerPage;
	
	//consulta para mostrar informacion sql_info
	$sql2 = mysql_query("select * FROM ".$_SESSION["session_video_user_25"]." WHERE ".$_POST['search_type']." LIKE '%".$_POST['query']."%' ORDER BY ".$_POST['search_type']." ASC $limit ", Conectar::con());
	
//display
// inicializa la variable para la paginacion
$paginationDisplay = ""; 

// solo funciona si la ultima pagina es mayor que 1

    $paginationDisplay .= 'Pagina <b>' . $pn . '</b> de ' . $lastPage. '&nbsp; ';

?>

<?if($itemsPerPage != $nr)
	{
	echo "
	<div style='width:150px;margin-left:2px; margin-right:58px; margin-top:-42px; padding:3px; background-color:#FFF; ' id='pag'>".$paginationDisplay."</div>
	";
	}else
	{
	echo "";
	}
	
	echo "<br />";
//////////////////////////paginacion////////////////////////////////////////////////////////////

echo "<p id='tot' name='tot' style='display:none'>".$lastPage."</p>";
echo "Resultados: ".$nr;

echo "<br />";
while(@$row=mysql_fetch_array($sql2))
{
?>

<span id="separador<? echo str_replace($separar, '', substr($row["titulo"], 0 , 6))?>"><a href="#" onclick="return false" onmousedown="swapContent('<?php echo $row["titulo"]; ?>')" onmouseover="tooltip('<? echo $row["titulo"] ?>');pos(separador<? echo str_replace($separar, '', substr($row["titulo"], 0 , 6))?>, log)" id="linkBtn"><img src="<?php echo $row['img_thumb']; ?> " id="thumbIndex"  /></a></span>
<?

}
}
?>