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

$_SESSION['searchVehicle'] = $_POST['searchVehicle'];
if(empty($_POST['searchVehicle']))
    {
        $_SESSION['error'] = "Please fill the filed before submiting";
        header("Location:vehicleModel.php");
        die();
    }

$sql = "SELECT * FROM `vehicle_models` WHERE (vehicle_model = :vehicle_model)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['vehicle_model' => $_POST['searchVehicle']]);
if ($stmt->rowCount() == 1) 
{
    $_SESSION['yesVehicle'] = $stmt->fetch();
    $_SESSION['yesVehicleTxt'] = "The vehicle model <span class='text-uppercase text-danger'>{$_POST['searchVehicle']}</span> is in database. Would you like it to delete it ?";
    header("Location:vehicleModel.php");
    die();
}
else
{
    $_SESSION['noVehicle'] = "There is no record of the vehicle model  <span class='text-uppercase text-success'>{$_POST['searchVehicle']}</span> in the database. Would you like to add it ?";
    header("Location:vehicleModel.php");
    die();
}

$addVehicle = $_POST['addVehicle'];
$sqlAdd = "INSERT INTO vehicle_models (vehicle_model) VALUES(:vehicle_model)";
$stmtAdd = $pdo->prepare($sqlAdd);
if($stmtAdd->execute([
    'vehicle_model' => $_POST['addVehicle']
]))
{
    $_SESSION['added'] = "The vehicle model {$addVehicle} was added to the database";
    header("Location:vehicleModel.php");
    die();
}
else 
{
    $_SESSION['added'] = "Something went wrong. Please try again.";
    header("Location:vehicleModel.php");
    die();
}