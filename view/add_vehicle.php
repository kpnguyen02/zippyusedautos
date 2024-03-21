<?php
// Connects to the ZippyUsedAutos database
$dsn = 'mysql:host=etdq12exrvdjisg6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=et6jp5phfggu6kos';
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
?>
<?php
// Assuming you have your addVehicle() function defined here

// Function to fetch makes from the database
function getMakes() {
    global $db;

    $query = "SELECT * FROM makes";
    $statement = $db->prepare($query);
    $statement->execute();
    $makes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $makes;
}

// Function to fetch types from the database
function getTypes() {
    global $db;

    $query = "SELECT * FROM types";
    $statement = $db->prepare($query);
    $statement->execute();
    $types = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $types;
}

// Function to fetch classes from the database
function getClasses() {
    global $db;

    $query = "SELECT * FROM classes";
    $statement = $db->prepare($query);
    $statement->execute();
    $classes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $classes;
}
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

// Fetch makes, types, and classes from the database
$makes = getMakes();
$types = getTypes();
$classes = getClasses();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $year = $_POST['year'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $type_id = $_POST['type'];
    $class_id = $_POST['class'];
    $make_id = $_POST['make'];

    // Call the addVehicle function with the form data
    addVehicle($year, $model, $price, $type_id, $class_id, $make_id);

    header("Location: add_vehicle.php");
    exit();
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h1>Add A New Vehicle</h1>
    <label for="year">Year:</label>
    <input type="text" name="year" id="year" required><br><br>

    <label for="model">Model:</label>
    <input type="text" name="model" id="model" required><br><br>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price" required><br><br>

    <label for="make">Make:</label>
    <select name="make" id="make">
        <option value="">Select a Make</option>
        <?php foreach ($makes as $make) : ?>
            <option value="<?php echo $make['id']; ?>"><?php echo $make['make']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="type">Type:</label>
    <select name="type" id="type">
        <option value="">Select a Type</option>
        <?php foreach ($types as $type) : ?>
            <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="class">Class:</label>
    <select name="class" id="class">
        <option value="">Select a Class</option>
        <?php foreach ($classes as $class) : ?>
            <option value="<?php echo $class['id']; ?>"><?php echo $class['class']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Submit</button>
</form>
<p><a href=".">View Inventory</a></p>
