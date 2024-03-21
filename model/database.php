<?php
// Connects to the ZippyUsedAutos database
$dsn = 'mysql:host=localhost;dbname=zippyusedautos';
$username = 'root';
//$password = 'password';

try {
    $db = new PDO($dsn, $username);

} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    include('view/error.php');
    exit();
}
