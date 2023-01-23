<?php
session_start();
require_once __DIR__ . "/classes/db.php";

if(!isset($_SESSION['username']))
{
    $_SESSION['error'] = "You aren't allowed.";
    header("Location:index.php");
    die();
}
if(!isset($_POST['deleteEntry']))
{
    $sql = "SELECT registrations.id,vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to, vehicle_models.vehicle_model  
    FROM registrations 
    LEFT JOIN vehicle_models
    ON registrations.vehicle_model_id = vehicle_models.id
    WHERE registrations.id = {$_GET['id']}";

    $stmt = $pdo->query($sql);
    $_SESSION['all'] = $stmt->fetch();
    $_SESSION['deletedTxt'] = "Are you sure you want to remove this entry?";
    header("Location:layout.php");
    die();
}
else
{
    $sql = "DELETE FROM registrations WHERE (id = :id) LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id'=> $_GET['id']]);
    // var_dump($stmt);
    // die;

    if($stmt->rowCount() == 1)
    {
        $_SESSION['deleted'] = "The entry was removed from the database.";
        header("Location:dashbord.php");
        $_POST['deleteEntry'] = [];
        die();
    }
}


