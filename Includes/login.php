<?php
session_start();
require_once 'dbh.php';
require_once 'htmlUtilities.php';

if (isset($_POST["SubmitForm"])){
    $alias = sanitizeString($_POST['Alias']);
    $lastName = sanitizeString($_POST['LastName']);
    $firstName = sanitizeString($_POST['FirstName']);

    $sql = "SELECT idJoueur FROM Joueurs WHERE alias = ? AND nom = ? AND prenom = ?";
    $params = array($alias, $lastName, $firstName);
    $stmt = sqlsrv_query($conn, $sql, $params);

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $_SESSION['Id'] = $row['idJoueur'];
    }
    
    if ($_SESSION['Id'] == 0){
        $_SESSION['aliasError'] = 'Informations invalides';
        header('Location:../loginForm.php');
    }else{
        header('Location:../index.php');
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    exit();
}
?>