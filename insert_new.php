<?php
require_once('class_movies.php');
if($_SESSION["session_video_user_25"])
{
	$sql = "select titulo from ".$_SESSION["session_video_user_25"]." where titulo = '".$_POST['tit']."'";
	$res = mysql_query($sql, Conectar::con());
	if($reg=mysql_fetch_object($res)>0)
	{
     echo "<script type='text/javascript'>
        alert('La pelicula ya existe');
        window.location='movies.php';
        </script>"; 
    return false;
	}
	else
	{
		$mov = new Movies();
		
		$tit =  htmlspecialchars(trim($_POST['tit']));
		$tit =  rtrim($tit);
		$plot = htmlspecialchars(trim($_POST['plot']));
		$length = htmlspecialchars(trim($_POST['length']));
		$dir = htmlspecialchars(trim($_POST['dir']));
		$cast = htmlspecialchars(trim($_POST['cast']));
		
		$year = htmlspecialchars(trim($_POST['year']));
		$rank = htmlspecialchars(trim($_POST['rank']));
		$disctextarea = htmlspecialchars(trim($_POST['disctextarea']));
		$stars = htmlspecialchars(trim($_POST['stars']));
		
		print_r($_POST);
		print_r($_GET);
		
		$genre1 = htmlspecialchars(trim($_POST['genre_']));
		//$genre2 = $_POST['genre2'];
		
		//////////////////////////////////////////////////////////////////////////////////////////////////
	    if(isset($_FILES["ima_new"]["name"]) AND !empty($_FILES["ima_new"]["name"])) //si se agrega img manualmente
		{
			$foto=$_FILES["ima_new"]["name"];
			$temp=$_FILES["ima_new"]["tmp_name"];
		
		
			$nombre_foto = $_SESSION["session_video_user_25"]."_".$foto;
			if(!is_file($_SESSION["session_video_user_25"]."_images/".$nombre_foto))//si no existe en el disco
			{	
				copy($temp, $_SESSION["session_video_user_25"]."_images/".$nombre_foto);
				
				//thumbnails
				$moveResult = copy($temp, $_SESSION["session_video_user_25"]."_images/thumbs/".$nombre_foto);

				$kaboom = explode(".", $nombre_foto); // Divide el nombre del archivo en un array en funcion del punto
				$fileExt = end($kaboom);

				include_once("ak_php_img_lib_1.0.php");
				$target_file = $_SESSION["session_video_user_25"]."_images/thumbs/".$nombre_foto;
				$resized_file = $_SESSION["session_video_user_25"]."_images/thumbs/resized_".$nombre_foto;
				$wmax = 280;
				$hmax = 250;
				ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
				unlink($target_file);
			
				
				/* $add = $mov->add_movie(null, $_POST['tit'], htmlentities($_POST['plot']), $_POST['length'], $_POST['dir'], $_POST['cast'], $_POST['genre_'], $_POST['year'], $_POST['rank'], $_SESSION["session_video_user_25"]."_images/".$_SESSION["session_video_user_25"]."_".$foto, $_SESSION["session_video_user_25"]."_images/thumbs/resized_".$nombre_foto, $_SESSION["session_video_user_25"], $_POST['disctextarea'], $_POST['stars']); */
				
				$add = $mov->add_movie(null, mysql_real_escape_string($tit), mysql_real_escape_string($plot), mysql_real_escape_string($length), mysql_real_escape_string($dir), mysql_real_escape_string($cast), mysql_real_escape_string($genre1), mysql_real_escape_string($year), mysql_real_escape_string($rank), $_SESSION["session_video_user_25"]."_images/".$_SESSION["session_video_user_25"]."_".$foto, $_SESSION["session_video_user_25"]."_images/thumbs/resized_".$nombre_foto, $_SESSION["session_video_user_25"], mysql_real_escape_string($disctextarea), mysql_real_escape_string($stars));
				
				if($add)
				{
					
					$mov->add_genre($_POST['tit'], trim($genre1), $_SESSION['session_video_user_25']);
					
				}
			
			}
			else //si ya existe solo se agrega a la BD
			{
				
				/* $add = $mov->add_movie(null, $_POST['tit'], htmlentities($_POST['plot']), $_POST['length'], $_POST['dir'], $_POST['cast'], $_POST['genre_'], $_POST['year'], $_POST['rank'], $_SESSION["session_video_user_25"]."_images/".$_SESSION["session_video_user_25"]."_".$foto, $_SESSION["session_video_user_25"]."_images/thumbs/resized_".$nombre_foto, $_SESSION["session_video_user_25"], $_POST['disctextarea'], $_POST['stars']); */
				
				$add = $mov->add_movie(null, mysql_real_escape_string($tit), mysql_real_escape_string($plot), mysql_real_escape_string($length), mysql_real_escape_string($dir), mysql_real_escape_string($cast), mysql_real_escape_string($genre1), mysql_real_escape_string($year), mysql_real_escape_string($rank), $_SESSION["session_video_user_25"]."_images/".$_SESSION["session_video_user_25"]."_".$foto, $_SESSION["session_video_user_25"]."_images/thumbs/resized_".$nombre_foto, $_SESSION["session_video_user_25"], mysql_real_escape_string($disctextarea), mysql_real_escape_string($stars));
				
				if($add)
				{
					
					$mov->add_genre($_POST['tit'], trim($genre1), $_SESSION['session_video_user_25']);

				}
			 
			}
		} 
		
	}
}else
{
echo "ERROR";
}
//print_r($_POST);
?>