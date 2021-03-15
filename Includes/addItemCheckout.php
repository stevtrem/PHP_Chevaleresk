<?php
    if (!isset($_SESSION["Id"])){
        header('Location:../loginForm.php');
        exit();
    }

?>