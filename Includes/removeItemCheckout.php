<?php
    require_once 'Includes/SessionChecker.php'; 
    require_once 'Includes/dbh.php';

    if(isset($_GET['idItem']))
    {
        $params = array($_SESSION['Id'], $_GET);

        $sql = "update Panier where idJoueur = ? and idItem = ?";

        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);
    }
    else {
        header('Location:Panier.php');
        $_SESSION['removeCheckoutError'] = 'Impossible d\'enlever l\'item';
        exit();
    }
   