<?php
require_once("class_movies.php");
$titl = $_GET['idVar'];
$sql = "SELECT * FROM ".$_SESSION["session_video_user_25"]." WHERE titulo = '$titl' ";
$res = mysql_query($sql, Conectar::con());
//print_r($_POST);

////////////////////////////////////////////////////////////////////////////////////////////////////
while($row=mysql_fetch_array($res))
{
?>
<!DOCTYPE html>
<html>
<head>
<title>Detalles</title>
<meta charset="UTF-8">
<link href="estilo_min.css" rel="stylesheet"/>
<script src="funciones.js"></script>
</head>
<body>
<div style="margin-right:12px">
<!-- titulo -->
	<h1 class="title"><? echo substr($_GET['idVar'], 0, 25)?></h1>
<br />
<!-- imagen-->
<img src="<? echo $row["img_thumb"]?>" name='ima' width="60px" height="80px">
<!-- imagen-->
<br />

<!-- los datos del juego -->

	<div style="float:right;margin-top:-90px;margin-left:75px;font-size:10px;line-height: 12px;"><p> <? echo utf8_encode(substr($row["plot"], 0, 135)); ?></p></div>
	<div style="float:right;margin-top:-1px;margin-left:15px;"><img <?php echo $row["stars"]; ?> alt="" /></div>
	<?php
	switch ($row["stars"]) {
	case "http://www.filmaffinity.com/imgs/ratings/2.gif":
        echo "<img src='images/2.gif'>";
        break;
	case "http://www.filmaffinity.com/imgs/ratings/3.gif":
         echo "<img src='images/3.gif'>";
        break;
	case "http://www.filmaffinity.com/imgs/ratings/4.gif":
         echo "<img src='images/4.gif'>";
        break;
	case "http://www.filmaffinity.com/imgs/ratings/5.gif":
         echo "<img src='images/5.gif'>";
        break;
	case "http://www.filmaffinity.com/imgs/ratings/6.gif":
         echo "<img src='images/6.gif'>";
        break;
    case "http://www.filmaffinity.com/imgs/ratings/7.gif":
         echo "<img src='images/7.gif'>";
        break;
    case "http://www.filmaffinity.com/imgs/ratings/8.gif":
         echo "<img src='images/8.gif'>";
        break;
	case "http://www.filmaffinity.com/imgs/ratings/9.gif":
         echo "<img src='images/9.gif'>";
        break;
	}
	?>


</div>
<!-- los datos del juego -->

<?php
}
?>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('body').mouseover(function(){
			$('#log').css({'display' : 'none', 'z-index' : '1000'});

		});

			/* $('#data2').css({"opacity": "0.85"});
			$("#data2").delay(500).fadeIn("slow"); */


		$("#plot1, #publ, #dev, #notes").css({'background-color': '#FFFFCC', 'border': '0', 'color': '#336699', 'font-size' : '14px'});

		$("#editBtn").click(function(){
			$("#plot1, #publ, #dev, #notes").removeAttr("readonly");
			$("#plot1, #publ, #dev, #notes").css("background-color", "white");
			$("#saveBtn").css('display', 'block');
		})
		$("#editBtnImg").click(function(){
			$("#ima").css('display', 'block');
		})
	})

</script>
</html>