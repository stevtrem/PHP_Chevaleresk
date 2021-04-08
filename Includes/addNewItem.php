<?php
    require_once './AdminChecker.php';
    require_once './dbh.php';

    if(!isset($_POST['type']) || !isset($_POST['type']))

    $type = $_POST['type'];


    switch ($type) {
        case 'wpn':
            $params = array($_SESSION['Id'], $_GET['item']);

            $sql = "EXEC ajoutItem @nomItem = 'Patate', @qtStock= 10, @type ='POT', @prix =100, @url ='test', @effet ='ahah', @duree = 99";
        
            $stmt = sqlsrv_query($conn, $sql, $params);
            
            break;
        case 'wpn':
            $params = array($_SESSION['Id'], $_GET['item']);

            $sql = "EXEC ajoutItem @nomItem = 'Patate', @qtStock= 10, @type ='POT', @prix =100, @url ='test', @effet ='ahah', @duree = 99";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
        case 'pot':
            $params = array($_SESSION['Id'], $_GET['item']);

            $sql = "EXEC ajoutItem @nomItem = ?, @qtStock= ?, @type ='POT', @prix = ?, @url = ?, @effet = ?, @duree = ?";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
        case 'res':
            $params = array($_SESSION['Id'], $_GET['item']);

            $sql = "EXEC ajoutItem @nomItem = 'Patate', @qtStock= 10, @type ='POT', @prix =100, @url ='test', @effet ='ahah', @duree = 99";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
    }

    sqlsrv_close($conn);
    header('Location:../admin.php');
    exit();