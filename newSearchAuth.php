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
}

$sql = "SELECT registrations.id, vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to, vehicle_models.vehicle_model  
FROM registrations 
LEFT JOIN vehicle_models
ON registrations.vehicle_model_id = vehicle_models.id
WHERE 1";

$stmt = $pdo->prepare($sql);
$stmt = $pdo->query($sql);
$id=null;
while($row = $stmt->fetch())
{
    $_SESSION['$row'][] = $row;
    var_dump($_SESSION['row']);
    die;
    $expireDate = strtotime($row['registration_to']);
    $timeLeft = ceil(($expireDate-time())/60/60/24);
    if($timeLeft > 30)
    {
        $_SESSION['color'] = 'text-dark';
    }
    elseif($timeLeft == 30)
    {
        $_SESSION['color'] = 'text-warning';
    }
    elseif($timeLeft < 30)
    {
        $_SESSION['color'] = 'text-danger';
    }
}

if(isset($_POST['newSearch']))
{
    if(empty($_POST['newSearch']))
    {
        $_SESSION['newError'] = "Please fill the input before submiting";
        header("Location:dashbord.php");
        die();
    }
    $_POST['newSearch'] = strtoupper($_POST['newSearch']);

    $sql = "SELECT vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to  
    FROM registrations 
    LEFT JOIN vehicle_models
    ON registrations.vehicle_model_id = vehicle_models.id
    WHERE (vehicle_models.vehicle_model LIKE '___%') 
    OR (registrations.vehicle_chassis_number LIKE '_______')
    OR (registrations.registration_number LIKE '__-____-__')";

    $stmt = $pdo->query($sql);
    $_SESSION['row'] = [];
    
    while($row = $stmt->fetch())
    {
        if(((($_POST['newSearch']) == ($row['vehiclePrint'])) == true)||((($_POST['newSearch']) == ($row['vehicle_chassis_number'])) == true)||((($_POST['newSearch']) == ($row["registration_number"])) == true))
        {
            $_SESSION['row'][] = $row;
            $_SESSION['result'] = 'Here are the results:';
            $expireDate = strtotime($row['registration_to']);
            $timeLeft = ceil(($expireDate-time())/60/60/24);
            if($timeLeft > 30)
            {
                $_SESSION['color'] = 'text-dark';
            }
            elseif($timeLeft == 30)
            {
                $_SESSION['color'] = 'text-warning';
            }
            elseif($timeLeft < 30)
            {
                $_SESSION['color'] = 'text-danger';
            }
        }
        else
        {
            $_SESSION['noResult'] = 'There is no data on the search criteria';
        }
    }
    header("Location:dashbord.php");
    die();
}





