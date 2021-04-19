<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';

    if(isset($_POST['submitEval']) && isset($_POST['starCount']) && isset($_POST['idItem'])) {
        $params = array($_SESSION['Id'],isset($_POST['idItem']),$_POST['starCount'], $_POST['eval']);

        $sql = "insert into evaluations values ? ? ? ?";

        $stmt = sqlsrv_query($conn, $sql, $params);

        sqlsrv_close($conn);

        $_SESSION['addEvalSuccess'] = 'L\'évaluation a été ajouter avec succès';
        header('Location:../EditItem.php');
        exit();
    }
    else {
        header('Location:../EditItem.php');
        $_SESSION['addEvalError'] = 'Impossible d\'évaluer l\'item pour l\'instant';
        exit();
    }