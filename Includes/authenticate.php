<?php 
session_start();
//Connecte a la bd automatiquement et nous donne accès à la variable $conn
require_once 'Includes/dbh.php';
require_once 'Includes/htmlUtilities.php';

if(isset($_GET["SubmitForm"])){
    //Information a insérer (peux provenir d'un get ou post dans notre cas c'est hardcoder)
    $validUser = true;
    $alias = sanitizeString($_GET['Alias']);
    $lastName = sanitizeString($_GET['LastName']);
    $firstName = sanitizeString($_GET['FirstName']);
    $montantInitial = 1500;

    if(!strLengthOk($alias)){
        $validUser = false;
        $_SESSION['aliasError']='Un alias doit contenir au moin 3 caractères';
    }
    if(!strLengthOk($lastName)){
        $validUser = false;
        $_SESSION['lastNameError']='Un nom doit contenir au moin 3 caractères';
    }
    if(!strLengthOk($firstName)){
        $validUser = false;
        $_SESSION['firstNameError']='Un prenom doit contenir au moin 3 caractères';
    }
    if($validUser){
        //On mets les paramètres sous forme d'un array
        $params = array($alias, $lastName, $firstName, $montantInitial);

        //On définit la close sql à executer, les ? définissent les variable qui vont être remplacer dans le même ordre que le array
        $sql = "INSERT INTO Joueurs (alias, nom, prenom, montantInitial) VALUES (?, ?, ?, ?)";

        //On execute le code sql en lui donnant la connexion, le code sql incomplet et les information a completer
        $stmt = sqlsrv_query($conn, $sql, $params);


        //Ceci sert a fermer la bd TRÈS IMPORTANT
        sqlsrv_close($conn);
        header('Location:shop.php');
    }else{
        header('Location:signup.php');
    }
}
?>