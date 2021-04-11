<?php
session_start();

if(isset($_SESSION['adminCheckerIncludes']) && $_SESSION['alias'] != 'admin')
{
    $_SESSION['UnauthorizedAccess'] = 'Vous n\'avez pas la permission d\'accèder a cette page';
    unset($_SESSION['adminCheckerIncludes']);
    header('Location:../loginForm.php');
    exit();
}
unset($_SESSION['adminCheckerIncludes']);

unset($_SESSION['adminCheckerIncludes']);

if ($_SESSION['alias'] != 'admin')
{
    $_SESSION['UnauthorizedAccess'] = 'Vous n\'avez pas la permission d\'accèder a cette page';
    header('Location:./loginForm.php');
    exit();
}
?>