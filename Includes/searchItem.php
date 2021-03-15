<?php
    session_start();
    require_once "htmlUtilities.php";
    require_once 'dbh.php';

    if (!isset($_SESSION["Id"])){
        header('Location:../loginForm.php');
        exit();
    }

    if (isset($_POST["SubmitForm"])){
        $sql = "SELECT * FROM Items";

        if (!isset($_POST['all'])){
            if (isset($_POST['type'])){
                foreach ($_POST['type'] as $type){
                    if ($type == "armes"){
                        $sql.= " WHERE typeItem = 'WPN'";
                    }else if ($type == "armures"){
                        $sql.= " WHERE typeItem = 'ARM'";
                    }else{
                        $sql.= " WHERE typeItem = 'POT'";
                    }  
                }
            }
        }

        if (isset($_POST['order'])){
            foreach($_POST['order'] as $radio){
                if ($radio == "ASC"){
                    $sql.= " ORDER BY prixUnitaireItem ASC";
                }else if ($radio == "DESC"){
                    $sql.= " ORDER BY prixUnitaireItem DESC";
                }else if ($radio == "a-z"){
                    $sql.= " ORDER BY nomItem ASC";
                }else if ($radio == "z-a"){
                    $sql.= " ORDER BY nomItem DESC";
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