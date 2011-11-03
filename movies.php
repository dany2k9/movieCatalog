<?php
require_once("class_movies.php");

if($_SESSION["session_video_user_25"])
{
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>:: Movies2K11 ::</title>
	<link href="estilo_min.css" type="text/css" rel="stylesheet" />
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/Ed_Gein_400.font.js" type="text/javascript"></script>
	<script type="text/javascript">
			Cufon.replace('span,a,h2, #name, #name2, b',{
				textShadow: '0px 0px 1px #ffffff'
			});
	</script>	
</head>
<body>
<div id="data"></div>
<div id="data2"></div>
<?php
$mov = new Movies();
$mydiscs = $mov->get_discs($_SESSION["session_video_user_25"]);
$mymovies = $mov->get_movies($_SESSION["session_video_user_25"]);
$mygenres = $mov->get_genres($_SESSION["session_video_user_25"]);

//consulta para div info + botones funciones

	$nr = sizeof($mymovies);

echo "<div id='page_wrapper'>";   //-----------------------div contenedor
			if($_SESSION["session_video_user_25"] == 'dany2k9')
			{
				echo "<a href='new_user.php' class='titleIndexAdd' title='Agregar Usuario'>Agregar Usuario..</a>";
			}else
			{
				echo "";
			}	
	echo "<div class='index_body'>";   //-----------------------div data sin covers
		
		//-----------------------div logo + nombre usuario
		echo "<div id='logo'>
					<a href='movies.php' title='Ver Movies'><img src='clapboard.png' alt='logo' /></a>
					<div id='name'>".$nr."</div>
					<div id='name2'>".$_SESSION["session_video_user_25"]."</div>
			  ";
			  
		echo "</div>";
		//-----------------------div logo + nombre usuario

		echo "<div id='info2'>";       //-----------------------div info + botones funciones
			/*echo "<span class='titleIndex' >Cantidad de Movies: ".$nr."</span><br />";
			echo "<span class='titleIndex' >Estas logueado como: ".$_SESSION['session_video_user_25']."</span><br />";*/
			
			echo "<a href='home.php' class='titleIndex2' title='Agregar Movie'>Agregar Movie</a>&nbsp;&nbsp;&nbsp;";
			echo "<a href='close.php' class='titleIndex2' title='Cerrar Sesion'>Cerrar sesion</a>&nbsp;&nbsp;&nbsp;";
			echo "<a href='buscador.php' class='titleIndex2' title='Buscar Movie en la Base de Datos'>Buscar</a>&nbsp;&nbsp;&nbsp;";
			echo "<a href='add.php' class='titleIndex2' title='Agregar Manualmente'>Agregar..</a>";
			
						
		echo "</div>";                 //-----------------------div info + botones funciones
		
	echo "</div>";                         //-----------------------div data sin covers
	if($nr > 0) 
	{
	?>
	
		<div id="categories_div" style='float:left'>
			<b class='titleCateg' id="titleCateg">Categorias: </b>
			<select name='categories' id='categories'>
			<option value="SeleccioneC">Seleccione una categoria</option>
			<?
			foreach($mygenres as $gens)
			{
			echo "<option value='".$gens['generos']."'>".$gens['generos']."</option>";
			}
			?>
			</select>
			
		</div>
	<?
	}else
	{	
	echo "";
	}
	
	if($nr > 0) 
	{
	echo "<div id='discs_div' style='float:left'>"; //div disco
			echo "<b class='titleDiscs' id='titleDiscs'>Disco: </b>";

			echo "<select name='discarea' id='discarea'>";
			echo "<option value='SeleccioneD'>Seleccione un disco</option>";
			for($i =0; $i < sizeof($mydiscs); $i++)
			{
				echo "<option value='".$mydiscs[$i]['disco']."'>".$mydiscs[$i]['disco']."</option>";
			}
			echo "</select>";
	echo "</div>"; //div disco
	}else
	{
	echo "";
	}
//////////////////////////paginacion////////////////////////////////////////////////////////////

$sql = mysql_query("SELECT * FROM ".$_SESSION["session_video_user_25"], Conectar::con());

$nr = mysql_num_rows($sql);
//si estamos en una pagina diferente a la primera
if(isset($_GET['pn'])){
	$pn = preg_replace('#[^0-9]#i','',$_GET['pn']);		
}else{
	//si estamos en la primera pagina no se ha enviado pn via GET
	$pn = 1;
}
$cinco = 25;
$veinte = 50;
$todas = $nr;

if(isset($_GET['itemsPerPage'])){
	$itemsPerPage = $_GET['itemsPerPage'];
}else{
	$itemsPerPage = $nr;
}
$lastPage = @ceil($nr / $itemsPerPage);

//evitar que se pueda producir un error al ingresar un numero de pagina que no existe
if($pn < 1){                       //si es menor que 1
	$pn = 1;                       //se lo hace 1
}else if($pn > $lastPage){         //si es mayor que el numero toal de paginas	
	$pn = $lastPage;               //se hace igual a la ultima pagina
}

$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;

//si estamos en la primera pagina, se muestran el numero 1 sin link y el 2 ($add1), 
//se pasa por cabecera pn = pn + 1
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&itemsPerPage='.$itemsPerPage.'&search='.$search.'">' . $add1 . '</a> &nbsp;';
	/* $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&itemsPerPage='.$itemsPerPage.'">' . $add2 . '</a> &nbsp;'; */
	
//si estamos en la ultima pagina se muestra la pagina anterior pn = pn - 1 y
//la ultima pagina sin link	
} else if ($pn == $lastPage) {
	/* $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '&itemsPerPage='.$itemsPerPage.'">' . $sub2 . '</a> &nbsp;'; */
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&itemsPerPage='.$itemsPerPage.'&search='.$search.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	
//si la pagina es mayor que 2 y menor que la anteultima pagina, se muestran links a  dos
//paginas anterires, la actual sin link y las dos posteriores	
} else if ($pn > 1 && $pn < ($lastPage - 1)) {
	    
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 .'&itemsPerPage='.$itemsPerPage. '&search='.$search.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 .'&itemsPerPage='.$itemsPerPage. '&search='.$search.'">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 .'&itemsPerPage='.$itemsPerPage.'&search='.$search. '">' . $add2 . '</a> &nbsp;';
	
//si la pagina es mayor que 1 y menor que la ultima pagina se muestran la pagina actual 
//sin link y una anterior y otra posterior	
} else if ($pn > 1 && $pn < $lastPage) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&itemsPerPage='.$itemsPerPage. '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&itemsPerPage='.$itemsPerPage. '&search='.$search.'">' . $add1 . '</a> &nbsp;';
}

	$limit = 'LIMIT '.($pn - 1)*$itemsPerPage.','.$itemsPerPage;
	
	//consulta para mostrar informacion sql_info
	$sql2 = mysql_query("SELECT * FROM ".$_SESSION["session_video_user_25"]." ORDER BY titulo ASC $limit ", Conectar::con());

