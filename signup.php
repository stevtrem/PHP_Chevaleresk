<?php
session_start();
require_once 'Includes/htmlUtilities.php';

if (isset($_SESSION["Id"])){
   header('Location:index.php');
   exit();
}

$firstName = isset($_SESSION['signupFirstName']) ? $_SESSION['signupFirstName'] : '';
$lastName = isset($_SESSION['signupLastName']) ? $_SESSION['signupLastName'] : '';
$alias = isset($_SESSION['signupAlias']) ? $_SESSION['signupAlias'] : '';
$password = isset($_SESSION['signupPass']) ? $_SESSION['signupPass'] : '';

$firstNameError = isset($_SESSION['firstNameError'])? $_SESSION['firstNameError'] : '';
$lastNameError = isset($_SESSION['lastNameError'])? $_SESSION['lastNameError'] : '';
$aliasError = isset($_SESSION['aliasError'])? $_SESSION['aliasError'] : '';
$passwordError = isset($_SESSION['passwordError'])? $_SESSION['passwordError'] : '';

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
      <title>Chevaleresk - S'inscrire</title>
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
      <link rel="stylesheet" href="css/signupLoginForm.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link rel="shortcut icon" type="image/ico" href="./images/favicon.ico"/>
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
                           <div class="logo"> <a href="index.php"><img src="images/logo.png" alt="#"></a> </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <div class="menu-area">
                        <div class="limit-box">
                           <nav class="main-menu">
                              <ul class="menu-area-main">
                                 <li><a href="index.php">Accueil</a> </li>
                                 <li><a href="shop.php">Boutique</a></li>
                                 <li><a href="loginForm.php">S'authentifier</a></li>
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
               <div id="signupImage"></div>
               <div id="signupLabel">S'inscrire</div>
               <div id="signupForm">
                  <hr style="background:white">
                  <form method="POST" action="Includes/authenticate.php">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Prénom" id="firstName" name="FirstName" value='<?php echo $firstName?>'>
                        <?php showError($firstNameError);?>
                     </div>
                     <div class="form-group">
                        <input  type="text" class="form-control form-control-sm" placeholder="Nom" id="lastName" name="LastName" value='<?php echo $lastName?>'>
                        <?php showError($lastNameError);?>
                     </div>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Alias" id="alias" name="Alias" value='<?php echo $alias?>'>
                        <?php showError($aliasError);?>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control form-control-sm" placeholder="Mot de passe" id="password" name="Password" value='<?php echo $password?>'>
                        <?php showError($passwordError);?>
                     </div>
                     <div class="submit_btn">
                        <button type="submit" id="submitForm" name="SubmitForm" class="btn btn-primary">S'inscrire</button>
                     </div>
                     <div class="submit_btn">
                        <input onClick="window.location.href='index.php'" type='button' id="cancelForm" name='CancelForm' class="btn btn-primary" value='Annuler'>
                     </div>
                  </form>
               </div>
            </div>
         </div>
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
      <script src="js/form.js"></script>
   </body>
</html>

<?php unset($_SESSION['firstNameError'], $_SESSION['lastNameError'], $_SESSION['aliasError'], $_SESSION['passwordError'])?>