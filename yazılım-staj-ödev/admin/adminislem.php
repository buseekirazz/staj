<?php 

include '../baglan.php';
// admin giriş sorgusu
ob_start();
session_start();
if (isset($_POST['admingiris']))

{
	$admin_name = htmlspecialchars($_POST["admin_name"]); 
	$admin_sifre = md5(htmlspecialchars($_POST["admin_sifre"])); 


$kullanicisor=$db->prepare("SELECT * FROM admin where admin_name=:name and admin_sifre=:sifre");
$kullanicisor->execute(array(
	'name'=> $admin_name,
	'sifre' => $admin_sifre
	
));
echo $say=$kullanicisor->rowCount();

if ($say==1) 

{
	$_SESSION['admin_name']=$admin_name;

	header("Location:adminpanel.php");
}
else 
{
	header("Location:index.php?durum=no");
}


}

if ($_GET['teklifsil']=="ok") 

{


	$sil=$db->prepare("DELETE from teklif where teklif_id=:id");
	$kontrol=$sil->execute(array(

		'id'=>	$_GET['teklif_id']
	));
	# code...

if ($kontrol) {
	header("Location:adminpanel.php?sil=ok");

	# code...
}else {

	header("Location:adminpanel.php?sil=no");
}

}



if (isset($_POST['aguncelle'])) 
{
 $targetfolder = "image/gorseller/pdfler/";

 $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;

 $ok=1;

$file_type=$_FILES['file']['type'];

if ($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/jpeg") {

 if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))

 {

 echo "The file ". basename( $_FILES['file']['name']). " is uploaded";

 }

 else {

 echo "Problem uploading file";

 }

}

else {

 echo "You may only upload PDFs, JPEGs or GIF files.<br>";

}
$bayi_id = htmlspecialchars($_POST["bayi_id"]); 
$teklif_id = htmlspecialchars($_POST["teklif_id"]); 

$teklif_konusu = htmlspecialchars($_POST["teklif_konusu"]); 
$teklif_detay = htmlspecialchars($_POST["teklif_detay"]); 

$teklifguncelle=$db->prepare("UPDATE teklif SET


		teklif_konusu=:teklif_konusu,
		teklif_detay=:teklif_detay,
		pdf=:file
		
		WHERE bayi_id={$_POST['bayi_id']} and teklif_id={$_POST['teklif_id']}");


$update=$teklifguncelle->execute(array(


'teklif_konusu'=> $_POST['teklif_konusu'],
'teklif_detay'=> $_POST['teklif_detay'],
'file'=>$targetfolder


));

if ($update) 
{
header("Location:adminpanel.php");
}
else
{

header("Location:admindenguncelle.php?bayi_id=$bayi_id&durum=no");

}

}


?>