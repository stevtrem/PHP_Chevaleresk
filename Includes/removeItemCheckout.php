<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if (isset($_GET['item'])){      
        $params = array($_SESSION['Id'],$_GET['item']);
        $sql = "delete from Panier where idJoueur = ? and idItem = ?";
        
        $stmt = sqlsrv_query($conn, $sql, $params);
        
        sqlsrv_close($conn);
    
        $_SESSION['removeItemSuccess'] = "L'Item a été enlevé du panier avec succès";
        header('Location:../Panier.php');
        exit();
    }
    else {
        header('Location:../Panier.php');
        $_SESSION['removeCheckoutError'] = 'Impossible d\'enlever l\'item';
        exit();
    }
