<?php
session_start();
if (!isset($_SESSION['Id']))
{
    header('Location:loginForm.php');
    $_SESSION['loginError'] = 'Accès Illégal';
    exit();
}
?>