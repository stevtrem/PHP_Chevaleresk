<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if(isset($_GET['item'])){
        $idItem = $_GET['item'];
    
        $params = array($_SESSION['Id'],$idItem);
        $sql = "exec addItem @idJoueur = ?, @idItem = ?";

        $stmt = sqlsrv_query($conn, $sql, $params);
        
        sqlsrv_close($conn);

        $_SESSION['addItemSuccess'] = 'L\'Item a été ajouté au panier avec succès';
        header('Location:../shop.php');
        exit();
    }
    else {
        header('Location:../shop.php');
        $_SESSION['addItemError'] = 'Impossible d\'ajouter l\'item au panier';
        exit();
    }