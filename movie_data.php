<?php 
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
$mov = new Movies();
$mymovies = $mov->get_discs($_SESSION["session_video_user_25"]);

?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>	
	<link href="estilo_min.css" rel="stylesheet"/>
	<title>Detalle </title>	
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/Ed_Gein_400.font.js" type="text/javascript"></script>
	<script type="text/javascript">
		Cufon.replace('a,h2, #tit',{
			textShadow: '0px 0px 1px #ffffff'
		});
	</script>	
	</head>
	<body>
<div id="page_wrapper">

<?php
include_once('simple_html_dom.php');
//print_r($_POST);
//print_r($_GET);
// Create DOM from URL or file
$html = file_get_html('http://www.filmaffinity.com'. $_GET["mid"]);

?>
		
	<form method='post' action='insert.php' id="logueo2" enctype="multipart/form-data">
	
<?	

foreach($html->find("a[class='lightbox']") as $img);
{
	
	echo "<div style='float:right;margin-right:-240px;margin-top:4%'>"; // imagen
	if(isset($img->href))
	{
		$critic = $html->find("table[valign='baseline']", 0);
		
		$twit= $html->find("tr td[align='center']", 5)->outertext;

		$text1 =$critic->parent();
		
		$cadena1= $text1->plaintext;
		
		//plot
		$criticas = preg_split('(----------------------------------------)' ,$cadena1);
		$criticas2 = preg_split('(----------------------------------------)', $criticas[1]);
       
		echo "<div style='float:right;margin-right: 10px;margin-top:4%'>"; 
		echo $twit;
		echo "</div>";
	   
	}else
	{
		$poster = $html->find("table[class='ot']", 1)->find('img', 2);
		echo "<div style='float:right;margin-right:-80px;margin-top:12%;width:250px'>"; //div
		echo "<img src='".$poster->src."'/><br />";
		echo "sin imagen<br />";
			
	?>
	
	<input type="file" name="ima_new" id="ima_new" size="1" style=""/><br />
	<!--<a href="#" id="search_img">Buscar</a>-->
	<div id="miload"></div>
	<!--<iframe id="second" src="http://www.google.com.ar/imghp?hl=es&tab=wi" frameborder="0" width="280" height="390">-->
	<a href="#" id="link">FilmAffinity</a>
	<?
	
		echo "</div>"; //div
	}
	echo "</div>";  // imagen
?>
		
<?	
}
//imagen
?> <textarea id="var1" style="display:none;">http://www.filmaffinity.com<? echo $_GET["mid"]?></textarea> <?
?>
<input type="hidden" name="ima2" value="<? echo $img->href ?>"/>
<?
//toda la data menos el ranking
foreach($html->find("table[valign=baseline]") as $item);
{
    $text =$item->parent();
		
		$cadena= $text->plaintext;
		

		echo "<div style='float:left;width:50%; margin-top: -19px'>";    //inicio del div con la data
		
		//titulo
		$tit = preg_split('(TÍTULO ORIGINAL)' ,$cadena);
		$new_tit = preg_split('(AÑO)', $tit[1]);
        $clean_tit = substr($new_tit[0], 12, -1);
		$new_tit = preg_replace('#[’\']#', '`', $clean_tit);
		//$new_tit = preg_replace('#[ô]#', 'o', $clean_tit);
		$new_tit = preg_replace('#[ôóøòö]#', 'o', $new_tit);
		$new_tit = preg_replace('#[êéèë]#', 'e', $new_tit);
		$new_tit = preg_replace('#[îíìï]#', 'i', $new_tit);
		$new_tit = preg_replace('#[ûúùü]#', 'u', $new_tit);
		$new_tit = preg_replace('#[âáàäåã]#', 'a', $new_tit);
		$new_tit = preg_replace('#[•\#]#', '', $new_tit);
		$new_tit = preg_replace('#[²]#', '2', $new_tit);
		$new_tit = preg_replace('#[À]#', 'A', $new_tit);
		echo "<b class='title'>Titulo Original: </b><input type=text id='tit' name='tit' readonly='readonly' value='". str_replace("&amp;", "and", $new_tit)."' style='width:400px' />";
		//titulo
		
				
		//plot
		$Lines = preg_split('(SINOPSIS)' ,$cadena);
		$new_line = preg_split('(FILMAFFINITY)', $Lines[1]);
		$clean_line = preg_replace('#[\']#', '&#96;', $new_line);
		//$clean_line = preg_replace('#[\']#', '&#96;', $new_line);
		$clean_line = preg_replace('#[ô]#', 'o', $new_line);
        $clean = substr($clean_line[0], 12, -1);
		echo "<b class='title' >Plot:</b><textarea name='plot' id='plot_data' cols='73' rows='11' readonly='readonly'>".$clean."</textarea>";
		//plot
		
//-------------------------------------------------------------------------		
		//length
 		$length = preg_split('(DURACIÓN)' ,$cadena);
		
		$new_length = preg_split('(min)', $length[1]);
		
        $clean_length = substr($new_length[0], 32, -1);
		echo "<b class='title' >Duracion:</b>&nbsp;&nbsp;<input type=text id='length_data' name='length' readonly='readonly' value='".$clean_length."'/><br />";	
		
		//length
//-------------------------------------------------------------------------	
	
		//director
		$dir = preg_split('(DIRECTOR)' ,$cadena);
		$new_dir = preg_split('(GUIÓN)', $dir[1]);
        $clean_dir = substr($new_dir[0], 12, -1);
		$clean_dir = preg_replace('#[’\']#', '&#96;', $clean_dir);
		
		echo "<b class='title' >Directors: </b><textarea name='dir' id='dir_data' cols='73' rows='2' readonly='readonly'>".$clean_dir." </textarea><br />";
		//director
		
		//cast
		$cast = preg_split('(REPARTO)' ,$cadena);
		$new_cast = preg_split('(PRODUCTORA)', $cast[1]);
        $clean_cast = substr($new_cast[0], 11);
		$text_cast = preg_replace('#  #', ' ', $clean_cast);
		$text_cast = preg_replace('#\'#', '´', $text_cast);
		$text_cast = preg_replace('#ô#', 'o', $text_cast);
		$text_cast = preg_replace('#â#', 'a', $text_cast);
		$text_cast = preg_replace('#û#', 'u', $text_cast);
		
		echo "<b class='title' >Cast:</b><textarea name='cast' id='cast_data' cols='73' rows='3' readonly='readonly'>".$text_cast."</textarea>";
		//cast
		
		//genre
		$genre = preg_split('(GÉNERO)' ,$cadena);
		$new_genre = preg_split('(\||SINOPSIS)', $genre[1]);
        $clean_genre = substr($new_genre[0], 2, 120);
		
		$text = preg_replace('#[ó]#', 'o', $clean_genre);
		$text = preg_replace('#[á]#', 'a', $text);
		$text = preg_replace('#[í]#', 'i', $text);
		$text = preg_replace('#[é]#', 'e', $text);
		$text = preg_replace('#[^-a-zA-Z0-9ñ_.]#', '-', $text);
		$text = trim($text);
		$text = preg_replace('#[-_]+#', ' ', $text);
		
		$genre_to_view = substr($text, 1, -1);
		
		echo "<b class='title' >Genero:</b><textarea name='genre' id='genre_data' cols='68' rows='1.5' readonly='readonly'>".$genre_to_view.'.'."</textarea><br />";
		//genre
		$kaboom = explode(".", $genre_to_view);

		 $opciones = implode("--",$kaboom);
		 
		 for($i = 0; $i < sizeof($kaboom); $i++)
		 {
		 ?><input type="hidden" name="genre<? echo $i ?>" value="<? echo $kaboom[$i]; ?>"/><?php
		 }
		?><input type="hidden" name="totalgenres" value="<? echo sizeof($kaboom); ?>"/><?php
		
		//year
		$year = preg_split('(AÑO)' ,$cadena);
		$new_year = preg_split('(DURACIÓN)', $year[1]);
		$year = preg_split('(Ver trailer externo)', $new_year[0]);
        $clean_year = substr($year[0], 0);
		
		$year_clean = ereg_replace("[^0-9\.\,&quot;:&nbsp]", "", $clean_year);
		
		echo "<b class='title' >Año:</b>&nbsp;&nbsp;<input type=text id='year_data' name='year' readonly='readonly' value='".$year_clean."'/>";
		//year
		echo "</div>";       //fin del div con la data
	}
	
