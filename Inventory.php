<?php 
include_once 'Includes/htmlUtilities.php';
include_once 'Includes/SessionChecker.php';
require_once 'Includes/dbh.php';

$accessCheck = isset($_SESSION["UnauthorizedAccess"]) ? $_SESSION["UnauthorizedAccess"] : "";
$params = array($_SESSION['Id']);
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
      <title>Chevaleresk - Inventaire</title>
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
      <link rel="stylesheet" href="css/.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link rel="shortcut icon" type="image/ico" href="./images/favicon.ico"/>
      <link rel="stylesheet" href="css/inventaire.css">
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
      <div id="inventaireContainer">
            <div id="inventaire">
                <?php
                  $sqlinventaire = getInventaireJoueur();
                  $stmt = sqlsrv_query($conn, $sqlinventaire, $params);
                  
                  echo('<div id="tableContainer"><table><tr><th>Item</th><th>Quantité</th></tr>');

                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                     $url = $row['urlImageItem'];
                     $qtItem = $row['qtItem'];
                     $nomItem = $row['nomItem']; 
                     $idItem = $row['idItem'];
                     echo <<<HTML
                        <tr>
                           <td>
                              {$nomItem}\n
                              <img src="./images/imagesItem/{$url}" id="imgPanierItem">
                           </td>
                           <td>
                              {$qtItem}
                           </td>
                           <td>
                              <a id="linkEval" href='EditItem.php?item={$idItem}'>Évaluer?</a>
                           </td>                          
                        </tr>
                     HTML;
                  }
                  echo('</table></div>');
                  
                  $sqlSolde = getSoldeJoueur();
                  $stmtSolde = sqlsrv_query($conn, $sqlSolde, $params);
                  $solde = sqlsrv_fetch_array( $stmtSolde, SQLSRV_FETCH_ASSOC);
                  $montant = floor($solde['montantInitial']);
                  echo <<<HTML
                  <div style="width:50%; height:10px; text-align:center;">
                     <h4>Solde restant : {$montant}</h4>
                  </div>
                  HTML;
      
                  sqlsrv_close($conn);
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