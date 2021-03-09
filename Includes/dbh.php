<?php

// SQL Server Extension Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:cheveleresk.database.windows.net,1433; Database = Cheveleresk", "vincent", "Patate123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

