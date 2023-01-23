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


$sql = "SELECT * FROM registrations WHERE id = {$_GET['id']}";

$stmt = $pdo->query($sql);

$vehicle= $stmt->fetch();


?>
<div class="container-fluid">

    <?php
        if(isset($_SESSION['error']))
        {?>
        <h3 class="text-uppercase text-danger mx-auto text-center"><?=$_SESSION['error']?></h3>
    <?php
        unset($_SESSION['error']);
        }
    ?>
    <h2 class="text-center font-weight-bold text-capitalize mb-md-3">edit vehice registration</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="updateVehicleD.php" method="POST" class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-baseline">
                            <input type="hidden" name="id" value="<?= $vehicle['id'] ?>" />
                            <label for="vehicle_models" class="text-capitalize">vehicle model</label>
                            </div>
                            
                            <select class="form-control" id="vehicle_models" name="vehicle_models">
                            <option value="0">Please select a car model</option>;
                                <?php

                                    $stmt = $pdo->query("SELECT * FROM vehicle_models WHERE 1");
                                    while($row = $stmt->fetch())
                                
                                    {
                                      echo "<option value = '{$row['id']}'>{$row['vehicle_model']} </option>";
                                    }
                                ?>
                                
                            </select>
                        </div>

                        <label for="vehicle_chassis_number" class="text-capitalize mt-md-1">vehicle chassis number</label>
                        <input type="text" class="form-control" id="vehicle_chassis_number" name="vehicle_chassis_number" value="<?= $vehicle['vehicle_chassis_number'] ?>">

                        <label for="registration_number" class="text-capitalize mt-md-1">registration number</label>
                        <input type="text" class="form-control" id="registration_number" name = "registration_number"  value="<?= $vehicle['registration_number'] ?>">

                        <label for="registration_to" class="text-capitalize mt-md-1">registration to</label>
                        <input type="date" class="form-control" id="registration_to" name= "registration_to" value="<?= $vehicle['registration_to'] ?>">
                        
                    </div>

                    <div class="col-md-6 align-items-baseline">
                        <div class="form-group">
                            <label for="vehicle_type" class="text-capitalize ">vehicle type</label>
                            <select class="form-control" id="vehicle_type" name="vehicle_type" >
                                <option value="<?= $vehicle['vehicle_type'] ?>"><?= $vehicle['vehicle_type'] ?></option>
                                <option value="sedan">Sedan</option>
                                <option value="coupe">Coupe</option>
                                <option value="hatchback">Hatchback</option>
                                <option value="suv">Suv</option>
                                <option value="minivan">Minivan</option>
                            </select>
                        </div>

                        <label for="vehicle_production_year" class="text-capitalize mt-md-1">vehicle production year</label>
                        <input type="date" class="form-control" id="vehicle_production_year" name= "vehicle_production_year" value="<?= $vehicle['vehicle_production_year'] ?>">

                        <div class="form-group mb-0">
                            <label for="fuel_type" class="text-capitalize mt-md-1 ">fuel type</label>
                            <select class="form-control mb-5" id="fuel_type" name="fuel_type" >
                                <option value="<?= $vehicle['fuel_type'] ?>"><?= $vehicle['fuel_type'] ?></option>
                                <option value="gasoline">Gasoline</option>
                                <option value="diesel">Diesel</option>
                                <option value="electric">Electric</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
require_once __DIR__ . "/classes/footer.php";
?>