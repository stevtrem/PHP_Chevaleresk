<?php 
session_start();
require_once 'dbh.php';
require_once 'htmlUtilities.php';

if(isset($_POST["SubmitForm"])){
    //Information a insérer (peux provenir d'un get ou post dans notre cas c'est hardcoder)
    $validUser = true;
    $alias = sanitizeString($_POST['Alias']);
    $lastName = sanitizeString($_POST['LastName']);
    $firstName = sanitizeString($_POST['FirstName']);

    if(!strLengthOk($alias)){
        $validUser = false;
        $_SESSION['aliasError']='Un alias doit contenir au moins 3 caractères';
    }
    if(!strLengthOk($lastName)){
        $validUser = false;
        $_SESSION['lastNameError']='Un nom doit contenir au moins 3 caractères';
    }
    if(!strLengthOk($firstName)){
        $validUser = false;
        $_SESSION['firstNameError']='Un prénom doit contenir au moins 3 caractères';
    }
    if($validUser){
        //On mets les paramètres sous forme d'un array
        $params = array($alias, $lastName, $firstName);

        //On définit la close sql à executer, les ? définissent les variable qui vont être remplacer dans le même ordre que le array
        $sql = "EXEC InsererJoueur @alias = ?, @nom = ?, @prenom = ?";

        //On execute le code sql en lui donnant la connexion, le code sql incomplet et les information a completer
        $stmt = sqlsrv_query($conn, $sql, $params);

        if( $stmt === false) {
            $_SESSION['aliasError']='Un joueur ayant cet alias existe déjà';
            header('Location:../signup.php');
            exit();
        }

        $sql = "SELECT idJoueur FROM Joueurs WHERE alias = ? AND nom = ? AND prenom = ?";
        $params = array($alias, $lastName, $firstName);
        $stmt = sqlsrv_query($conn, $sql, $params);
        
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $_SESSION['Id'] = $row['idJoueur'];
        }

        //Ceci sert a fermer la bd TRÈS IMPORTANT
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        header('Location:../shop.php');
        exit();
    }else{
        header('Location:../signup.php');
        exit();
    }
}
?>