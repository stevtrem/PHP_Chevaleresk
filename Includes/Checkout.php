<?php
    require_once 'SessionChecker.php'; 
    require_once 'dbh.php';

    $params = array($_SESSION['Id']);

    $sql = "exec Checkout @idJoueur = ?";
                
    $stmt = sqlsrv_query($conn, $sql, $params);

    if( $stmt === false ) {
        $_SESSION['checkoutError']='La transaction est refusée';
        header('Location:../Panier.php');
        exit();
    }
?>
    