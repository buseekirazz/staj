<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bayi Giriş</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/viewportendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

<?php 

include "baglan.php";
$bayisor=$db->prepare("SELECT * FROM bayi_login where bayi_id=:id");
$bayisor->execute(array(
'id'=>1
));
$bayicek=$bayisor->fetch(PDO::FETCH_ASSOC);

?>

	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">


				<form action="islem.php" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						
						<p>


				<?php 

              if ($_GET['durum']=="no") {?>
              	<div class="alert alert-dancer">
              		<strong>HATA</strong><br>HATALI GİRİŞ
              		
              	</div>


              <?php } else if ($_GET['durum']=='cikis') {?>

              	<div class="alert alert-dancer">
<strong>Çıkış İşlemi</strong><br>başarılı
</div>
            <?php } ?>  



							
						</p>


					</span>
					
					<div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="bayi_no" placeholder="Bayi Numaranız">
						
					</div>
						
					
					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password"  placeholder="Şifreniz" name="bayi_sifre">
						
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="bayigiris" class="login100-form-btn">
							Giriş yap
						</button>
					</div>
					
					
				</form>
				<p align="right" style="color:black">KAYIT OLMAK İÇİN <a style="color:white;" href="kayit.php">TIKLAYINIZ</a></p>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="../login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/bootstrap/js/popper.js"></script>
	<script src="../login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/daterangepicker/moment.min.js"></script>
	<script src="../login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../login/js/main.js"></script>

</body>
</html>