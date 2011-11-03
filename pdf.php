<?php 
require_once("class_movies.php");
require_once("class.ezpdf.php");
if($_SESSION["session_video_user_25"])
{

$pdf =& new Cezpdf('a3');
//seleccionamos la fuente
$pdf->selectFont('fonts/Helvetica.afm');

$datacreator = array (
					'Title'=>'Movies de '.$_SESSION["session_video_user_25"],
					'Author'=>$_SESSION["session_video_user_25"]
					);
$pdf->addInfo($datacreator);	

$tra=new Movies();	
$reg=$tra->get_movies($_SESSION["session_video_user_25"]);	
//cargamos la información en el array multidimensional llamado data
$pdf->ezText("<b>Movies de ".$_SESSION["session_video_user_25"]."</b>",16);
$pdf->ezText("<b>Total de peliculas: ".sizeof($reg)."</b>\n", 15);
for ($i=0;$i<sizeof($reg);$i++)
{
	
	$data[]=array
	(
		"title"=>$pdf->ezText("<b>".$reg[$i]["titulo"]."</b>", 15),
		"plot"=>$pdf->ezText($reg[$i]["plot"], 12),
		"image"=>$pdf->ezImage($reg[$i]["img_thumb"], 20, 120, 'none', 'left')	
	);
}

$titles=array
	(
		"title"=>"Titulo",
		"plot"=>"Resumen",
		"image"=>"Imagen"	
	);
	
$options=array(
              'shadeCol'=>array(0.9,0.9,0.9),//Color de las Celdas.
              'xOrientation'=>'center',//El reporte aparecerá Centrado.
              'width'=>700//Ancho de la Tabla.
            );
				
$pdf->ezStream();	

}		
?>