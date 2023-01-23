<?php
session_start();

if(($_SERVER['REQUEST_METHOD']) == "POST")
{
    require_once __DIR__ . "/classes/db.php";
}
else
{
    $_SESSION['error'] = "Only POST requests allowed";
    header("Location:index.php");
    die();
}

if(empty($_POST['addVehicle']))
{
    $_SESSION['error'] = "Please fill the filed before submiting";
    header("Location:vehicleModel.php");
    die();
}

$addVehicle = strtoupper($_POST['addVehicle']);
// echo $addVehicle;
// die;

$_SESSION['addVehicle'] = $addVehicle;
$sqlAdd = "INSERT INTO vehicle_models (vehicle_model) VALUES(:vehicle_model)";
$stmtAdd = $pdo->prepare($sqlAdd);

if($stmtAdd->execute(['vehicle_model' => $addVehicle]))
{
    $_SESSION['addVehicle'] = "The vehicle model {$addVehicle} was added to the database";
    header("Location:vehicleModel.php");
    die();
}
else 
{
    $_SESSION['addVehicle'] = "Something went wrong. Please try again.";
    header("Location:vehicleModel.php");
    die();
}