//display
// inicializa la variable para la paginacion
$paginationDisplay = ""; 

// solo funciona si la ultima pagina es mayor que 1
if ($lastPage != 1){

    // muestra el numero total de paginas y la pagina actual
    $paginationDisplay .= '<span>Pagina </span><b>' . $pn . '</b> <span>de </span><b>' . $lastPage. '</b>&nbsp; ';
	
	// lo que va entre los botones atras y siguiente
    	
    // si no esta en la ultima pagina se muestra el boton Atras notar el punto en .=
    if ($pn != 1 && $pn != $lastPage) {
        $previous = $pn - 1;
		$nextPage = $pn + 1;
		$paginationDisplay .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=1&itemsPerPage='.$itemsPerPage.'&search='.$search.'"> primera </a> &nbsp;';
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '&itemsPerPage='.$itemsPerPage.'"> Atras</a> ';
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '&itemsPerPage='.$itemsPerPage.'"> Siguiente</a> ';
		$paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
		$paginationDisplay .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $lastPage .'&itemsPerPage='.$itemsPerPage. '"> ultima </a> &nbsp;';
    }else if($pn == 1){
		$nextPage = $pn + 1;
		$paginationDisplay .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$paginationDisplay .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '&itemsPerPage='.$itemsPerPage.'&search='.$search.'"> Siguiente</a> ';
		$paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
		$paginationDisplay .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $lastPage . '&itemsPerPage='.$itemsPerPage.'&search='.$search. '"> ultima </a> &nbsp;';
	}else if($pn = $lastPage){
		$previous = $pn - 1;
		$paginationDisplay .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=1&itemsPerPage='.$itemsPerPage.'&search='.$search.'"> primera </a> &nbsp;';
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '&itemsPerPage='.$itemsPerPage. '&search='.$search.'"> Atras</a> ';
		$paginationDisplay .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
	}			
}
?>
	<!-- Botones para elegir los items a mostrar de la paginacion -->
	<?php 
	if($nr > 25) 
	{
	?>
	<br />
	&nbsp;<a href="?itemsPerPage=<?php echo $todas;?>" id="all">todas</a>
	<a href="?itemsPerPage=<?php echo $cinco;?>" id="fifty">25</a>
	<?php 
	}if($nr > 50) 
	{
	?>
	&nbsp;<a href="?itemsPerPage=<?php echo $veinte;?>" id="hundred">50</a>
	
	<?php
	}else
	{
	echo "";
	}
	if($nr > 0) 
	{
	echo "<a href='#' class='pdf' title='Exportar todas las Peliculas a un archivo PDF' onclick='window.location=\"pdf.php\"'>Exportar a PDF</a>";
	}else
	{
	echo "";
	}
	?>
	
	<!-- Botones para elegir los items a mostrar de la paginacion -->
	<?
	if($itemsPerPage != $nr)
	{
	echo "
	<div style='margin-left:58px; margin-right:58px; padding:6px; background-color:#FFF; border:#999 1px solid;' id='pag'>".$paginationDisplay."</div>
	";
	}else
	{
	echo " ";
	}
	?>
	<br />

