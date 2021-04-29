<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if(isset($_POST['SubmitForm']) and isset($_POST['FirstName']) and isset($_POST['lastName']) and isset($_POST['Alias']) and isset($_POST['Password'])) {
        $params = array($_SESSION['Id'], $_POST['FirstName'], $_POST['lastName'], $_POST['Alias'], $_POST['Password']);

        $sql = "EXECUTE updatePlayer @id = ?, @firstName = ? , @lastName = ? ,@alias = ?, @password = ?";
        
        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);

        $_SESSION['editPlayerSuccess'] = 'La modification du profil à été un succès';
        header('Location:../Profile.php');
        exit();
    }
    else {
        $_SESSION['emptyFields'] = 'Un ou plusieurs champs son vide';
        header('Location:../Profile.php');
        exit();
    }