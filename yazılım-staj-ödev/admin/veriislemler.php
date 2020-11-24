<?php 

include '../baglan.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Gerekli dosyaları include ediyoruz
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/Exception.php';
require '../PHPMailer/SMTP.php';

if (isset($_POST['teklifkaydet'])) 

{
$dosyaadi=basename( $_FILES['file']['name']);
 
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
 
$teklifkonusu = htmlspecialchars($_POST["teklif_konusu"]); 
$teklif_detay= htmlspecialchars($_POST['teklif_detay']);
$teklif_detay= htmlspecialchars($_POST['bayi_id']);
$teklif_detay= htmlspecialchars($_POST['bayi_ad']);

	$kaydet=$db->prepare("INSERT into teklif set
		
		teklif_konusu=:teklif_konusu,
		teklif_detay=:teklif_detay,
		bayi_id=:bayi_id,
		bayi_ad=:bayi_ad,
		pdf=:pdf
		
		");
	
	$insert=$kaydet->execute(array(

		'teklif_konusu'=>$teklifkonusu,
		'teklif_detay'=>$_POST['teklif_detay'],
		'bayi_id'=>$_POST['bayi_id'],
		'bayi_ad'=>$_POST['bayi_ad'],
		'pdf'=> $targetfolder
		
	));

	if ($insert) 

	{
		header("Location:teklif.php");	# code...
	}
	else{
		header("Location:teklif.php");
	}



$mail = new PHPMailer(true);

try {
    //SMTP Sunucu Ayarları

$mail->CharSet = 'utf-8';
    $mail->SMTPDebug = 0;										// DEBUG Kapalı: 0, DEBUG Açık: 2 // Detaylı bilgi için: https://github.com/PHPMailer/PHPMailer/wiki/SMTP-Debugging
    $mail->isSMTP();	
    $mail->addAttachment($targetfolder,$dosyaadi);										// SMTP gönderimi kullan
    $mail->Host       = 'mail.softinyo.com';					// Email sunucu adresi. Genellikle mail.domainadi.com olarak kullanilir. Bu adresi hizmet saglayiciniza sorabilirsiniz
    $mail->SMTPAuth   = true;									// SMTP kullanici dogrulama kullan
    $mail->Username   = 'test@softinyo.com';				// SMTP sunucuda tanimli email adresi
    $mail->Password   = 'test2020!';							// SMTP email sifresi
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;			// SSL icin `PHPMailer::ENCRYPTION_SMTPS` kullanin. SSL olmadan 587 portundan gönderim icin `PHPMailer::ENCRYPTION_STARTTLS` kullanin
    $mail->Port       = 465;									// Eger yukaridaki deger `PHPMailer::ENCRYPTION_SMTPS` ise portu 465 olarak guncelleyin. Yoksa 587 olarak birakin
    $mail->setFrom('test@softinyo.com', $_POST['bayi_ad']); // Gonderen bilgileri yukaridaki $mail->Username ile aynı deger olmali

    //Alici Ayarları
    $mail->addAddress('b2b@softinyo.com', 'Alıcı Ad Soyad'); // Alıcı bilgileri
    				// İkinci alıcı bilgileri
    //$mail->addReplyTo('YANITADRESI@domainadi.com');			// Alıcı'nın emaili yanıtladığında farklı adrese göndermesini istiyorsaniz aktif edin
    //$mail->addCC('CC@domainadi.com');
    //$mail->addBCC('BCC@domainadi.com');

    // Mail Ekleri
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Attachment ekleme
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Opsiyonel isim degistirerek Attachment ekleme

    // İçerik
    $mail->isHTML(true); // Gönderimi HTML türde olsun istiyorsaniz TRUE ayarlayin. Düz yazı (Plain Text) icin FALSE kullanin
    $mail->Subject = $_POST['teklif_konusu'];
    $mail->Body    ="TEKLİF DETAYI : " .$_POST['teklif_detay'];
	
    $mail->send();
    echo 'Tebrikler! Email başarıyla gönderildi!';
} catch (Exception $e) {
    echo "Ops! Email iletilemedi. Hata: {$mail->ErrorInfo}";
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
	header("Location:teklif.php?sil=ok");

	# code...
}else {

	header("Location:teklif.php?sil=no");
}

}


if (isset($_POST['guncelle'])) 
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
$bayi_id= htmlspecialchars($_POST['bayi_id']);
$teklif_id= htmlspecialchars($_POST['teklif_id']);
$teklif_konusu= htmlspecialchars($_POST['teklif_konusu']);
$teklif_detay= htmlspecialchars($_POST['teklif_detay']);

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
header("Location:teklif.php");
}
else
{

header("Location:guncelle.php?bayi_id=$bayi_id&durum=no");

}

}











 ?>