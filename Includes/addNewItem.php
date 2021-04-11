<?php
    session_start();
    $_SESSION['adminCheckerIncludes'] = 'true';
    require_once './AdminChecker.php';
    require_once './dbh.php';

    if(!isset($_POST['type']) || !isset($_POST['itemName']) || !isset($_POST['qtStock']) || !isset($_POST['price'])) {
        $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
        header('Location:../addNewItem.php');
        exit();
    }

    $type = $_POST['type'];

    $fileName = $_FILES['pic']['name'];
    $fileSize = $_FILES['pic']['size'];
    $fileTmpName  = $_FILES['pic']['tmp_name'];
    $fileType = $_FILES['pic']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = "../images/imagesItem/" . $fileName;

    $fileExtensionsAllowed = ['jpeg','jpg','png']; 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $_SESSION['uploadError'] = "L'extension du fichier est erroner";
    }
    if ($fileSize > 5000000) {
        $_SESSION['uploadError'] = "L'image dépasse la taille maximale (5MB)";
    }


    $params1 = array($_POST['itemName'], $_POST['qtStock'], $_POST['price'],$fileName);

    switch ($type) {
        case 'wpn':
            if(!isset($_POST['efficacite']) || !isset($_POST['genre']) || !isset($_POST['descriptionArme'])) {
                $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
                header('Location:../addNewItem.php');
                exit();
            }
            
            $params2 = array($_POST['efficacite'], $_POST['genre'], $_POST['descriptionArme']);
            
            $params = array_merge($params1, $params2);

            $sql = "EXEC ajoutItem @nomItem = ?, @qtStock= ?, @type ='WPN', @prix = ?, @url = ?, @efficacite = ?, @genre = ?,  @descriptionArme = ?";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
        case 'arm':
            if(!isset($_POST['matiere']) || !isset($_POST['poids']) || !isset($_POST['taille'])) {
                $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
                header('Location:../addNewItem.php');
                exit();
            }

            $params = array($_POST['matiere'], $_POST['poids'], $_POST['taille']);

            $sql = "EXEC ajoutItem @nomItem = ?, @qtStock= ?, @type ='ARM', @prix = ?, @url = ?, @matiere = ?, @poids = ?, @taille = ?";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
        case 'pot':
            if(!isset($_POST['effet']) || !isset($_POST['duree'])) {
                $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
                header('Location:../addNewItem.php');
                exit();
            }

            $params = array($_POST['effet'], $_POST['duree']);

            $sql = "EXEC ajoutItem @nomItem = ?, @qtStock= ?, @type ='POT', @prix = ?, @url = ?, @effet = ?, @duree = ?";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
        case 'res':
            if(!isset($_POST['descriptionRes'])) {
                $_SESSION['addNewItemError'] = "L'item n'a pas pu être ajouter";
                header('Location:../addNewItem.php');
                exit();
            }

            $params = array($_POST['descriptionRes']);

            $sql = "EXEC ajoutItem @nomItem = ?, @qtStock= ?, @type ='POT', @prix = ?, @url = ?, @effet = ?, @duree = ?";
        
            $stmt = sqlsrv_query($conn, $sql, $params);

            break;
    }
    move_uploaded_file($fileTmpName, $uploadPath);

    sqlsrv_close($conn);
    header('Location:../admin.php');
    exit();