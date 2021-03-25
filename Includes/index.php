<?php
    require_once 'SessionChecker.php';

    $_SESSION['UnauthorizedAccess'] = 'Vous n\'avez pas la permission d\'accèder a cette page';
    header('Location:../shop.php');
    exit();