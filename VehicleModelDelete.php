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

if(empty($_POST['deleteVehicle']))
{
    $_SESSION['error'] = "Please fill the filed before submiting";
    header("Location:vehicleModel.php");
    die();
}

$deleteVehicle = $_POST['deleteVehicle'];

$sql = "DELETE FROM vehicle_models WHERE (vehicle_model = :vehicle_model) LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['vehicle_model' => $_POST['deleteVehicle']]);

if($stmt->rowCount() == 1)
{
    $_SESSION['deleted'] = "The vehicle model {$deleteVehicle} was removed from the database.";
    header("Location:vehicleModel.php");
    die();
}
else
{
    $_SESSION['error'] = "An error occured. Please try again.";
    header("Location:vehicleModel.php");
    die();
}