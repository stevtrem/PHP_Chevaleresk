<?php
session_start();
require_once "Includes/htmlUtilities.php";
require_once 'Includes/dbh.php';
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
      <title>Chevaleresk - Boutique</title>
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
      <link rel="stylesheet" href="css/edit.css">
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
      <!--<div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div> -->
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
      <section>
      <div id="boutiqueContainer">
            
            <div id="boutique">
               <?php
                  $sql = GetItemType($_GET['item']);
                  $stmt = sqlsrv_query($conn, $sql);
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){

                    if($row['typeItem'] == 'POT'){
                        $infoSql = GetInfoPotion($_GET['item']);
                        $stmtPotion = sqlsrv_query($conn, $infoSql);
                        $potion = sqlsrv_fetch_array($stmtPotion, SQLSRV_FETCH_ASSOC);

                        $nomPotion = $potion['nomItem'];
                        $qtStock = $potion['qtStockItem'];
                        $prixUnitaire = floor($potion['prixUnitaireItem']);
                        $url = $potion['urlImageItem'];
                        $effet = $potion['effet'];
                        $duree = $potion['duree'];

                        echo <<<HTML
                           <div id="containerLeft">
                              <div id="imageContainer">
                                 <div id="titre">Item:   $nomPotion</div>
                                 <hr>                                 
                                 <div id="imageItem"><img src="images/imagesItem/{$url}"></div>
                                 <hr>
                              </div>
                              <div id="Effet">
                                    <div id="info">Effet:   $effet</div>
                                    <div id="info"><hr>Duré des effets:  $duree secondes</div>  
                                    <div id="info">
                                       <hr>
                                       Quantité en Stock: $qtStock
                                       <br>
                                       Prix unitaire:  $prixUnitaire Écues
                                    </div>
                              </div>
                           </div>
                           <div id="containerRight">
                              évaluation 
                           </div>
                        HTML;
                    }
                    else if($row['typeItem'] == 'WPN'){
                       $infoSql = GetInfoArme($_GET['item']);
                       $stmtArme = sqlsrv_query($conn, $infoSql);
                       $Arme = sqlsrv_fetch_array($stmtArme, SQLSRV_FETCH_ASSOC);
                       
                       $nomArme = $Arme['nomItem'];
                       $qtStockArme = $Arme['qtStockItem'];
                       $prix = floor($Arme['prixUnitaireItem']);
                       $url = $Arme['urlImageItem'];
                       $efficacite = $Arme['efficacite'];
                       $genre = $Arme['genre'];
                       $description = $Arme['descriptionArme'];


                       echo <<<HTML
                           <div id="containerLeft">
                              <div id="imageContainer">
                                 <div id="titre">Item:   $nomArme</div>
                                 <hr>                                 
                                 <div id="imageItem"><img src="images/imagesItem/{$url}"></div>
                                 <hr>
                              </div>
                              <div id="Effet">
                                    <div id="info">
                                       Description: $description
                                       <br>
                                       Efficacité:   $efficacite
                                    </div>
                                    <div id="info"><hr>Type d'arme: $genre</div>  
                                    <div id="info">
                                       <hr>
                                       Quantité en Stock: $qtStockArme
                                       <br>
                                       Prix unitaire:  $prix Écues
                                    </div>
                              </div>
                           </div>
                           <div id="containerRight">
                              évaluation 
                           </div>
                        HTML;
                    }
                    else if($row['typeItem'] == 'ARM'){
                       $infoSql = GetInfoArmure($_GET['item']);
                       $stmtArmure = sqlsrv_query($conn, $infoSql);
                       $Armure = sqlsrv_fetch_array($stmtArmure, SQLSRV_FETCH_ASSOC);

                       $nomArmure = $Armure['nomItem'];
                       $qtStock = $Armure['qtStockItem'];
                       $prix = $Armure['prixUnitaireItem'];
                       $url = $Armure['urlImageItem'];
                       $matiere = $Armure['matiere'];
                       $poid = $Armure['poids'];
                       $taille = $Armure['taille'];

                       echo <<<HTML
                           <div id="containerLeft">
                              <div id="imageContainer">
                                 <div id="titre">Item:   $nomArmure</div>
                                 <hr>                                 
                                 <div id="imageItem"><img src="images/imagesItem/{$url}"></div>
                                 <hr>
                              </div>
                              <div id="Effet">
                                    <div id="info">
                                       Matière de l'armure: $matiere
                                    </div>
                                    <div id="info">
                                       <hr>
                                       Poids de l'armure:  $poid
                                       <br>
                                       Taille de l'armure:  $taille
                                    </div>  
                                    <div id="info">
                                       <hr>
                                       Quantité en Stock: $qtStock
                                       <br>
                                       Prix unitaire:  $prix Écues
                                    </div>
                              </div>
                           </div>
                           <div id="containerRight">
                              évaluation 
                           </div>
                        HTML;
                    }
                    else if($row['typeItem'] == 'RES'){
                       $infoSql = GetInfoRessource($_GET['item']);
                       $stmtRes = sqlsrv_query($conn, $infoSql);
                       $Ressource = sqlsrv_fetch_array($stmtRes, SQLSRV_FETCH_ASSOC);

                       $nomRessource = $Ressource['nomItem'];
                       $qtStockRes = $Ressource['qtStockItem'];
                       $prix = $Ressource['prixUnitaireItem'];
                       $url = $Ressource['urlImageItem'];
                       $description = $Ressource['description'];

                       echo <<<HTML
                           <div id="containerLeft">
                              <div id="imageContainer">
                                 <div id="titre">Ressource:   $nomRessource</div>
                                 <hr>                                 
                                 <div id="imageItem"><img src="images/imagesItem/{$url}"></div>
                                 <hr>
                              </div>
                              <div id="Effet">
                                    <div id="info">
                                       Description:  $description
                                    </div>
                                    <div id="info">
                                       <hr>
                                       Quantité en Stock: $qtStockRes
                                       <br>
                                       Prix unitaire:  $prix Écues
                                    </div>
                              </div>
                           </div>
                           <div id="containerRight">
                              évaluation 
                           </div>
                        HTML;
                    }
                  }


               ?>   
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