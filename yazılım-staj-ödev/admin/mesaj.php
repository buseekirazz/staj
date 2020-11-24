<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php include "../baglan.php"; 

ob_start();
session_start();



$kullanicisor=$db->prepare("SELECT * FROM bayi_login where bayi_no=:bayi_no");
$kullanicisor->execute(array(
'bayi_no'=>$_SESSION['bayi_no']
));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);



 $bayi_id=$kullanicicek['bayi_id'];
  $teklif=$db->prepare("SELECT * from teklif where bayi_id=:id");
  $teklif->execute(array(
  'id'=>$bayi_id
    ));
$alteklif=$teklif->fetch(PDO::FETCH_ASSOC);



$teklifsor=$db->prepare("SELECT * FROM teklif ");
$teklifsor->execute(array());
$teklifcek=$teklifsor->fetch(PDO::FETCH_ASSOC);

$adminsor=$db->prepare("SELECT * FROM admin ");
$adminsor->execute(array());
$admincek=$adminsor->fetch(PDO::FETCH_ASSOC);

$mesajsor=$db->prepare("SELECT * FROM tickets ");
$mesajsor->execute(array());
$mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC);



$say=$kullanicisor->RowCount();
$girissor=$db->prepare("SELECT * FROM admin where admin_name=:name");
$girissor->execute(array(
'admin_name'=>$_SESSION['admin_name']
));
$giriscek=$girissor->fetch(PDO::FETCH_ASSOC);


$teklifsor2=$db->prepare("SELECT * from teklif where teklif_id=:id");
$teklifsor2->execute(array(
'id'=>$_GET['id']
));
$teklifcek2=$teklifsor2->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="https://b2b.softinyo.com/admin/" />
   <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../../assets/img/favicon.png">
  <title>
    Softinyo | Bayi Panel
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../../../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../../../assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="../../../css/mesaj2.css">
    <link rel="stylesheet" type="text/css" href="../../../js/mesaj.js">

</head>

<body class="">
  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="main-panel">
      <!-- Navbar -->
     <?php include "navbar.php"; ?>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          
            
             <div class="col-md-8 col-xl-6 chat">
          <div class="card">
            
            <div class="card-body msg_card_body">

 <?php
    
    $teklif_id=$mesajcek['teklif_id'];
    $bilgilerimsor=$db->prepare("SELECT * from tickets where teklif_id=:id");
    $bilgilerimsor->execute(array(
    'id'=>$_GET['id']
    
    ));
    
    $say=0;
    while($bilgilerimcek=$bilgilerimsor->fetch(PDO::FETCH_ASSOC)) { $say++?>

              

                  
                
              <?php 
                $admin = $bilgilerimcek["admin_id"];
                if ($admin == "1"){
                  
                ?> 
                  <div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg">
                  <img src="../../../s.jpg" class="rounded-circle user_img_msg">
                </div>
                <div class="msg_cotainer">
                  <?php echo $bilgilerimcek['mesaj'];?>
                <span class="msg_time"><?php echo $bilgilerimcek['zaman']; ?></span>
                </div>
                
              </div>
               
            
              <?php }else{ #ADMİN ?>
             <div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send">
                  <?php echo $bilgilerimcek['mesaj'];?>
                  <span class="msg_time"><?php echo $bilgilerimcek['zaman']; ?></span>
                </div>
                <div class="img_cont_msg">
              <img src="../../../b.jpg" class="rounded-circle user_img_msg">  </div>
              </div>
                <?php }

                { ?>
                  

              <?php } ?>


          

              
                 <?php } ?>
              
            
              
              
            </div>
            
            <div class="card-footer">
              <form action="mesajgonder.php" method="POST">

  
  <textarea name="mesaj" class="form-control type_msg" placeholder="Mesajınızı Yazınız"></textarea>
  <input type="hidden" name="bayi_id" value="<?php echo $kullanicicek['bayi_id'];  ?>">
  <input type="hidden" name="teklif_id" value="<?php echo $_GET['id'];  ?>"><br>
   <input type="hidden" name="zaman" value="<?php echo $bilgilerimcek['zaman'];  ?>">
   <input type = "hidden" name = "url" value = "<?php echo $_SERVER["REQUEST_URI"]; ?>">
 
  
              <div class="input-group">
                
                
                
                 <button type="submit" class="btn btn-primary"  name= "mesajat" >GÖNDER</span>
                </button>

               
              </div>
              </form>

            </div>




          </div>
        </div>
          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Teklif Bilgileri</h4>
              </div>
              <div class="card-body">
                <div class="alert alert-primary">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" >
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Teklif Konusu- </b> <?php echo $teklifcek2['teklif_konusu']; ?></span>
                </div>
                <div class="alert alert-info">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" >
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Teklif Detayı - </b> <?php echo $teklifcek2['teklif_detay']; ?></span>
                </div>
                
                  
                  
                  
                  <span> <a href="<?php echo $teklifcek2['pdf'].$_FILES['file']['name'];?>"><button class="btn btn-primary">PDF</button></a></span>
         
                
                
              </div>
            </div>
          </div>
          
        </div>
      </div>
 <?php include "footer.php"; ?>
    </div>
  </div>
 <?php include "degisiklik.php"; ?>
  <!--   Core JS Files   -->
  <script src="../../../assets/js/core/jquery.min.js"></script>
  <script src="../../../assets/js/core/popper.min.js"></script>
  <script src="../../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../../../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../../../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../../../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
</body>

</html>