//toda la data menos el ranking
	
//ranking	

	foreach($html->find("td[Style]") as $rank) 
	{
	$items['ranking'] = $rank->plaintext;
	
	$ranks[] = $items;
	
	}
    echo "<div style='clear:left;margin-left:.1%;margin-top:-25%;z-index:3000' id='rank_contenedor'>";
	echo "<b class='title' >Rank:</b><input type=text id='rank_data' name='rank' readonly='readonly' value='".$ranks[1]['ranking']."' />";
	
//ranking

	foreach($html->find("img[width]") as $star) 
	{
	$items['rank_stars'] = $star->src;
	
	$stars[] = $items;
	
	}
	
	echo "<img src='".$stars[0]['rank_stars']."' name='stars'/>";
	
	echo "</div>";

	?><input type="hidden" name="user" value="<? echo $_SESSION["session_video_user_25"]?>"/><?php 
	?><input type="hidden" name="stars" value="<? echo $stars[0]['rank_stars'] ?>"/><?php 
		
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

	echo "<select name='disctextarea' id='disco'>";
	for($i =0; $i < sizeof($mymovies); $i++)
	{
		echo "<option value='".$mymovies[$i]['disco']."'>".$mymovies[$i]['disco']."</option>";
	}
	echo "</select>";
	echo "</div>"; //div disco

	echo "<div id='newDisc'>&nbsp;<a href='#' class='titleIndex2'>Nuevo Disco</a></div><div id='newDiscVal'><b class='title' >Disco:</b>&nbsp;&nbsp;<input type='text' size='2' maxlength='3'/></div>";

	
	echo "<input type='submit' value='Agregar'/>";

