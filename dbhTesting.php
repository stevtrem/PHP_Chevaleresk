<?php
require_once 'Includes/dbh.php';

$stmt = $dBConnection->prepare("INSERT INTO Joueurs (alias, nom, prenom, montantInitial) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $alias, $lastName, $firstName, $montantInitial);

// set parameters and execute
$alias = "boubou";
$lastName = "Lavallee";
$firstName = "Vincent";
$montantInitial = 1500;
$stmt->execute();
$stmt->close();
$conn->close();
echo "New records created successfully";
?>