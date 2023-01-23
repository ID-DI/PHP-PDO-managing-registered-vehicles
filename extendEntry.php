<?php

session_start();

if(!isset($_SESSION['username']))
{
    header("Location:login.php");
    die();
}
else
{
    require_once __DIR__ . "/classes/db.php";
    require_once __DIR__ . "/classes/header.php";
}

if(!isset($_POST['extendEntry']))
{
    $sql = "SELECT registrations.id,vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to, vehicle_models.vehicle_model  
    FROM registrations 
    LEFT JOIN vehicle_models
    ON registrations.vehicle_model_id = vehicle_models.id
    WHERE registrations.id = {$_GET['id']}";

    $stmt = $pdo->query($sql);
    $_SESSION['all'] = $stmt->fetch();
    $_SESSION['extendEntry'] = "Extend the registration date";
    header("Location:layout.php");
    die();
}
else
{
    $sql = "UPDATE registrations 
            SET registration_to = :registration_to
            WHERE id = {$_GET['id']}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['registration_to'=>$_POST['extendEntry']]);
    // var_dump($stmt);
    // die;

    if($stmt->rowCount() > 0)
    {
        $_SESSION['extendEntry'] = "The entry was extendet.";
        header("Location:dashbord.php");
        die();
    }
}