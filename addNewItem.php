<?php
   require_once 'Includes/AdminChecker.php';
   require_once 'Includes/htmlUtilities.php';

   $addNewItemError = isset($_SESSION['addNewItemError']) ? $_SESSION['addNewItemError'] : "";
   $uploadError = isset($_SESSION['uploadError']) ? $_SESSION['uploadError'] : "";

   unset($_SESSION['uploadError']);
   unset($_SESSION['addNewItemError']);
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
      <title>Administration - Ajout d'item</title>
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
      <link rel="stylesheet" href="css/admin.css">
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
                           <div class="logo"> <a href="index.html"><img src="images/logo.png" alt="#"></a> </div>
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
      <section id="sectionMain">
            <span class="error"><?php echo $addNewItemError . $uploadError ?></span>
            <a href="./admin.php">
               <span class="glyphicon glyphicon-menu-left"><span  style="font-family: cinzel;">Retour</span></span>
            </a>
            <h3>
               Ajouter un Item
            </h3>
         <hr/>
         <form id="addItemForm" action="Includes/addNewItem.php" method="POST" enctype="multipart/form-data">
            <input class="inputAddItem step1" placeholder="Nom" id="itemName" type="text" name="itemName" maxlength="32"/>
            <input class="inputAddItem step1" placeholder="Quantité en stock" id="qtStock" type="number" min="1" name="qtStock"/>
            <input class="inputAddItem step1" placeholder="prix" id="price" type="number" min="1" name="price"/>
            <span id="labelImageUpload" class="step1">Image de l'item :</span>
            <label id="uploadFileCustom">
               <input accept="image/*" id="fileInput" type="file" name="pic"/>
               <img id="imageDisplayAddItem" src="./images/MissingImageIcon.jpg" alt="Your Image :" width="100" height="100"/>
            </label>
            <select value=" " id="selectAddItem" class="step1" name="type">
               <option style="display:none" value=""></option>
               <option value="wpn">Arme</option>
               <option value="arm">Armure</option>
               <option value="pot">Potion</option>
               <option value="res">Ressource</option>
            </select>
            <input id="backAddItem" type="button" value="Retour">
            <input class="inputAddItem step2 wpn" placeholder="Efficacité" type="number" name="efficacite" id="efficacite" />
            <input class="inputAddItem step2 wpn" placeholder="Genre de l'arme" type="text" name="genre" id="genre" maxlength="32"/>
            <input class="inputAddItem step2 wpn" placeholder="Description de l'arme" type="text" name="descriptionArme" id="descriptionArme" maxlength="256"/>
            <input class="inputAddItem step2 arm" placeholder="Matière" type="text" name="matiere" id="matiere" maxlength="32"/>
            <input class="inputAddItem step2 arm" placeholder="Poids" type="text" name="poids" id="poids" maxlength="16"/>
            <input class="inputAddItem step2 arm" placeholder="Taille" type="text" name="taille" id="taille" maxlength="32"/>
            <input class="inputAddItem step2 pot" placeholder="Effet" type="text" name="effet" id="effet" maxlength="128"/>
            <input class="inputAddItem step2 pot" placeholder="Durée" type="number" name="duree" id="duree"/>
            <input class="inputAddItem step2 res" placeholder="Description Ressource" type="text" name="descriptionRes" id="descriptionRes" maxlength="64"/>
            <hr />

            <span id="errorAddItem">Un ou plusieurs champs sont invalides</span>
            <input id="submitAddItem" type="submit" name="submit" value="Soumettre"/>
         </form>
      </section>
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="js/addNewItem.js"></script>
   </body>
</html>