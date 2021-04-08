<?php
session_start();

if(isset($_SESSION['adminCheckerIncludes']) && $_SESSION['alias'] != 'admin')
{
    unset($_SESSION['adminCheckerIncludes']);
    header('Location:../loginForm.php');
    exit();
}

if ($_SESSION['alias'] != 'admin')
{
    header('Location:./loginForm.php');
    exit();
}
?>