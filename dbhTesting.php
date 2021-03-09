<?php

require_once 'Includes/dbh.php';

$sql = "INSERT INTO Joueurs (alias, nom, prenom, montantInitial) VALUES (?, ?, ?, ?)";

$alias = "boubou";
$lastName = "Lavallee";
$firstName = "Vincent";
$montantInitial = 1500;

$stmt = sqlsrv_prepare( $conn, $sql, array( &$alias, &$lastName, &$firstName, &$montantInitial));
if( !$stmt ) {
    die( print_r( sqlsrv_errors(), true));
}


// set parameters and execute


sqlsrv_execute( $stmt );
echo "New records created successfully";
?>