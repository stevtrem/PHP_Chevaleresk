<?php
    session_start();
    $_SESSION['adminCheckerIncludes'] = 'true';
    require_once './AdminChecker.php';
    require_once './dbh.php';

    if(!isset($_POST['type']) || !isset($_POST['itemName']) || !isset($_POST['qtStock']) || !isset($_POST['price']) || !isset($_POST['pic'])) {
        $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
        header('Location:../addNewItem.php');
        exit();
    }

    $type = $_POST['type'];


    switch ($type) {
        case 'wpn':
            if(!isset($_POST['efficacite'])) {
                $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
                header('Location:../addNewItem.php');
                exit();
            }

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