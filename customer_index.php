<?php 
include('model/database.php');
include('model/vehicle_db.php');
include('model/makes_db.php');
include('model/classes_db.php');
include('model/types_db.php');

$inventory = getVehicles();
include('customer_index.php');