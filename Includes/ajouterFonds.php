<?php
    require_once 'htmlUtilities.php';
    require_once 'SessionChecker.php';
    require_once 'dbh.php';

    if (isset($_POST['SubmitFunds'])){
        $montant = $_POST['AddFundsInput'];
        $playerId = $_SESSION['selectedPlayerId'];

        $params = array($playerId, $montant);

        $sql = "EXEC AjusterSolde @idJoueur = ?, @montant = ?";

        $stmt = sqlsrv_query($conn, $sql, $params);

        if( $stmt === false) {
            $_SESSION['fundsMsg']='Le montant est invalide';
            header('Location:../admin.php?report=red');
            exit();
        }else{
            $_SESSION['fundsMsg']='Transfert effectué !';
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        header('Location:../admin.php?report=green');
        exit();
    }
?>