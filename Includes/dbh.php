<?php

try {
    $conn = new PDO("sqlsrv:server = tcp:cheveleresk.database.windows.net,1433; Database = Cheveleresk", "vincent", "Patate123");
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}