<?php

// Function to retrieve all classes
function getClasses() {
    global $db;

    $query = "SELECT * FROM classes";
    $statement = $db->prepare($query);
    $statement->execute();
    $classes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $classes;
}
function getClassNameById($class_id) {
    global $db;

    $query = "SELECT class FROM classes WHERE id = :class_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':class_id', $class_id);
    $statement->execute();
    $class = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $class['class'];
}

// Function to add a new class
function addClass($class) {
    global $db;

    $query = "INSERT INTO classes (class) VALUES (:class)";
    $statement = $db->prepare($query);
    $statement->bindParam(':class', $class);
    $statement->execute();
    $statement->closeCursor();
}

function deleteClass($class_id)
{
    global $db;
    $query = 'DELETE FROM classes WHERE id = :class_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();
}

?>
