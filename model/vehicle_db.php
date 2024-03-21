<?php 
// Function to retrieve inventory based on filters

function getFilteredVehicles($order, $makeFilter = '', $typeFilter = '', $classFilter = '') {
    global $db;

    $query = "SELECT * FROM vehicles WHERE 1";

    // Add WHERE clauses based on filters
    if (!empty($makeFilter)) {
        $query .= " AND make_id = (SELECT id FROM makes WHERE make = :make)";
    }
    if (!empty($typeFilter)) {
        $query .= " AND type_id = (SELECT id FROM types WHERE type = :type)";
    }
    if (!empty($classFilter)) {
        $query .= " AND class_id = (SELECT id FROM classes WHERE class = :class)";
    }

    // Add sorting order
    switch ($order) {
        case 'price_desc':
            $query .= " ORDER BY price DESC";
            break;
        case 'price_asc':
            $query .= " ORDER BY price ASC";
            break;
        case 'year_desc':
            $query .= " ORDER BY year DESC";
            break;
        case 'year_asc':
            $query .= " ORDER BY year ASC";
            break;
        default:
            // Default sorting order
            $query .= " ORDER BY price DESC";
            break;
    }

    $statement = $db->prepare($query);

    // Bind parameters for filters
    if (!empty($makeFilter)) {
        $statement->bindParam(':make', $makeFilter);
    }
    if (!empty($typeFilter)) {
        $statement->bindParam(':type', $typeFilter);
    }
    if (!empty($classFilter)) {
        $statement->bindParam(':class', $classFilter);
    }

    $statement->execute();
    $inventory = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $inventory;
}


// Function to retrieve all vehicles
function getVehicles() {
    global $db;

    $query = "SELECT * FROM vehicles";
    $statement = $db->prepare($query);
    $statement->execute();
    $vehicles = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $vehicles;
}

// Function to add a new vehicle
function addVehicle($year, $model, $price, $type_id, $class_id, $make_id) {
    global $db;

    $query = "INSERT INTO vehicles (year, model, price, type_id, class_id, make_id) VALUES (:year, :model, :price, :type_id, :class_id, :make_id)";
    $statement = $db->prepare($query);
    $statement->bindParam(':year', $year);
    $statement->bindParam(':model', $model);
    $statement->bindParam(':price', $price);
    $statement->bindParam(':type_id', $type_id);
    $statement->bindParam(':class_id', $class_id);
    $statement->bindParam(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}


function deleteVehicle($vehicle_id) {
    global $db;

    $query = "DELETE FROM vehicles WHERE id = :id";

    $statement = $db->prepare($query);
    $statement->bindParam(':id', $vehicle_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

