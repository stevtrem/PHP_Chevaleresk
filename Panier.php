<?php
    require_once 'Includes/SessionChecker.php';
    require_once 'Includes/htmlUtilities.php';
    require_once 'Includes/dbh.php';
    
    $payCheck = isset($_SESSION["checkoutError"]) ? $_SESSION["checkoutError"] : "";
    $removeCheck = isset($_SESSION["removeCheckoutError"]) ? $_SESSION["removeCheckoutError"] : "";
    $editCheck = isset($_SESSION['editQtError']) ? $_SESSION["editQtError"] : "";
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
      <section >
        <div id="PanierContainer">
            <div id="Panier">
                <?php
                  echo ("<div class='checkError'>$editCheck $payCheck $removeCheck</div>");
                  $totalCart = 0; 
                  $params = array($_SESSION['Id']);

                  $sql = "select * from Panier where idJoueur = ?";
                  
                  $stmt = sqlsrv_query($conn, $sql, $params);
                  
                  echo('<div id="tableContainer"><table><tr><th>Item</th><th>Quantité</th><th>Prix</th></tr>');

                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                     $idItem = $row['idItem'];
                     $qtItem = $row['qtItem'];

                     $params = array($idItem);
                     $sql = "select urlImageItem, prixUnitaireItem, nomItem from Items where idItem = ?";

                     $stmt2 = sqlsrv_query($conn, $sql, $params);
                     
                     $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);

                     $nomItem = $row2['nomItem'];
                     $urlImage = $row2['urlImageItem'];
                     $prix = $row2['prixUnitaireItem'] * $qtItem;
                     $totalCart += $prix;
                     echo <<<HTML
                        <tr>
                           <td>
                              {$nomItem}\n
                              <img src="./images/imagesItem/{$urlImage}" id="imgPanierItem">
                           </td>
                           <td>
                              {$qtItem}
                           </td>
                           <td>{$prix}</td>
                           <td>
                              <a href="editQuantityCheckout.php?item={$idItem}"><span class="glyphicon glyphicon-edit"></span></a>
                           </td>
                           <td>
                              <a href="Includes/removeItemCheckout.php?item={$idItem}"><span class="glyphicon glyphicon-remove-circle"></span></a>
                           </td>
                        </tr>
                     HTML;
                  }
                  echo('</table></div');

                  $checkout = '';
                  if ($totalCart != 0){
                     $checkout = "<a id='checkoutBtn' href='Includes/Checkout.php'>Paiement</a>";
                  }else{
                     $checkout = "<span id='emptyCart'>Le joueur n'a aucun item dans son panier</span>";
                  }

                  echo <<<HTML
                     <div style="position: sticky; display:flex; width:100%; height:100px; background-color: red">
                        <h4>Total : {$totalCart}</h4>
                        $checkout
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


<?php
unset($_SESSION["checkoutError"]);
unset($_SESSION["removeCheckoutError"]);
unset($_SESSION["editQtError"]);

?>