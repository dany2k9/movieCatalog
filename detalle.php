<?php
require_once("class_movies.php");
//print_r($_GET); 
$titl = $_GET['idVar'];          //variable que llega por Ajax para el lightbox
$sql = "SELECT * FROM ".$_SESSION["session_video_user_25"]." WHERE titulo = '$titl' ";
$res = mysql_query($sql, Conectar::con());
while($row=mysql_fetch_array($res))
{
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Detalle</title>
	<link href="estilo_min.css" type="text/css" rel="stylesheet" />	
</head>
<body>

<!-- div principal -->
<div id='page_wrapper2'>

<!-- div titulo + eliminar + editar + editar imagen + imagen -->
<div id="divTit">
	<div  id="divData">
	<form action="" method="post" id="form" name="form">
	<h3 class="titleDetails" id="titleDetails"><?php echo utf8_encode($row["titulo"]); ?></h3>
	<a href="#" id="exit" class="salir">X</a>

	<div id="botInfoBase" class="tab"><a href="#">Info Basica</a></div><div id="botInfoExt" class="tab"><a href="#">Detalles</a></div><div id="menu">
	<a href="javascript:void(0);" onclick="eliminar('elim.php?tit=<?php echo $row["titulo"]; ?>')" class="tab">Eliminar</a><a href="javascript:void(0);" id ="editBtn" class="tab">Habilitar Editar</a><a href='#' title='Exportar todas las Peliculas a un archivo PDF' onclick='window.location="pdf_single.php?id=<?php echo $row["id_movie"];?>"' class="tab">Exportar a PDF</a><a href="#" id ="editBtnImg" class="tab" >Cambiar Imagen</a>
	<br /><br />
	</div>	
	<div id ='saveBtn' class='tab'>
	<a href="#" onclick="javascript:editar('edit.php', 'tit', 'plot', 'length', 'dir', 'cast', 'yea', 'rank', 'disk', 'id')">Guardar</a>
	</div>

	<input type="hidden" id="tit" value="<?php echo $row["titulo"]; ?>"/>
	<input type="hidden" id="id" value="<?php echo $row["id_movie"]; ?>"/>
	
	</div>
	
	<br /><br />
	<!-- imagen -->
	<img src="<?php echo $row["img_thumb"]; ?>" id="thumb" title="Click para aumentar el tama&ntilde;o" /><br />
	<!-- imagen -->
	
	<!-- form para cambiar imagen-->
	<div id="ima">
	<!--<form method="post" action="edit_ima.php?id=<? echo $row["id_movie"];?>"  enctype="multipart/form-data">
	Imagen:<input type="file" name="ima_new" required size="1" id="ima_new"/>
	<input type="hidden" id="id_movie" value="<?php echo $row["id_movie"]; ?>"/>
	<br />
	<input type="submit" value="Confirmar"/>
	</form>-->
	</div>
	<!-- 
	form para cambiar imagen-->

</div>
<!-- div titulo + eliminar + imagen -->

<!-- div data -->
<div id="datos">

	<span class="titleIndex3">Resumen:</span><div id="divData"><textarea rows="18" cols="88" readonly="readonly" id="plot" name="plot_area"><?php echo utf8_encode($row["plot"]); ?></textarea></div>
	<span class="titleIndex3">Elenco:</span><div  id="divData"><textarea rows="3" cols="85" readonly="readonly" id="cast" name="cast_area" style="overflow:hidden"><?php echo utf8_encode($row["elenco"]); ?></textarea></div>
	<span class="titleIndex3">Ranking: </span><div  id="divData"><textarea rows="1" cols="80" readonly="readonly" id="rank" name="rank_area" style="overflow:hidden"><?php echo $row["rank"]; ?></textarea></div>

</div>

<div id="datosExt">
	<span class="titleIndex3">Duraci&oacute;n:</span><div  id="divData"><textarea rows="1" cols="85" readonly="readonly" id="length" name="durac_area"><?php echo $row["duracion"]; ?> min.</textarea></div>
	<span class="titleIndex3">Director/es:</span><div  id="divData"><textarea rows="1" cols="80" readonly="readonly" id="dir" name="dir_area" style="overflow:hidden"><?php echo utf8_encode($row["director"]); ?></textarea></div>
	<span class="titleIndex3">Genero:</span><div  id="divData"><textarea rows="1" cols="80" readonly="readonly" id="genre" name="genre_area" style="overflow:hidden"><?php echo $row["genero"]; ?></textarea></div>
	<span class="titleIndex3">A&ntilde;o:</span><div  id="divData"><textarea rows="1" cols="85" readonly="readonly" id="yea" name="yea_area" style="overflow:hidden"><?php echo $row["yea"]; ?></textarea></div>
	<span class="titleIndex3">Disco:</span><div  id="divData"><textarea rows="1" cols="85" readonly="readonly" id="disk" name="disk_area" style="overflow:hidden"><?php echo $row["disco"]; ?></textarea></div>

</div>


</form>
<!-- div data -->

</div>
<!-- div principal -->
<? 
list($w_orig, $h_orig) = getimagesize($row["img"]); 
$scale_ratio = $w_orig / $h_orig;
$w = 450;
$h = 470;
if(($w / $h) > $scale_ratio){
		$w = $h * $scale_ratio;
	}else{
		$h = $w / $scale_ratio;
	}
?>
<div id="thumb_content" ><img src="<? echo $row["img"] ?>" title="Click para cerrar-Tama&ntilde;o: <? echo round($w) ?> x <? echo round($h) ?>-Tama&ntilde;o Real: <? echo $w_orig ?> x <? echo $h_orig ?>" width="<? echo $w;?>" height="<? echo $h;?>"/></div>
<?
}
?>

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
<script src="funciones.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#data').css({"opacity": "0.85"});
			$("#data").delay(200).fadeIn("slow");

		$("#exit").click(function(){
		$("#data").delay(500).fadeOut("slow");
		$("#myDiv").delay(500).fadeOut("slow");
		});

		$("#thumb").click(function(){
			$("#thumb_content").css({ "display" : "block" });
		});

		$("#thumb_content").click(function(){
			$(this).css({ "display" : "none" });
		});
		

		$("#editBtnImg").click(function(){
			//ev.preventDefault();
			$("#datos").css('margin-top', '-315px');
			var titulo = $('#id').val();
			$("#ima").css('display', 'block');
			$("#ima").load('ima_externo.php?id_movie=' + titulo);
			
		}); 

		$("#editBtn").click(function(){
			$("#plot, #length, #dir, #cast, #genre, #yea, #rank, #disk").removeAttr("readonly");
			$("#plot, #length, #dir, #cast, #genre, #yea, #rank, #disk").css("background-color", "lightblue");
			$("#saveBtn").css('display', 'block');
			
		});
		$('#botInfoExt').click(function(){
			$('#datosExt').css('display', 'block');
			$('#datos').css('display', 'none');
			$(this).addClass('fondo');
			$('#botInfoBase').removeClass('fondo');
		});
		
		$('#botInfoBase').click(function(){
			$('#datos').css('display', 'block');
			$('#datosExt').css('display', 'none');
			$(this).addClass('fondo');
			$('#botInfoExt').removeClass('fondo');
		});

	});
</script>   
</html>
