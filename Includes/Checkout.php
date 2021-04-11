<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    $params = array($_SESSION['Id']);

    $sql = "exec Checkout @idJoueur = ?";
                
    $stmt = sqlsrv_query($conn, $sql, $params);

    $sql2 = "select idItem from Panier where idJoueur = ?";
                
    $stmt2 = sqlsrv_query($conn, $sql2, $params);
    if(sqlsrv_fetch($stmt2) >= 1) {
        $_SESSION['checkoutError']='La transaction est refusée';
        header('Location:../Panier.php');
        exit();
    }
    else {
        $_SESSION['paymentSuccess'] = 'Le paiement a été effectué avec succès';
        header('Location:../Panier.php');
        exit();
    }
    