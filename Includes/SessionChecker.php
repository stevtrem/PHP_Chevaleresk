<?php
session_start();

if (!isset($_SESSION['Id']) && isset($_SESSION['sessionCheckerIncludes']))
{
    $_SESSION['UnauthorizedAccess'] = 'Vous n\'avez pas la permission d\'accèder a cette page';
    unset($_SESSION['sessionCheckerIncludes']);
    header('Location:../loginForm.php');
    exit();
}

unset($_SESSION['sessionCheckerIncludes']);

if (!isset($_SESSION['Id']))
{
    $_SESSION['UnauthorizedAccess'] = 'Vous n\'avez pas la permission d\'accèder a cette page';
    header('Location:loginForm.php');
    exit();
}
?>