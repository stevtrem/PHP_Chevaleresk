<?php
    require_once 'dbh.php';

    // if (!isset($_SESSION["Id"])){
    //     header('Location:../loginForm.php');
    //     exit();
    // }

    if(isset($_POST['newQt']) && isset($_POST['qt']))
    {
        $qt = $_POST['qt'];
        $idItem = $_POST['id'];

        $params = array($qt, $_SESSION['Id'], $idItem);
        $sql = "update Panier set qtItem = ? where idJoueur = ? and idItem = ?";

        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);

        header('Location:../Panier.php');
        exit();
    }
    else {
        header('Location:../Panier.php');
        $_SESSION['removeCheckoutError'] = 'Impossible de changer la quantite l\'item';
        exit();
    }
