<?php
    require_once 'Includes/SessionChecker.php'; 
    require_once 'Includes/dbh.php';

    $params = array($_SESSION['Id']);

    $sql = "exec Checkout";
                
    $stmt = sqlsrv_query($conn, $sql, $params);
    