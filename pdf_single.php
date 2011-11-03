<?php 
require_once("class_movies.php");
require_once("class.ezpdf.php");
//print_r($_POST);
if($_SESSION["session_video_user_25"])
{

$pdf =& new Cezpdf('a3');
//seleccionamos la fuente

$sql="select * from ".$_SESSION['session_video_user_25']." WHERE id_movie = ".$_GET['id']."";
$res=mysql_query($sql, Conectar::con());

$pdf->selectFont('fonts/Helvetica.afm');

$datacreator = array (
					'Title'=>'Movies de '.$_SESSION["session_video_user_25"],
					'Author'=>$_SESSION["session_video_user_25"]
					);
$pdf->addInfo($datacreator);	
//cargamos la información en el array multidimensional llamado data

	while($reg=mysql_fetch_assoc($res)) 
    {
		$data[]=array
		(
			"title"=>$pdf->ezText("<b>".$reg['titulo']."</b>", 15),
			"plot"=>$pdf->ezText($reg['plot'], 12),
			"image"=>$pdf->ezImage($reg['img_thumb'], 20, 120, 'none', 'left'),
			"cast"=>$pdf->ezText($reg['elenco'], 12)		
		);
	}

$titles=array
	(
		"title"=>"Titulo",
		"plot"=>"Resumen",
		"image"=>"Imagen",
		"cast"=>"Elenco",	
	);
	
$options=array(
              'shadeCol'=>array(0.9,0.9,0.9),//Color de las Celdas.
              'xOrientation'=>'center',//El reporte aparecerá Centrado.
              'width'=>700//Ancho de la Tabla.
            );

$pdf->ezStream();	

}		
?>