<?php

// Function to retrieve all types
function getTypes() {
    global $db;

    $query = "SELECT * FROM types";
    $statement = $db->prepare($query);
    $statement->execute();
    $types = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $types;
}

function getTypeNameById($type_id) {
    global $db;

    $query = "SELECT type FROM types WHERE id = :type_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':type_id', $type_id);
    $statement->execute();
    $type = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $type['type'];
}


// Function to add a new type
function addType($type) {
    global $db;

    $query = "INSERT INTO types (type) VALUES (:type)";
    $statement = $db->prepare($query);
    $statement->bindParam(':type', $type);
    $statement->execute();
    $statement->closeCursor();
}

function deleteType($type_id)
{
    global $db;
    $query = 'DELETE FROM types WHERE id = :type_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
