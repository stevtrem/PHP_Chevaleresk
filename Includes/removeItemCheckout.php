<?php
    session_start();
    require_once 'dbh.php';

    if (isset($_SESSION["Id"])){
        if (isset($_GET['item'])){
            $params = [$_SESSION['Id'], $_GET['item']];
        
            $params = array($_SESSION['Id'],$idItem);
            $sql = "delete from Panier where idJoueur = ? and idItem = ?";
            
            $stmt = sqlsrv_query($conn, $sql, $params);
            
            sqlsrv_close($conn);
        
            header('Location:../Panier.php');
            exit();
        }
        else {
            header('Location:../Panier.php');
            $_SESSION['removeCheckoutError'] = 'Impossible d\'enlever l\'item';
            exit();
        }
    }else{
        header('Location:../loginform.php');
        exit();
    }
?>
