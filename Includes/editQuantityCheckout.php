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