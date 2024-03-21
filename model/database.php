<?php
// Connects to the ZippyUsedAutos database
$dsn = 'etdq12exrvdjisg6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=et6jp5phfggu6kos';
$username = 'pqzirqysdzixmwdq';
$password = 'yfl4d7mg70coaxpw';

try {
    $db = new PDO($dsn, $username, $password);

} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    include('view/error.php');
    exit();
}
