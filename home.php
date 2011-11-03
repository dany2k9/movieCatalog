<?php 
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
echo "<div></div>";
//consulta para div info + botones funciones

		$mov = new Movies();
		$mymovies = $mov->get_movies($_SESSION["session_video_user_25"]);
		$nr = sizeof($mymovies);
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>:: Movies2k11- Buscador ::</title>
	<link href="estilo_min.css" rel="stylesheet"/>
	<link type="text/css" rel="stylesheet" href="css/jquery-ui-1.8.4.custom.css" />
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/Ed_Gein_400.font.js" type="text/javascript"></script>
	<script type="text/javascript">
			Cufon.replace('span,a,h2,p, #name_index,#name2_index',{
				textShadow: '0px 0px 1px #ffffff'
			});
	</script>	
	</head>
	<body>
		<div id='page_wrapper'>
			<div class="index_body">
				<div id='logo'>
					<a href='movies.php' title='Ver Movies'><img src='clapboard.png' alt='logo' /></a><br />
					<div id='name_index'><?php echo $nr;?></div>
					<div id='name2_index'><?php echo $_SESSION["session_video_user_25"];?></div>
				</div>
			</div>
			
			<center>
			<form action="results_filmaff2.php?id=" method="get" name="form" id="logueo">
				<p>Pelicula a buscar: </p><input type="text" name="nom" placeholder='Movie a Buscar...' required id="buscar_film"/>
				<input type="hidden" name="id" value="<?php echo $_GET["id"]?>"/>
				<br /><br />
				
				<a href="#" class="titleIndex2" title="Buscar Movie" onclick="document.form.submit();">Buscar Movie</a>
			
			</form>
			</center>
			<br />
			
		</div>
	</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#buscar_film').autocomplete({
			source : 'ajax2.php',
			select : function(event, ui){                             
   			}
		});
		$('#buscar_film').keypress(function(event){
				if(event.keyCode ==13) $('#logueo').submit();
		});		
		
	});
</script>		
</html>

<?php 
echo $_GET['id'];
}else
{
echo "debe loguearse";
}
?>