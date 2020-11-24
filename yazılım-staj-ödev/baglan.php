<?php 

try {


	$db=new PDO("mysql:localhost=;dbname=softinyo_musteri;charset=utf8",'softinyo_musteri','alpereneymen123.');
	
} 

catch (PDOException $e) 
{
	echo $e->getMessage();	
}


?>