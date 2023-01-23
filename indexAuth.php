<?php
session_start();

require_once __DIR__ . "/classes/db.php";

if($_SERVER['REQUEST_METHOD']  != "POST")
{
    $_SESSION['error'] = "Only POST requests are allowed!";
    header("Location:index.php");
    die;
}

if(empty($_POST['registration_number']))
{
  $_SESSION['error'] = "Please eneter the registration number before submiting.";
  header("Location:index.php");
  die();
}

(string)$registrationPost = strtoupper($_POST['registration_number']);

$sql = "SELECT vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to, vehicle_models.vehicle_model  
FROM registrations 
LEFT JOIN vehicle_models
ON registrations.vehicle_model_id = vehicle_models.id
WHERE 1";

$stmt = $pdo->prepare($sql);
$stmt = $pdo->query($sql);

while($row = $stmt->fetch())
{
  // var_dump($row);
  // die;
  if($row['registration_number'] == $registrationPost)
  {
    $_SESSION['all'] =  $row;
      header("Location:index.php");
      die();
  }
}
  if($row['registration_number'] != $registrationPost)
  {
      $_SESSION['error'] = "There is no such record";
      header("Location:index.php");
      die();
  }
?>

