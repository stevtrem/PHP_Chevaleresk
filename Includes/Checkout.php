<?php
    require_once 'Includes/SessionChecker.php'; 
    require_once 'Includes/dbh.php';

    if(isset($_POST['checkout'])) {
        $params = array($_SESSION['Id']);

        $sql = "exec Checkout";
                  
        $stmt = sqlsrv_query($conn, $sql, $params);
    }
    else {
        header('Location:Panier.php');
        $_SESSION['checkoutError'] = 'Impossible de finaliser la commande';
        exit();
    }