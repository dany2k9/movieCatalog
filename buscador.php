<?php
require_once("class_movies.php");
//print_r($_POST); 
if($_SESSION["session_video_user_25"])
{
$mov = new Movies();
$mymovies = $mov->get_movies($_SESSION["session_video_user_25"]);
$mygenres = $mov->get_genres($_SESSION["session_video_user_25"]);

//consulta para div info + botones funciones

	$nr = sizeof($mymovies);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<link href="estilo_min.css" type="text/css" rel="stylesheet" />		
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/Ed_Gein_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
				Cufon.replace('span,a,h2, #name, #name2,b,h1',{
					textShadow: '0px 0px 1px #ffffff'
				});
		</script>	
		<title>:: Movies2k11 - Buscador::</title>
	</head>
	<body>
	<div id='page_wrapper'>
		<div id="data"></div>
		
		<div class='index_body'>
		<div style="float:left;margin-top:280px; width:102px;"><b class='title' >Paginas:</b><select id="paginas"></select></div>
			<div id='logo'>         
				<a href='movies.php' title='Ver Movies'><img src='clapboard.png' alt='logo' /></a>
				<div id='name'><?php echo $nr ?></div>
				<div id='name2'><?php echo $_SESSION["session_video_user_25"] ?></div>
					  
			</div>
			
			 <!--<?php
			 echo $_POST['tot'];
			if (isset($_POST['search_type']))
			{
			?>
				<label for="search_type"><?php
				echo $_POST['search_type']
			?>	</label>
			<?php
			}
			$pn = 1;
			
			?> -->
			
			<div id='info'>	
					<h1 class='title' >Buscar Movie</h1>
					<input type="text" name="query" id="query">
					<br />
					<b class='title' >Filtrar por:</b> 
					<select id="search_type">
					<option value="titulo">Titulo</option>
					<option value="genero">Genero</option>
					<option value="elenco">Actor</option>
					<option value="director">Director</option>
					<option value="yea">A&ntilde;o</option>
					</select>
					
					<b class='title' >Items por pagina</b><select id="items">
					<option value="15">15</option>
					<option value="25">25</option>
					<!--<option value="all">Actor</option>-->
					</select>
					
			</div>	
			<div id="categories_div" style="margin-top: 23px; margin-left : 50px">
				<b class='title' >Categorias: </b>
					<select name='categories' id='categorias'>
					<?
					foreach($mygenres as $gens)
					{
						echo "<option value='".$gens['generos']."'>".$gens['generos']."</option>";
					}
					?>
					</select>

			</div>			
					<div id="productos" style='width:100%;float:left;margin-top:45px'>
					
					</div>
				
			<div id="myDiv">My default content</div>
		</div>	
		<div id="result"></div>	
	</div>		
	</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>   
<script>!window.jQuery && document.write('<script src="jquery-1.5.1.min.js"><\/script>')</script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#linkBtn").click(function(){
			$('#myDiv').slideToggle("slow");
		    $('#myDiv').css({'display': 'block', 'z-index' : '3000', 'background-color': '#FFFFCC'});
			$('#data').css({"opacity": "0.85"});
			$("#data").delay(10).fadeIn("slow");
			});

			$("#linkBtn").mouseover(function(){
			$("#log").css({'display': 'block', 'z-index' : '3000', 'background-color': '#FFF'});
			$("#page_wrapper").css({'z-index' : '1000'});
			});
		
			
			$("#query").live('keyup', function(){
				$('#result').empty();
				$.post('buscador_query.php', { query: $("#query").val(), search_type: $('#search_type option:selected').val(), itemsPerPage : $('#items option:selected').val(), pn : $('#paginas option:selected').val() }, function(resp){
					$('#productos').empty();
					$('#productos').append(resp);
					var tot = $('#tot').text();
					tot2 = tot + 1;
					for(var i = 1; i < parseInt(tot) + 1 ; i++){
					$('#paginas').append('<option value="'+ i +'" >'+ i +'</option>');
					
					}
				});
				$('#paginas').empty();
				$('#paginas').css('visibility', 'visible');
			});

			$("#paginas").change(function(){
				$('#result').empty();
				$.post('buscador_query.php', {query: $("#query").val(), search_type: $('#search_type option:selected').val(), itemsPerPage : $('#items option:selected').val(), pn : $('#paginas option:selected').val() }, function(resp){
					$('#productos').empty();
					$('#productos').append(resp);
				});

			});		
			
		$('#categorias').change(function(){
            $.post('listadoGENEROS.php',{ variable : $(this).val()},function(data){
					$('#result').empty();
					$('#productos').empty();
					   $('#result').append(data);
                    })
			$('#paginas').css('visibility', 'hidden');		
            })
			
	});
	
	function tooltip(cv){
	$('#log').html("<img src='Loading.gif' />").show();
		$.ajax({  
			type: "GET",  
			url: 'tooltip.php?idVar=' + cv,  
			cache: true,  
			success: function(result) {  
			  $('#log').html(result).show();
			},  
			error: function(result) {  
			alert("some error occured, please try again later");  
			}  
		})
	}

	function swapContent(cv){
		$('#myDiv').html("<img src='Loading.gif' />").show();
			$.ajax({  
			type: "GET",  
			url: 'detalle.php?idVar=' + cv,  
			cache: true,  
			success: function(result) {  
			$('#myDiv').html(result).show();
		},  
			error: function(result) {  
			alert("Un error ha ocurrido, por favor pruebe mas tarde");  
			}  
		})
	}

 </script>	
</html>
<?php
}
?>