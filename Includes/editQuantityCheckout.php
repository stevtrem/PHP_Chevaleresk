<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if(isset($_POST['newQtSubmit'])){
        $qt = $_POST['qt'];
        $idItem = $_POST['id'];

        $params = array($qt, $_SESSION['Id'], $idItem);
        $sql = "update Panier set qtItem = ? where idJoueur = ? and idItem = ?";

        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);

        $_SESSION['editQtSuccess'] = 'La quantité de l\'item a été modifiée avec succès';
        header('Location:../Panier.php');
        exit();
        }
        else {
            header('Location:../Panier.php');
            $_SESSION['editQtError'] = 'Impossible de changer la quantité de l\'item';
            exit();
        }
?>
