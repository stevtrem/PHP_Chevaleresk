<?php
    session_start();
    $_SESSION['selectedPlayerAlias'] = $_POST['alias'];
    header("Location:../admin.php");
    exit();
?>