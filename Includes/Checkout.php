<?php
    require_once 'SessionChecker.php'; 
    require_once 'dbh.php';

    $params = array($_SESSION['Id']);

    $sql = "exec Checkout";
                
    $stmt = sqlsrv_query($conn, $sql, $params);
    