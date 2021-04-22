<?php
    session_start();
    $_SESSION['sessionCheckerIncludes'] = 'true';
    require_once './SessionChecker.php';
    require_once './dbh.php';

    if (isset($_GET['item'])){
        $param = array($_GET['item']);
        $sql = "DELETE FROM evaluations WHERE idJoueur =".$_GET['id']." AND idItem =".$_GET['item'];
        $stmt = sqlsrv_query($conn, $sql, $param);
        sqlsrv_close($conn);
        $_SESSION['deleteCommentResult'] = 'L\'évaluation a été enlevé avec succès';
        header('Location:../EditItem.php?item='.$_GET['item']);
        exit();
    }
?>