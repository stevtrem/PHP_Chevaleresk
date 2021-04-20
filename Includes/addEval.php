<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if(isset($_POST['submitEval']) && isset($_POST['idItem'])) {
        if (isset($_POST['starCount']))
            $starCount = $_POST['starCount'];
        else{
            $starCount = 5;
        }

        $params = array($_SESSION['Id'], $_POST['idItem'], $starCount, $_POST['eval']);

        $sql = "EXEC evaluerItem @idJoueur = ?, @idItem = ?, @evaluation = ?, @commentaire = ?";
        
        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);

        $_SESSION['addEvalResult'] = 'L\'évaluation a été ajouter avec succès';
        header('Location:../EditItem.php?item='.$_POST['idItem']);
        exit();
    }
    else {
        header('Location:../EditItem.php'.$_POST['idItem']);
        $_SESSION['addEvalResult'] = 'Impossible d\'évaluer l\'item pour l\'instant';
        exit();
    }