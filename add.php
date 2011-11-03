<?php 
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{

$mov = new Movies();
$mydiscs = $mov->get_discs($_SESSION["session_video_user_25"]);
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>	
	<title>:: Agregar Manualmente ::</title>
	<link href="estilo_min.css" type="text/css" rel="stylesheet" />
	<script language="javascript" type="text/javascript" src="funciones.js"></script>
</head>
<body>
	<div id='page_wrapper2'>
	<form action="insert_new.php" name="form" method="post" id="logueo" enctype="multipart/form-data">
		<b class='title' >Titulo Original:</b><input type=text id='tit' name='tit' value='' style='width:200px' /><br />
		<b class='title' >Plot:</b><br /><textarea name='plot' id='plot_data' cols='40' rows='10' ></textarea><br />
		<b class='title' >Duracion:</b>&nbsp;&nbsp;<input type=text id='length_data' name='length' value=''/><br />
		<b class='title' >Directors:</b><br /><textarea name='dir' id='dir_data' cols='40' rows='2' > </textarea><br />
		<b class='title' >Cast:</b><br /><textarea name='cast' id='cast_data' cols='40' rows='3' ></textarea><br />
		<b class='title' >Generos:</b><!--<textarea name='genre' id='genre_data' cols='40' rows='1' ></textarea>-->
		<?php 
		
		if (isset($_POST['genre_']))
		{
		?>
		<label for="genre_">
		<?php
			echo $_POST['genre_']
		?>
		</label>
		<?php
		}
		
		?>
		<select name="genre_" id='genre_data'><option value="Genero">Genero...</option>
		<option value="Accion">Acci&oacute;n</option>
		<option value="Animacion">Animaci&oacute;n</option>
		<option value="Aventuras">Aventuras</option>
		<option value="Belico">B&eacute;lico</option>
		<option value="Ciencia ficcion">Ciencia ficci&oacute;n</option>
		<option value="Cine negro">Cine negro</option>
		<option value="Comedia">Comedia</option>
		<option value="Desconocido">Desconocido</option>
		<option value="Documental">Documental</option>
		<option value="Drama">Drama</option>
		<option value="Fantastico">Fant&aacute;stico</option>
		<option value="Infantil">Infantil</option>
		<option value="Intriga">Intriga</option>
		<option value="Musical">Musical</option>
		<option value="Romance">Romance</option>
		<option value="Terror">Terror</option>
		<option value="Thriller">Thriller</option>
		<option value="Western">Western</option>
		</select>&nbsp;<br />
		
		
		
		<b class='title' >A&ntilde;o:<!--</b><input type=text id='year_data' name='year' value=''/>-->
		<select name="year" id="year_data">
		<option value="Seleccione">Seleccione...</option>
		<?php 
		for($i = 1950; $i <= date("Y"); $i++){
			echo "<option value='".$i."'>".$i."</option>";
		}
		?>
		</select>
		
		<br />
		<b class='title' >Rank:</b>
		<select name="rank" id="rank_data">
		<option value="Seleccione">Seleccione...</option>
		<?php 
		for($i = 2; $i < 9.9; $i = $i + 0.1){
			echo "<option value='".$i."'>".$i."</option>";
		}
		?>
		</select>
		
		<!--<b class='title' >Estrellas</b>-->
		<?php 
		
		?>
		<img id='ima_stars' src="" alt="" />
		
		<input type="hidden" name="stars" id="stars" value=""/>
		<br />
		<b class='title' >Imagen:</b><input type="file" name="ima_new" required size="1"/>
	<br />
	<?
	if (isset($_POST['disctextarea']))
	{
	?>
		<label for="disctextarea">
	<?php
		echo $_POST['disctextarea']
	?>
		</label>

	<?php
	}

	echo "<div id='existDisc'>"; //div disco
	echo "<b class='title' >Disco:</b>&nbsp;&nbsp;";

	echo "<select name='disctextarea' id='disco'>
	<option value='disco'>Disco...</option>";
	
	for($i =0; $i < sizeof($mydiscs); $i++)
	{
		echo "<option value='".$mydiscs[$i]['disco']."'>".$mydiscs[$i]['disco']."</option>";
	}
	echo "</select>";
	echo "</div>"; //div disco

	echo "<div id='newDisc'>&nbsp;<a href='#' class='titleIndex2'>Nuevo Disco</a></div><div id='newDiscVal'><b class='title' >Disco:</b>&nbsp;&nbsp;<input type='text' size='2' maxlength='3'/></div>";
	?>
	<?
	if (isset($_POST['stars']))
	{
	?>
		<label for="stars">
	<?php
		echo $_POST['stars']
	?>
		</label>

	<?php
	}
	?>

	<!--<input type="submit" value="Agregar" />-->
	<input type="button" value="Agregar" title="Agregar" onclick="valida_ingreso()"/>
	</form>
	</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>   
<script>!window.jQuery && document.write('<script src="jquery-1.5.1.min.js"><\/script>')</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#plot_data, #dir_data, #cast_data, #genre_data, #year_data, #tit, #rank_data, #length_data, #disco").css({'background-color': '#FFF', 'border': '0', 'color': '#336699', 'font-size' : '12px', 'overflow' : 'hidden'});
		
	/* 	$("#otraC").click(function(){
			$("#genre2").css('display', 'block');
			$(this).css('display', 'none');
			
		}); */
		
		$('#newDisc').click(function(){
			$(this).css('display', 'none');
			$('#existDisc').css('display', 'none');
			$('#newDiscVal').css('visibility', 'visible');
			$('#disco').attr('name', '');
			$('#newDiscVal input').attr('name', 'disctextarea');
			$('#newDiscVal input').focus();
		});
			
		$("#rank_data").change(function(){
			//$('#ima_stars').html();
			//alert($(this).val());
			var value = $(this).val();
			if(value >= 2 && value <= 2.9){
			value2 = 'images/2.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/2.gif'; 
			}
			if(value >= 3 && value <= 3.9){
			value2 = 'images/3.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/3.gif'; 
			}
			if(value >= 4 && value <= 4.9){
			value2 = 'images/4.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/4.gif'; 
			}
			if(value >= 5 && value <= 5.9){
			value2 = 'images/5.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/5.gif'; 
			}
			if(value >= 6 && value <= 6.9){
			value2 = 'images/6.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/6.gif'; 
			}
			if(value >= 7 && value <= 7.9){
			value2 = 'images/7.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/7.gif'; 
			}
			if(value >= 8 && value <= 8.9){
			value2 = 'images/8.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/8.gif'; 
			}
			if(value >= 9 && value <= 9.9){
			value2 = 'images/9.gif';
			value_ima = 'http://www.filmaffinity.com/imgs/ratings/9.gif'; 
			}
			$('#ima_stars').attr('src', value2);
			$('#stars').attr('value', value_ima);
		});
		
	});
</script>	
</html>

<?php
}
?>