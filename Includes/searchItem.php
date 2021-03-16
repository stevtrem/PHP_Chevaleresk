<?php
    session_start();
    require_once "htmlUtilities.php";
    require_once 'dbh.php';

    if (!isset($_SESSION["Id"])){
        header('Location:../loginForm.php');
        exit();
    }

    if (isset($_POST["SubmitSearch"])){
        $sql = "SELECT * FROM Items";
        if (!isset($_POST['all']) && isset($_POST['type'])){
            $sql.= " WHERE";
            $length = count($_POST['type']);
            for ($i = 0; $i < $length; $i++){
                if (!empty($_POST['type'][$i])){
                    if ($i > 0){
                        $sql.= " OR";
                    }
                    $type = $_POST['type'][$i];
                    $sql.= " typeItem = '$type'";
                }  
            }
        }
        if (isset($_POST['order'])){
            $length = count($_POST['order']);
            for ($i = 0; $i < $length; $i++){
                if (!empty($_POST['order'][$i])){
                    $order = $_POST['order'][$i];
                    $sql.= " ORDER BY $order";
                }    
            }
        }else{
            $sql.= " ORDER BY prixUnitaireItem ASC";
        }
        $_SESSION["sql"] = $sql;
        header('Location:../shop.php');
        exit();
    }
?>

