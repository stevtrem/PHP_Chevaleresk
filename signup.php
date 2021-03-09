<?php
session_start();
//require_once 'Includes/SessionChecker.php';
require_once 'Includes/htmlUtilities.php';

$firstNameError = isset($_SESSION['firstNameError'])? $_SESSION['firstNameError'] : '';
$lastNameError = isset($_SESSION['lastNameError'])? $_SESSION['lastNameError'] : '';
$aliasError = isset($_SESSION['aliasError'])? $_SESSION['aliasError'] : '';

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Chevaleresk - Signup</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Css Specific to this page-->
      <link rel="stylesheet" href="css/signupForm.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header class="section">
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo"> <a href="index.html"><img src="images/logo.png" alt="#"></a> </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <div class="menu-area">
                        <div class="limit-box">
                           <nav class="main-menu">
                              <ul class="menu-area-main">
                                 <li> <a href="index.html">Home</a> </li>
                                 <li><a href="clients.html">Shop</a></li>
                                 <li><a href="clients.html">Login</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end header inner -->
      </header>
      <!-- end header -->
      <section >
        <div id="signupContainer">
            <div class="col-md-6" style="margin-bottom:96px">
               <div style="color: white; font-size: 32px; margin-left: 15%; margin-top: 96px">S'inscrire</div>
               <div id="signupForm">
                  <form action="Includes/authenticate.php">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Prénom" id="firstName" name="FirstName">
                        <?php showError($firstNameError); ?><br>
                     </div>
                     <div class="form-group">
                        <input  type="text" class="form-control form-control-sm" placeholder="Nom" id="lastName" name="LastName">
                        <?php showError($lastNameError); ?><br>
                     </div>
                     <div class="form-group">
                        <input  type="text" class="form-control form-control-sm" placeholder="Alias" id="alias" name="Alias">
                        <?php showError($aliasError); ?><br>
                     </div>
                     <div class="submit_btn">
                        <button type="submit" id="submitForm" name="SubmitForm" class="btn btn-primary" style="padding: 11px; float:left">S'inscrire</button>
                     </div>
                     <div class="submit_btn">
                        <input onClick="window.location.href='index.html'" type='button' id="cancelForm" name='CancelForm' class="btn btn-primary" style="padding: 11px; float:right; background:#136af8" value='Annuler'>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- ici -->
      </section>
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script src="js/form.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         
      </script> 
   </body>
</html>

<?php unset($_SESSION['firstNameError'], $_SESSION['lastNameError'], $_SESSION['aliasError'])?>