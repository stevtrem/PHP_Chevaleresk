<?php

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "vincent", "pwd" => "Patate123", "Database" => "Cheveleresk", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cheveleresk.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
