<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bayi Kayıt</title>
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
			<div class="">


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
					
				     <div class="content">
        <div  class="row">
          <div class="col-md-12">
            <div style="border-radius: 25px;" class="card">
              <div class="card-header">
                <h5 class="title" style="color:#e300ff;">BAYİMİZ OLUN
              </div>
              <div class="card-body">
                <form action="islem.php" method="POST"  enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="row">
                    
                    <div class="col-md-4 px-md-1">
                      <div class="form-group">
                        <label style="text-align: center;color:#e300ff;">Bayi Ad</label>
                        <input  style="border-radius:15px; "type="text" id="first-name" name="bayi_ad"  required="required" class="form-control col-md-12 col-xs-12">
                      
                      </div>
                    </div>
                    <div class="col-md-4 px-md-1">
                      <div class="form-group">
                        <label  style="text-align: center; color:#e300ff;">Kullanıcı Ad</label>
                        <input style="border-radius:15px; " type="text" id="first-name" name="bayi_no" required="required" class="form-control col-md-12 col-xs-12">
                      
                      </div>
                    </div>
                    <div class="col-md-4 px-md-1">
                      <div class="form-group">
                        <label  style="text-align: center; color:#e300ff;">Şifre</label>
                        <input  style="border-radius:15px; " type="password" id="first-name" name="bayi_sifre" required="required" class="form-control col-md-12 col-xs-12">
                      
                      </div>
                    </div>
                  </div>
                 
      
                  
                  
                
              </div>
              <div class="card-footer">
               <button type="submit" style="color:#e300ff; border: 1px solid " name="bayikayit" class="btn" >Kayıt Ol </button>
                
              </div>
            </div>
            </form>
          </div>
         
        </div
					
				</form>
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