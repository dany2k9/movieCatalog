<?php
require_once("class.php");

class Movies
{
    
      private $movies;
	  private $platforms;
	  private $genres;
	  private $moviesPDF;
	  private $discs;
      private $movies_pdf;
	  
    public function __construct()
    {
        $this->movies=array();
		$this->platforms=array();
		$this->genres=array();
		$this->moviesPDF=array();
		$this->discs=array();
		$this->movies_pdf=array();
    }
	
	public function check_db()
	{
		$sql = mysql_select_db("movies_fa", Conectar::con());
	}
	
	public function logueo()
	{
		//print_r($_POST);
		if(empty($_POST["login"]) OR empty($_POST['pass']))
		{
			header("Location: index.php?m=1");
		}else
		{
			$sql = "select * from movies_users
					where
					nombre = '".$_POST["login"]."'
					and
					password = '".$_POST["pass"]."'
					";
			$res = mysql_query($sql, Conectar::con());
			if(mysql_num_rows($res) == 0 )
			{
				header("Location: index.php?m=2");
			}else
			{
				if($reg = mysql_fetch_array($res))
				{
					$_SESSION["session_video_user_25"] = $reg["nombre"];
					header("Location: movies.php");
				}else
				{
				
				}
			}			
		}
	}
	
	public function get_movies($user)
    {
        $sql="select * from $user order by id_movie asc";
        $res=mysql_query($sql, Conectar::con());
        while($reg=mysql_fetch_assoc($res)) 
        {
            $this->movies[]=$reg;
        }
          return $this->movies;
    }
	
	public function get_movies_for_pdf()
	{
		$sql = "select
				c.titulo,  c.plot, c.img_thumb
          from danynew as c
				";

		$res = mysql_query($sql, Conectar::con());
		while($reg = mysql_fetch_assoc($res))
		{
			$this->moviesPDF[] = $reg;
		}
			return $this->moviesPDF;
	}
	
	public function get_genres($user)
    {
        $sql="select DISTINCT generos from genres".$user." as gen order by generos asc";
        $res=mysql_query($sql, Conectar::con());
        while(@$reg=mysql_fetch_assoc($res)) 
        {
            $this->genres[]=$reg;
        }
          return $this->genres;
    }

	
	public function add_movie($id, $title, $plot, $length, $dirs, $casting, $genre, $yea, $rank, $ima, $ima_thumb, $user_db, $disc, $stars)
    {
       $sql = "insert into $user_db
              values
       ('$id', '$title', '$plot', '$length', '$dirs', '$casting', '$genre', '$yea', '$rank', '$ima', '$ima_thumb', '$disc', '$stars')";
		echo "<br />".$sql;	   
        $res = mysql_query($sql, Conectar::con());
       if($res)
       {
       echo "<script type='text/javascript'>
       alert('Movie agregada');
       window.location='home.php';
       </script>";
	   return true;
       }     
       else
       {
           echo "<br />Error al ingresar la movie";
		   return false;
       } 
    }
	
	public function add_genre($id, $genre, $user)
	{	
		$sql = "insert into genres".$user."
              values
       ('$id', '$genre')";
		echo "<br />".$sql;	   
        $res = mysql_query($sql, Conectar::con());
	}	
	
	public function del_movie($user, $id)
    {
       $sql="delete from $user
            where
            titulo = '$id'";
        $res=mysql_query($sql, Conectar::con());
         
		$sql2="delete from genres".$user."
            where
            id_movie = '$id'";
        $res2=mysql_query($sql2, Conectar::con()); 
		
        if($res AND $res2)
        {
        echo "<script type='text/javascript'>
        alert('movie borrada');
        window.location='movies.php';
        </script>"; 
        }     
        else
        {
            echo "Error";
        } 
           
    }
		
	public function create_user($name, $pass)
    {	
		$q = "select nombre from movies_users
			 where
			 nombre = '$name'
			 ";
		$result =mysql_query($q, Conectar::con());
		
		//echo $result;
		
		if(mysql_num_rows($result) > 0)
		{
			echo "<script type='text/javascript'>
			alert('El usuario ya existe');
			window.location='new_user.php';
			</script>"; 
		}else
		{
		   $sql="insert into movies_users
				values
				(null, '$name', $pass )";
			$res=mysql_query($sql, Conectar::con());
			
			$new_table = "CREATE TABLE ".$name." (
			  id_movie int(11) NOT NULL AUTO_INCREMENT,
			  titulo varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
			  plot text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
			  duracion varchar(50) NOT NULL,
			  director varchar(100) NOT NULL DEFAULT '',
			  elenco varchar(255) NOT NULL DEFAULT '',
			  genero varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
			  yea varchar(50) NOT NULL,
			  rank varchar(50) NOT NULL,
			  img varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
			  img_thumb varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
			  disco int(11) DEFAULT NULL,
			  stars varchar(100) NOT NULL DEFAULT '',
			  PRIMARY KEY (id_movie)
			) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;";

			$res2 = mysql_query($new_table, Conectar::con());
			
			$table_genres = "CREATE TABLE genres".$name." (
			  id_movie varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
			  generos varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";
			
			$res3 = mysql_query($table_genres, Conectar::con());
			echo $sql."/".$table_genres;
			if($res AND $res2 AND $res3)
			{
			echo "<script type='text/javascript'>
			alert('Usuario y Base de datos creadas');
			window.location='index.php';
			</script>"; 
			}     
			else
			{
				echo "Error";
			} 
        }   
    }

	public function get_discs($user)
    {
        $sql = "SELECT DISTINCT disco FROM ".$user." WHERE disco IS NOT NULL and disco != 0 order by disco asc";
		$res = mysql_query($sql, Conectar::con());
        while(@$reg=mysql_fetch_assoc($res)) 
        {
            $this->discs[]=$reg;
        }
          return $this->discs;
    }
	
	public function edit_movie($id, $title, $plot, $length, $dirs, $cast, $yea, $rank, $disc, $user_db)
    {
       $sql = "UPDATE ".$user_db."  
				set
				titulo = '$title',
				plot = '$plot',
				duracion = '$length',
				director = '$dirs',
				elenco = '$cast',
				yea = '$yea',
				rank = '$rank',
				disco = '$disc'
				where
				id_movie = '$id'
				";
		echo "<br />".$sql;	   
        $res = mysql_query($sql, Conectar::con());
       if($res)
       {
       echo "<script type='text/javascript'>
       alert('Pelicula modificada correctamente...');
       window.location='movies.php';
       </script>";
	   return true;
       }     
       else
       {
           echo "<br />Error al ingresar los datos";
		   return false;
       } 
    }
	
	
	public function get_movies_for_single_pdf($user, $id)
    {
        $sql="select * from $user WHERE id_movie = $id";
        $res=mysql_query($sql, Conectar::con());
        while($reg=mysql_fetch_assoc($res)) 
        {
            $this->movies_pdf[]=$reg;
        }
          return $this->movies_pdf;
    }
	
}    

?>