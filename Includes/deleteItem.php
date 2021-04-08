<?php
    require_once 'htmlUtilities.php';
    require_once 'SessionChecker.php';
    require_once 'dbh.php';

    if (isset($_GET['item'])){
        $param = array($_GET['item']);
        $sql = "exec DeleteItemCascade @idItem = ?";
        $stmt = sqlsrv_query($conn, $sql, $param);
        header('Location:../deleteItem.php');
        exit();
    }
?>