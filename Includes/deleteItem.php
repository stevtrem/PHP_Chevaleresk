<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if (isset($_GET['item'])){
        $param = array($_GET['item']);
        $sql = "exec DeleteItemCascade @idItem = ?";
        $stmt = sqlsrv_query($conn, $sql, $param);
        sqlsrv_close($conn);
        $_SESSION['deleteItemResult'] = 'L\'objet a été supprimé avec succès';
        header('Location:../deleteItem.php');
        exit();
    }
?>