<?php 
session_start();
//Connecte a la bd automatiquement et nous donne accès à la variable $conn
require_once 'Includes/dbh.php';
require_once 'Includes/htmlUtilities.php';

//Information a insérer (peux provenir d'un get ou post dans notre cas c'est hardcoder)
$alias = sanitizeString($_GET['Alias']);
$lastName = sanitizeString($_GET['LastName']);
$firstName = sanitizeString($_GET['FirstName']);
$montantInitial = 1500;


//On mets les paramètres sous forme d'un array
$params = array($alias, $lastName, $firstName, $montantInitial);

//On définit la close sql à executer, les ? définissent les variable qui vont être remplacer dans le même ordre que le array
$sql = "INSERT INTO Joueurs (alias, nom, prenom, montantInitial) VALUES (?, ?, ?, ?)";

//On execute le code sql en lui donnant la connexion, le code sql incomplet et les information a completer
$stmt = sqlsrv_query($conn, $sql, $params);


//Ceci sert a fermer la bd TRÈS IMPORTANT
sqlsrv_close($conn);


?>