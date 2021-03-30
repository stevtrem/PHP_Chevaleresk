<?php
    session_start();
    require_once "htmlUtilities.php";
    require_once 'dbh.php';

    if (isset($_POST["SubmitSearch"])){
        $sql = "SELECT * FROM Items";
        if (!isset($_POST['all'])){
            if (isset($_POST['type'])){
                unset($_SESSION['WPN']);
                unset($_SESSION['ARM']);
                unset($_SESSION['POT']);
                $sql.= " WHERE";
                $length = count($_POST['type']);
                for ($i = 0; $i < $length; $i++){
                    if (!empty($_POST['type'][$i])){
                        if ($i > 0){
                            $sql.= " OR";
                        }
                        $type = $_POST['type'][$i];
                        $sql.= " typeItem = '$type'";
                        $_SESSION[$type] = "checked";
                        unset($_SESSION['allCheck']);
                    }
                }
            }else{
                unset($_SESSION['WPN']);
                unset($_SESSION['ARM']);
                unset($_SESSION['POT']);
                unset($_SESSION['allCheck']);
            }
        }else{
            $_SESSION['allCheck'] = "checked";
            unset($_SESSION['WPN']);
            unset($_SESSION['ARM']);
            unset($_SESSION['POT']);
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

