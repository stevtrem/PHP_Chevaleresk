<?php
    require_once 'Includes/SessionChecker.php'; 
    require_once 'Includes/dbh.php';
    require_once 'Includes/htmlUtilities.php';

    if(!isset($_GET['item']))
    {
        header('Location:Panier.php');
        $_SESSION['removeCheckoutError'] = 'Impossible de changer la quantite l\'item';
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Chevaleresk - Panier</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Css Specific to this page-->
      <link rel="stylesheet" href="css/Panier.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
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
                                 <li> <a href="index.php">Accueil</a> </li>
                                 <li><a href="shop.php">Boutique</a></li>
                                 <?php echo LoginBtn() ?>
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
      <section>
        <div id="PanierContainer">
            <div id="editCheck" class="editCheck">
                <?php
                    $idItem = $_GET['item'];

                    $params = array($idItem);
                    $sql = "select urlImageItem, prixUnitaireItem from Items where idItem = ?";

                    $stmt = sqlsrv_query($conn, $sql, $params);
                    
                    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

                    $urlImage = $row['urlImageItem'];
                    $prixUnitaire = $row['prixUnitaireItem'];

                    $params2 = array($_SESSION['Id'], $idItem);

                    $sql2 = "select qtItem from Panier where idJoueur = ? and idItem = ?";

                    $stmt = sqlsrv_query($conn, $sql2, $params2);
                    
                    $row2 = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                    
                    $qtItem = $row2['qtItem'];
                    sqlsrv_close($conn);

                    echo <<<HTML
                        <img src="images/imagesItem/{$urlImage}" height="200px" width="200px">
                        <form method="POST" action="Includes/editQuantityCheckout.php">
                           <label for="inputQt" id="labelQt">Nouvelle quantitée :</label>
                           <input id="inputQt" name="qt" type="number" min="1" class="form-control form-control-sm" value="{$qtItem}"/>
                           <input name="id" type="hidden" value="{$idItem}"/>
                           <input type="submit" name="newQt" value="Modifier la quantité"/>
                        </form>
                    HTML;
                ?>
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
