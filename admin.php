<?php
require_once 'Includes/AdminChecker.php';
require_once "Includes/htmlUtilities.php";
require_once 'Includes/dbh.php';

$accessCheck = isset($_SESSION["UnauthorizedAccess"]) ? $_SESSION["UnauthorizedAccess"] : "";
$selectedAlias = isset($_SESSION["selectedPlayerAlias"]) ? $_SESSION["selectedPlayerAlias"] : "Choisir Joueur";
$fundsMsg = isset($_SESSION['fundsMsg']) ? $_SESSION['fundsMsg'] : "";
$msgColor = isset($_GET['report']) ? $_GET['report'] : "white";
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
      <title>Chevaleresk - Administration</title>
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
        <span id="inventoryLabel" style='color:#00C9ED'>INVENTAIRE DES JOUEURS</span>
        <span id="createItemLabel"><a href="addNewItem.php">CRÉATION D'UN ITEM</a></span>
        <span id="deleteItemLabel"><a href="deleteItem.php">SUPPRIMER UN ITEM</a></span>
            <div id="boutique">            
                <div>
                  <!-- Génération du select list avec ses options -->
                  <form method='POST' action='Includes/backend.php' id='selectPlayerForm'>
                     <select class="wide" id='selectPlayer' name='alias'>
                           <option data-display="<?php echo $selectedAlias ?>">Choisir Joueur</option>
                           <?php
                              $sql = "SELECT alias FROM Joueurs";
                              $stmt = sqlsrv_query($conn, $sql);

                              while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
                                 $alias = $row['alias'];
                                 if ($alias != "admin") // Ne pas afficher admin comme option
                                    echo "<option value='$alias'>$alias</option>";
                              }
                           ?>
                     </select>
                  </form>
                </div>
               <?php
               // Si un joueur a été sélectionné dans la liste
               if (isset($_SESSION['selectedPlayerAlias'])){
                    $selectedAlias = $_SESSION['selectedPlayerAlias'];
                    $sql = "SELECT idJoueur, montantInitial FROM Joueurs WHERE alias = '$selectedAlias'";
                    $stmt = sqlsrv_query($conn, $sql);
                    
                    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
                        $_SESSION['selectedPlayerId'] = $row['idJoueur']; // Aller chercher l'Id du joueur selon son alias
                        $totalFunds = $row['montantInitial'];
                    }

                    // On compte si l'id du joueur est présent à quelque part dans la table inventaireJoueur
                    $selectedId = $_SESSION['selectedPlayerId'];
                    $sql2 = "SELECT COUNT(*) as nbInsertions FROM inventaireJoueur WHERE idJoueur = $selectedId";
                    $stmt2 = sqlsrv_query($conn, $sql2);
                    while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ){
                        $nbInsertions = $row['nbInsertions'];
                    }

                    // S'il y a au moins une insertion on affiche son contenu
                    if ($nbInsertions > 0){
                        $sql3 = getItemsJoueurAdmin();
                        $stmt3 = sqlsrv_query($conn, $sql3);
    
                        while( $row = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ){
                        $nomItem = $row['nomItem'];
                        $qtStock = $row['qtItem'];
                        $urlItem = $row['urlImageItem'];
                        
                        echo('<table><tr><th>Item</th><th>Stock</th><th>Nom</th></tr>');
    
                        echo <<<HTML
                            <div>
                            <tr>
                                <td>
                                    <img src="images/imagesItem/{$urlItem}" height="100px" width="100px">
                                </td>
                                <td>
                                    {$qtStock}
                                </td>
                                <td style="font-weight:bold">
                                    {$nomItem}
                                </td>
                            </tr>
                        HTML;
                        }  
                        echo('</table>');                     
                    }else{
                        // Sinon on affiche rien
                        echo "<div class='inventoryResult'>Le joueur ne possède aucun item</div>";
                    } 
                }else{
                    // Sinon on affiche rien
                    $totalFunds = 0;
                    echo "<div class='inventoryResult'>Aucun inventaire à afficher</div>";
                }
                
                sqlsrv_free_stmt($stmt);
                sqlsrv_close($conn);
               ?>
            </div>   
            <div id='fundsPlayer'> <!-- Section d'affichage des fonds -->
               <span id='fundsPlayerText'>Total fonds : <?php echo floor($totalFunds)?> Écu(s)</span>
               <div id='addFundsReport' style='color:<?php echo $msgColor?>'><?php echo $fundsMsg ?></div>
               <?php if (isset($_SESSION['selectedPlayerAlias'])){ // On affiche l'option d'ajouter des fonds seulement si un utilisateur à été sélectionné
                  echo <<<HTML
                        <form method='POST' action='Includes/ajouterFonds.php'>
                           <input type='text' id='addFundsInput' name='AddFundsInput' placeholder='Ajouter des fonds'/>
                           <button type='submit' id="cataCross" name='SubmitFunds'></button>
                        </form><br>
                        HTML; 
                     }
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
      <?php 
         if(isset($_SESSION['addNewItem'])) {
            echo <<<HTML
               <script>
                  alert("{$_SESSION['addNewItem']}");
               </script>
            HTML;
         }
      ?>
   </body>
</html>
<?php

unset($_SESSION["UnauthorizedAccess"]);
unset($_SESSION["addItemError"]);
unset($_SESSION["fundsMsg"]);
unset($_SESSION['addNewItem']);
?>