<?php

// Function to retrieve all makes
function getMakeNameById($make_id) {
    global $db;

    $query = "SELECT make FROM makes WHERE id = :make_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':make_id', $make_id);
    $statement->execute();
    $make = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $make['make'];
}
function getMakes() {
    global $db;

    $query = "SELECT * FROM makes";
    $statement = $db->prepare($query);
    $statement->execute();
    $makes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $makes;
}

// Function to add a new make
function addMake($make) {
    global $db;

    $query = "INSERT INTO makes (make) VALUES (:make)";
    $statement = $db->prepare($query);
    $statement->bindParam(':make', $make);
    $statement->execute();
    $statement->closeCursor();
}

// Function to delete a make
function deleteMake($make_id) {
    global $db;

    $query = "DELETE FROM makes WHERE id = :make_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}

?>
