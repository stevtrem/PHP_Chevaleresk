<?php
session_start();
if (!isset($_SESSION['Id']))
{
    header('Location:login.php');
    $_SESSION['loginError'] = 'Accès Illégal';
    exit();
}
?>