<?php
session_start();

if (!isset($_SESSION['Id']) && isset($_SESSION['sessionCheckerIncludes']))
{
    header('Location:../loginForm.php');
    exit();
}


if (!isset($_SESSION['Id']))
{
    header('Location:loginForm.php');
    exit();
}
?>