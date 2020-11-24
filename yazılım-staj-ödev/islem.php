<?php 
include "baglan.php";
ob_start();
session_start();
if (isset($_POST['bayigiris']))

{
	$bayi_no= htmlspecialchars($_POST['bayi_no']);
	$bayi_sifre=md5(htmlspecialchars($_POST['bayi_sifre']));

$kullanicisor=$db->prepare("SELECT * FROM bayi_login where bayi_no=:no and bayi_sifre=:sifre");
$kullanicisor->execute(array(
	'no'=> $bayi_no,
	'sifre' => $bayi_sifre
));
echo $say=$kullanicisor->rowCount();

if ($say==1) 

{
	$_SESSION['bayi_no']=$bayi_no;

	header("Location:admin/teklif.php");
}
else 
{
	header("Location:index.php?durum=no");
}
}

if (isset($_POST['bayikayit'])) 

{


$bayi_ad = htmlspecialchars($_POST["bayi_ad"]); 
$bayi_no= htmlspecialchars($_POST['bayi_no']);
$bayi_sifre= md5(htmlspecialchars($_POST['bayi_sifre']));


	$kaydet=$db->prepare("INSERT into bayi_login set
		
		bayi_ad=:bayi_ad,
		bayi_no=:bayi_no,
		bayi_sifre=:bayi_sifre
		
		");
	
	$insert=$kaydet->execute(array(

	
		'bayi_ad'=>$bayi_ad,
		'bayi_no'=>$bayi_no,
		'bayi_sifre'=>$bayi_sifre
	
		
	));

	if ($insert) 

	{
		header("Location:index.php");	# code...
	}
	else{
		header("Location:index.php");
	}

}

 ?>