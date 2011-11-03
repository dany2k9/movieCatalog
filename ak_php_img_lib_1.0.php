<?php
//Funcion para redimensionar cualquier imagen jpg, gif o png
function ak_img_resize($target, $newcopy, $w, $h, $ext){
	list($w_orig, $h_orig) = getimagesize($target);
	$scale_ratio = $w_orig / $h_orig;
	//cuando se llama a la funcion se le pasan los valores 200 y 150 --> scale ratio = 1,33
	//$w y $h representan los valores que se pasan al llamar a la funcion, no
	//los valores de ancho y alto de la imagen original
	//$w = 150 * 1.33 = 200
	//si pasaramos valores como 150 y 200 --> scale ratio = 0.75
	//$h = 150 / 0.75 = 200	
	if(($w / $h) > $scale_ratio){
		$w = $h * $scale_ratio;
	}else{
		$h = $w / $scale_ratio;
	}

$img = "";
if($ext == "gif" || $ext == "GIF"){
	$img = imagecreatefromgif($target);
}else if($ext == "png" || $ext == "PNG"){
	$img = imagecreatefrompng($target);
}else{
	$img = imagecreatefromjpeg($target);
}
$tci = imagecreatetruecolor($w, $h);
imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
imagejpeg($tci, $newcopy, 80);
}
?>