?>
</form>
<div style='float:right;width:180px;margin-right:1%;margin-top:75px'>
	  <a href='movies.php' title='Ver Movies'><img src='clapboard2.png' alt='logo' width="80px" height="67px"/></a>
</div>
</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>   
<script>!window.jQuery && document.write('<script src="jquery-1.5.1.min.js"><\/script>')</script>
<script type="text/javascript">
		$(document).ready(function(){
		$("#plot_data, #dir_data, #cast_data, #genre_data, #year_data, #tit, #rank_data, #length_data").css({'background-color': '#FFF', 'border': '0', 'color': '#336699', 'font-size' : '12px', 'overflow' : 'auto'});
		
		$('#add').css({'height' : '700px', 'padding' : '2%', 'margin-left' : '200px', 'width' : '610px', 'background-color' : '#FFF', 'border' : '1px solid #000'});
		
		$("#search_img").click(function(mievento){
			mievento.preventDefault();
			var test = $("#tit").val();

			$("#miload").html("<iframe src='http://www.google.com.ar/images?q=" + test + "' frameborder='0' width='280' height='320'>");
		});
		$("#link").click(function(mievento){
			mievento.preventDefault();
			var test2 = $("#var1").val();
			$("#miload").html("<iframe src='" + test2 + "' frameborder='0' width='280' height='320'>");
		});
		
		$('#newDisc').click(function(){
			$(this).css('display', 'none');
			$('#existDisc').css('display', 'none');
			$('#newDiscVal').css('visibility', 'visible');
			$('#disco').attr('name', '');
			$('#newDiscVal input').attr('name', 'disctextarea');
			$('#newDiscVal input').focus();
			});

		});
</script>	
</html>
<?php 
}
?>