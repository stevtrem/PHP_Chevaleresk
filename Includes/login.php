<?php
session_start();
require_once 'dbh.php';
require_once 'htmlUtilities.php';

if (isset($_POST["SubmitForm"])){
    $alias = sanitizeString($_POST['Alias']);
    $password = sanitizeString($_POST['Password']);

    $sql = "EXEC LoginJoueur @alias = ?, @password = ?";
    $params = array($alias, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if( $stmt === false) {
        $_SESSION['loginError']='Informations invalides';
        header('Location:../loginForm.php');
        exit();
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $_SESSION['Id'] = $row['idJoueur'];
        $_SESSION['alias'] = $row['alias'];
    }
    
    if ($_SESSION['Id'] == 0){
        $_SESSION['loginError'] = 'Informations invalides';
        header('Location:../loginForm.php');
    }else if ($_SESSION['alias'] == 'admin'){
        header('Location:../admin.php');
    }else{
        header('Location:../shop.php');
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    exit();
}
?>