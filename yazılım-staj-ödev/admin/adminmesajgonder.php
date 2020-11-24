<?php 

include '../baglan.php';
// admin giriş sorgusu
ob_start();
session_start();


if (isset($_POST['amesajat'])) 

{

  $bayi_id = htmlspecialchars($_POST["bayi_id"]); 
   $teklif_id = htmlspecialchars($_POST["teklif_id"]); 
    $mesaj = htmlspecialchars($_POST["mesaj"]); 
     $admin_id = htmlspecialchars($_POST["admin_id"]); 
  $kaydet=$db->prepare("INSERT into tickets set
    
    mesaj=:mesaj,
    teklif_id=:teklif_id,
    bayi_id=:bayi_id,
   
    admin_id=:admin_id
    

    ");
  
  $insert=$kaydet->execute(array(

    'mesaj'=>$mesaj,
    'teklif_id'=>$teklif_id,
    'bayi_id'=>$bayi_id,
    'admin_id'=>$admin_id
  ));
}

if ($insert) 

{
  header("Location:adminmesaj.php?deneme=$teklif_id&deneme1=$bayi_id");
    # code...
}
else{

  header("Location:adminmesaj.php");
}

?>