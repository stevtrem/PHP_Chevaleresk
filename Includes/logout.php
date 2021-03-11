<?php
session_start();
unset($_SESSION['Id']);
session_destroy();
header('Location: ../index.php');
?>