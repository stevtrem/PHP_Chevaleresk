<?php
session_start();
if ($_SESSION['alias'] != 'admin')
{
    header('Location:loginForm.php');
    exit();
}
?>