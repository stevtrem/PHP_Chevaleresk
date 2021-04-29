<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if(isset($_POST['SubmitForm']) && !empty($_POST['FirstName']) && !empty($_POST['LastName']) && !empty($_POST['Alias']) && !empty($_POST['Password'])) {
        $params = array($_SESSION['Id'], $_POST['FirstName'], $_POST['LastName'], $_POST['Alias'], $_POST['Password']);

        $sql = "EXECUTE updatePlayer @id = ?, @firstName = ? , @lastName = ? ,@alias = ?, @password = ?";
        
        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);

        $_SESSION['editPlayerSuccess'] = 'La modification du profil à été un succès';
        $_SESSION['alias'] = $_POST['Alias'];
        header('Location:../Profile.php');
        exit();
    }
    else {
        $_SESSION['emptyFields'] = 'Un ou plusieurs champs son vide';
        header('Location:../Profile.php');
        exit();
    }