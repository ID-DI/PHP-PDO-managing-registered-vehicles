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

$fileds = ['vehicle_chassis_number', 'registration_number', 'registration_to', 'vehicle_production_year'];

foreach($fileds as $key=>$value)
{
    if(empty($_POST[$value]))
    {
        $_SESSION['error'] = "Please fill all the fileds before submiting";
        header("Location:dashbord.php");
        die();
    }
}
if(strlen($_POST['vehicle_chassis_number']) != 7)
{
    $_SESSION['error'] = 'The chassis number is 7 chars long';
    header("Location:dashbord.php");
    die();
}

if(strlen($_POST['registration_number']) != 10)
{
    $_SESSION['error'] = 'The plate number is 10 chars long';
    header("Location:dashbord.php");
    die();
}
$sqlChassis = "SELECT vehicle_chassis_number
                FROM registrations
                WHERE 1";

$stmtChassis = $pdo->query($sqlChassis);
while($row = $stmtChassis->fetch())
{
    if($row["vehicle_chassis_number"] == $_POST['vehicle_chassis_number'])
    {
        $_SESSION['error'] = 'There is an vehicle with that chassis number';
        header("Location:dashbord.php");
        die();
    }
}

$sql = "INSERT INTO registrations(vehicle_model_id, vehicle_type, vehicle_chassis_number, vehicle_production_year, registration_number, fuel_type, registration_to)
        VALUES(:vehicle_model_id, :vehicle_type, :vehicle_chassis_number, :vehicle_production_year, :registration_number, :fuel_type, :registration_to)";

$stmt = $pdo->prepare($sql);

if($stmt->execute([
    'vehicle_model_id' => $_POST['vehicle_models'],
    'vehicle_chassis_number' => $_POST['vehicle_chassis_number'],
    'registration_number' => $_POST['registration_number'],
    'registration_to' => $_POST['registration_to'],
    'vehicle_type' => $_POST['vehicle_type'],
    'vehicle_production_year' => $_POST['vehicle_production_year'],
    'fuel_type' => $_POST['fuel_type'] 
]))
{
    $last_id =  $pdo->lastInsertId();
    $sql = "SELECT vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to  
            FROM registrations 
            LEFT JOIN vehicle_models
            ON registrations.vehicle_model_id = vehicle_models.id
            WHERE registrations.id = $last_id";

    $stmt = $pdo->query($sql);
    $_SESSION['all'] = $stmt->fetch();
    $_SESSION['success'] = "New vehicle added";
    header("Location:layout.php");
    die();
}
else
{
    $_SESSION['error'] = "An error occured. Please try again.";
    header("Location.dashbord.php");
    die();
}