<?
////////////////////////////////////////////////////////////////////////////////////////////////
while(@$row=mysql_fetch_assoc($sql2))
{
$separar = array(" ", ":", "-", "_", "`", "(", "#", ")", ".", "&", ",", "!", "/", "[", "]");
$full_name = $row['img_thumb'];
$explode = explode('danynew_images/thumbs/', $full_name);
?>
	
	<!-- miniaturas de los covers-->
	<span id="separador<? echo str_replace($separar, '', substr(trim($row["titulo"]), 0 , 28))?>"><a href="#" onclick="return false" onmousedown="swapContent('<?php echo rtrim($row["titulo"]); ?>')" onmouseover="tooltip('<? echo rtrim($row["titulo"]) ?>');pos(separador<? echo str_replace($separar, '', substr(trim($row["titulo"]), 0 , 28))?>, log)" id="linkBtn"><img src="<?php echo $row['img_thumb']; ?> " alt="<?php echo $explode[1]; ?>" id="thumbIndex"  /></a></span>

<?php

}
echo "<br /><br />";
//Botones para elegir los items a mostrar de la paginacion
	
	if($itemsPerPage != $nr)
	{
	echo "
	<div style='margin-left:58px; margin-right:58px; padding:6px; background-color:#FFF; border:#999 1px solid;' id='pag'>".$paginationDisplay."</div>
	";
	}else
	{
	echo " ";
	}
	?>
	<br />
