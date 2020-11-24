<?php 

include '../baglan.php';
// admin giriş sorgusu
ob_start();
session_start();


if (isset($_POST['mesajat'])) 

{
	$bayi_id = htmlspecialchars($_POST["bayi_id"]); 
	$teklif_id = htmlspecialchars($_POST["teklif_id"]); 
	$mesaj = htmlspecialchars($_POST["mesaj"]); 
	 
	$kaydet=$db->prepare("INSERT into tickets set
		
		mesaj=:mesaj,
		teklif_id=:teklif_id,
		bayi_id=:bayi_id
		
		

		");
	
	$insert=$kaydet->execute(array(

		'mesaj'=>$mesaj,
		'teklif_id'=>$teklif_id,
		'bayi_id'=>$bayi_id
		

	));
}

if ($insert) 

{
$url = $_POST["url"];

	header("Location: http://b2b.softinyo.com$url");
}
else{

	header("Location:mesaj.php");
}

?>