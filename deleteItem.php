<?php
require_once 'Includes/AdminChecker.php';
require_once "Includes/htmlUtilities.php";
require_once 'Includes/dbh.php';

$accessCheck = isset($_SESSION["UnauthorizedAccess"]) ? $_SESSION["UnauthorizedAccess"] : "";
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Chevaleresk - Supprimer</title>
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
      <link rel="stylesheet" href="css/adminUI.css">
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
                                 <?php echo LoginBtn() ?>
                                 <?php echo SignupBtn() ?>
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
        <div id="boutiqueContainer">
        <span id="inventoryLabel"><a href="admin.php" data-toggle="Inventaire">INVENTAIRE DES JOUEURS</a></span>
        <span id="createItemLabel"><a href="addNewItem.php">CRÉATION D'UN ITEM</a></span>
        <span id="deleteItemLabel" style='color:#00C9ED'>SUPPRIMER UN ITEM</span>
            <div id="boutique">  
            <?php
                  $sql = "SELECT * FROM items ORDER BY prixUnitaireItem ASC";
                  $stmt = sqlsrv_query($conn, $sql);

                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
                    $dispo = $row['disponible'];
                    if ($dispo === 'O'){
                     $idItem = $row['idItem'];
                     $nomItem = $row['nomItem'];
                     $qtStock = $row['qtStockItem'];
                     $prixUnitaire = (int)$row['prixUnitaireItem'];
                     $urlItem = $row['urlImageItem'];
 
                     echo('<table><tr><th>Item</th><th>Stock</th><th>Prix</th><th>Nom</th><th></th></tr>');
                     echo <<<HTML
                     <div>
                     <tr>
                         <td>
                             <img src="images/imagesItem/{$urlItem}" height="100px" width="100px">
                         </td>
                         <td>
                             {$qtStock}
                         </td>
                         <td id="costLabel">
                             {$prixUnitaire}
                         </td>
                         <td style="font-weight:bold">
                             {$nomItem}
                         </td>
                         <td>
                             <a class="deleteItemBtn" style="color: #22a314" href="Includes/deleteItem.php?item={$idItem}">Effacer ?</a>
                         </td>
                     </tr>
                     HTML;
                     } 
                    }
                  echo('</table>');
                  sqlsrv_close($conn);
               ?>         
            <div>
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
      <?php 
         if(isset($_SESSION['deleteItemResult'])) {
            echo <<<HTML
               <script>
                  alert("{$_SESSION['deleteItemResult']}");
               </script>
            HTML;
         }
      ?>
   </body>
</html>
<?php
   unset($_SESSION["deleteItemResult"]);
?>