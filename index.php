<?php 
include('model/database.php');
include('model/vehicle_db.php');
include('model/makes_db.php');
include('model/classes_db.php');
include('model/types_db.php');

// Fetch filters

$makeFilter = $_POST['make'] ?? '';
$typeFilter = $_POST['type'] ?? '';
$classFilter = $_POST['class'] ?? '';
$order = $_POST['order'] ?? 'price_desc';


$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
$class_name = filter_input(INPUT_POST, 'class_name', FILTER_UNSAFE_RAW);

$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
$make_name = filter_input(INPUT_POST, 'make_name', FILTER_UNSAFE_RAW);

$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
$type_name = filter_input(INPUT_POST, 'type_name', FILTER_UNSAFE_RAW);

//vehicle form submission
$make = filter_input(INPUT_POST, 'add_make', FILTER_UNSAFE_RAW);
$model = filter_input(INPUT_POST, 'add_model', FILTER_UNSAFE_RAW);
$year = filter_input(INPUT_POST,'add_year', FILTER_UNSAFE_RAW);
$price = filter_input( INPUT_POST,'add_price', FILTER_UNSAFE_RAW);
$type = filter_input(INPUT_POST,'add_type_id', FILTER_UNSAFE_RAW);
$class = filter_input(INPUT_POST,'add_class_id', FILTER_UNSAFE_RAW);
// Default action
$action = $_REQUEST['action'] ?? 'list_inventory';

switch ($action) {
    case 'show_add_vehicle':
        header("Location: view/add_vehicle.php");
        break;
    case 'add_vehicle':
        addVehicle($year, $model, $price, $type, $class, $make);
        header("Location: .?action=show_add_vehicle");
        break;
    case 'list_classes':
        $classes = getClasses();
        include('view/classes_list.php');
        break;
    case 'add_class':
        addClass($class_name);
        header("Location: .?action=list_classes");
        break;
    case 'delete_class':
        if ($class_id)
        {
            deleteClass($class_id);
        }
        header("Location: .?action=list_classes");
        break;
    case 'list_makes':
        $makes = getMakes();
        include("view/makes_list.php");
        break;
    case "add_make":
        addMake($make_name);
        header("Location: .?action=list_makes");
        break;
    case 'delete_make':
        if ($make_id)
        {
            deleteMake($make_id);
        }
        header("Location: .?action=list_makes");
        break;
    case 'list_types':
        $types = getTypes();
        include('view/types_list.php');
        break;
    case 'add_type':
        addType($type_name);
        header("Location: .?action=list_types");
        break;
    case 'delete_type':
        if ($type_id)
        {
            deleteType($type_id);
        }
        header("Location: .?action=list_types");
        break;
    case 'delete_vehicle':
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
        if ($vehicle_id) {
            deleteVehicle($vehicle_id);
        }
        // Redirect back to the inventory page after deletion
        header("Location: .");
        break;
    default:
        // Retrieve inventory based on filters and sorting order
        if (!empty($makeFilter) || !empty($typeFilter) || !empty($classFilter)) {
            // If any filter is applied, retrieve filtered inventory
            $inventory = getFilteredVehicles($order, $makeFilter, $typeFilter, $classFilter);
        } else {
            // Otherwise, retrieve all vehicles
            $inventory = getVehicles();
        }
        include('view/vehicle_list.php');
        break;
    
}
?>
