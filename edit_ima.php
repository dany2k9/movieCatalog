<?php
require_once("class_movies.php");
if($_SESSION["session_video_user_25"])
{
$foto=$_FILES["ima_new"]["name"];
echo $foto;
print_r($_POST);
//print_r($_GET);	
		if(isset($_FILES["ima_new"]["name"]) AND !empty($_FILES["ima_new"]["name"]))
		{
			$foto=$_FILES["ima_new"]["name"];
			$temp=$_FILES["ima_new"]["tmp_name"];
		
		
			$nombre_foto = $_SESSION["session_video_user_25"]."_".$foto;
			if(!is_file($_SESSION["session_video_user_25"]."_images/".$nombre_foto))
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
			
			$query = "UPDATE ".$_SESSION["session_video_user_25"]."  
			set
			img = '".$_SESSION["session_video_user_25"]."_images/".$_SESSION["session_video_user_25"]."_".$foto."',
			img_thumb = '".$resized_file."'
			where
			id_movie = '".$_POST['id']."'
			";
			
			$res = mysql_query($query, Conectar::con());
			
			echo "<br />".$query;
			 if($res)
				{
				echo "<script type='text/javascript'>
				alert('Imagen modificada correctamente');
				window.location='movies.php';
				</script>"; 
				}     
				else
				{
				 echo "Error";
				} 	
			
			}else
			{
			
			$query = "UPDATE ".$_SESSION["session_video_user_25"]."  
			set
			img = '".$_SESSION["session_video_user_25"]."_images/".$nombre_foto."',
			img_thumb = '".$_SESSION["session_video_user_25"]."_images/thumbs/resized_".$nombre_foto."'
			where
			id_movie = '".$_POST['id']."'
			";
			
			$res = mysql_query($query, Conectar::con());
			echo "<br />".$query;
			 if($res)
				{
				echo "<script type='text/javascript'>
				alert('Imagen modificada correctamente');
				window.location='movies.php';
				</script>"; 
				}     
				else
				{
				 echo "Error";
				} 
			}
		}		
}	

?>