<?php
session_start();
if (!isset($_SESSION['Id']))
{
    header('Location:~/loginForm.php');
    exit();
}
?>