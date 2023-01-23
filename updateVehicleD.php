<?php
session_start();

if(($_SERVER['REQUEST_METHOD']) == "POST")
{
    require_once __DIR__ . "/classes/db.php";
}
else
{
    $_SESSION['error'] = "Only POST requests allowed";
    header("Location:dashbord.php");
    die();
}



$sql = "UPDATE registrations SET 
vehicle_model_id = '{$_POST['vehicle_models']}',
vehicle_chassis_number = '{$_POST['vehicle_chassis_number']}',
registration_number= '{$_POST["registration_number"]}',
registration_to= '{$_POST["registration_to"]}',
vehicle_type = '{$_POST["vehicle_type"]}',
vehicle_production_year = '{$_POST["vehicle_production_year"]}',
fuel_type = '{$_POST["fuel_type"]}' 
WHERE id = '{$_POST['id']}'";


$result = $pdo->exec($sql);
if ($result == 1) 
{
    $_SESSION['success'] = "Vehice updated";
    header("Location: dashbord.php");
    die();
} 
else 
{
    $_SESSION['error'] = "An error occured";
    header("Location: dashbord.php");
    die();
}