<?php 	
echo "</div>";                    //-----------------------div contenedor
?>
<div id="myDiv"></div>
<div id="log"></div>
<div id="categ" title="Click para salir"></div>
<div id="discs1" title="Click para salir"></div>
<?php

}else
{
//echo "debe loguearse";
echo "<script type='text/javascript'>
       alert('Debe loguearse');
       window.location='index.php';
       </script>";
}
?>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>   
<script>!window.jQuery && document.write('<script src="jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript">
	$(document).ready(function(){
	$(window).unload(function(){
	$('#categories').val('SeleccioneC');
	$('#discarea').val('SeleccioneD');
	});

	
	$('#titleCateg').click(function(){
		$('#categories').show('slow');
		$('#titleDiscs').css('margin-left', '25px');
	});
	
	$('#titleDiscs').click(function(){
		$('#discarea').show('slow');
	});
	
	$("#linkBtn").click(function(){
			$('#myDiv').delay(500).fadeIn("slow");
		    $('#myDiv').css({'display': 'block', 'z-index' : '3000', 'background-color': '#FFF'});
			$('#data').css({"opacity": "0.85"});
			$("#data").delay(200).fadeIn("fast");
			});

		$("#linkBtn").mouseover(function(){
		$("#log").css({'display': 'block', 'z-index' : '3000', 'background-color': '#FFF'});
		$("#page_wrapper").css({'z-index' : '1000'});
		});

		$('#log').mouseover(function(){
			$("#logo").css({'margin-left' : '356px'});
			$("#info").css({'margin-top' : '-100px'});
			});
		
		$('#categories').change(function(){
			if( $(this).val() != 'SeleccioneC')
			{
				var value = $(this).val();
				$.post('listadoGENEROS.php',{ variable : $(this).val()},function(data){
					$('#categ').html("<h3 class='titleDetails'>Categoria: " + value + "</h3>" + data).show();
					$('#categ').delay(500).fadeIn("fast");
					$('#data2').css({"opacity": "0.85"});
					$("#data2").delay(200).fadeIn("slow");
				})
			}
			$(this).hide('fast').val('SeleccioneC');	
			$('#titleDiscs').css('margin-left', '205px');
        })

		
			$('#discarea').change(function(){
			
				if( $(this).val() != 'SeleccioneD')
				{
					var value = $(this).val();
					$.post('listadoGENEROS.php',{ variable2 : $(this).val()},function(data){
						$('#discs1').html("<h3 class='titleDetails'>Disco: " + value + "</h3>" + data).show();
						$('#discs1').delay(500).fadeIn("fast");
						$('#data2').css({"opacity": "0.85"});
						$("#data2").delay(200).fadeIn("slow");
					})
				}
				$(this).hide('fast');
				$(this).val('SeleccioneD');	
        })
		
		$("#categ, #discs1").click(function(){	
			$(this).delay(200).fadeOut("fast");
			$("#data2").delay(200).fadeOut("fast");
		});
	
	});

	nav = navigator.appName;

	function pos(id, elem){
			if(nav=='Microsoft Internet Explorer' || nav=='Netscape')
			{
				x=$(id).offset();
				curleft = x.left + 18;
				curtop = x.top - 370;
				$(elem).offset({top : curtop, left : curleft});
				$("#log").css({'display': 'block', 'z-index' : '3000', 'background-color': '#FFF'});
			}
			if(nav=='Opera')
			{
				x=$(id).offset();
				curleft = x.left + 18;
				curtop = x.top - 135;
				$(elem).offset({top : curtop, left : curleft});
				$("#log").css({'display': 'block', 'z-index' : '3000', 'background-color': '#FFF'});
			}
		}

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
			alert("Ha ocurrido un error, por favor intentelo mas tarde");  
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
		alert("Ha ocurrido un error, por favor intentelo mas tarde");  
			}  
		})
	}

	<!--
	//alert("Estas utilizando "+ navigator.appName);
	//-->
	</script>
</html>

