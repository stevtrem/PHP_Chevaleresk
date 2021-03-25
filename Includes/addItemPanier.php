<?php
    require_once 'dbh.php';

    if (!isset($_SESSION["Id"])){
        header('Location:../loginForm.php');
        exit();
    }

    if(isset($_GET['item']))
    {
        $idItem = $_GET['item'];
        
        $params = array($_SESSION['Id'],$idItem);
        $sql = "exec addItem @idJoueur = ?, @idItem = ?";

        $stmt = sqlsrv_query($conn, $sql, $params);
        
        sqlsrv_close($conn);

        header('Location:../shop.php');
        exit();
    }
    else {
        header('Location:../shop.php');
        $_SESSION['addItemError'] = 'Impossible d\'ajouter l\'item au panier';
        exit();
    }

?>