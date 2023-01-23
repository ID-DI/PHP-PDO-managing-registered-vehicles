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
?>
<main>
    <div class="container-fluid">
    <?php
        if(isset($_SESSION['success']))
        {?>
        <h3 class="text-uppercase text-success mx-auto text-center"><?=$_SESSION['success']?></h3>
    <?php
        unset($_SESSION['success']);
        }
    ?>
        <?php
            if(isset($_SESSION['error']))
            {?>
            <h3 class="text-uppercase text-danger mx-auto text-center"><?=$_SESSION['error']?></h3>
        <?php
            unset($_SESSION['error']);
            }
            elseif(isset($_SESSION['deleted']))
            {?>
                 <h3 class="text-uppercase text-danger mx-auto text-center"><?=$_SESSION['deleted']?></h3>
        <?php  
            unset($_SESSION['deleted']);       
            }
        ?>
        <h2 class="text-center font-weight-bold text-capitalize mb-md-3">vehicle registration</h2>
        <div class="row">
            <div class="col-8 offset-2">
                <form action="dashbordAuth.php" method="POST" class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vehicle_models" class="text-capitalize">vehicle model</label>
                                <select class="form-control" id="vehicle_models" name="vehicle_models">
                                <option value="0">Please select a car model</option>
                                    <?php
                                        $stmt = $pdo->query("SELECT * FROM vehicle_models WHERE 1");
                                        while($row =$stmt->fetch())
                                        {
                                        echo "<option value = '{$row['id']}'>{$row['vehicle_model']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <label for="chassis" class="text-capitalize mt-md-1">vehicle chassis number</label>
                            <input type="text" class="form-control" id="chassis" name="vehicle_chassis_number">

                            <label for="reg_number" class="text-capitalize mt-md-1">registration number</label>
                            <input type="text" class="form-control" id="reg_number" name = "registration_number">

                            <label for="registration_to" class="text-capitalize mt-md-1">registration to</label>
                            <input type="date" class="form-control" id="registration_to" name= "registration_to">
                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vehicle_type" class="text-capitalize ">vehicle type</label>
                                <select class="form-control" id="vehicle_type" name="vehicle_type">
                                    <option value="sedan">sedan</option>
                                    <option value="coupe">coupe</option>
                                    <option value="hatchback">hatchback</option>
                                    <option value="suv">suv</option>
                                    <option value="minivan">minivan</option>
                                </select>
                            </div>

                            <label for="vehicle_production_year" class="text-capitalize mt-md-1">vehicle production year</label>
                            <input type="date" class="form-control" id="vehicle_production_year" name= "vehicle_production_year">

                            <div class="form-group mb-0">
                                <label for="fuel_type" class="text-capitalize mt-md-1 ">fuel type</label>
                                <select class="form-control mb-5" id="fuel_type" name="fuel_type">
                                    <option value="gasoline">gasoline</option>
                                    <option value="diesel">diesel</option>
                                    <option value="electric">electric</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block text-capitalize  align-content-end">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="border">
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark my-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarContent">
            <form method="POST" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="newSearch" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav> 

    <table class="table table-striped col-12 bg-light border mt-0 overflow-auto">
        <thead >
            <tr class = "font-weight-light font-10">
            <th scope="col" class="font-12 m-1 p-1">#</th> 
            <th scope="col" class="font-12 m-1 p-1">Vehicle model</th>
            <th scope="col" class="font-12 m-1 p-1">Vehicle type</th>
            <th scope="col" class="font-12 m-1 p-1">Chassis number</th>
            <th scope="col" class="font-12 m-1 p-1">Production year</th>
            <th scope="col" class="font-12 m-1 p-1">Registration number</th>
            <th scope="col" class="font-12 m-1 p-1">Fuel type</th>
            <th scope="col" class="font-12 m-1 p-1">Registration to</th>
            <th scope="col" class="font-12 text-center m-1 p-1">Action</th>
            </tr>
        </thead>

        <tbody >
            <?php
           
                if(isset($_POST['newSearch']))
                {
                    if(empty($_POST['newSearch']))
                    {
                        $_SESSION['newError'] = "Please fill the input before submiting";
                        die();
                    }
                    $_POST['newSearch'] = strtoupper($_POST['newSearch']);

                    $sql = "SELECT registrations.id, vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to  
                    FROM registrations 
                    LEFT JOIN vehicle_models
                    ON registrations.vehicle_model_id = vehicle_models.id
                    WHERE (vehicle_models.vehicle_model LIKE '___%') 
                    OR (registrations.vehicle_chassis_number LIKE '_______')
                    OR (registrations.registration_number LIKE '__-____-__')";

                    $stmt = $pdo->prepare($sql);
                    $stmt = $pdo->query($sql);
                    $i = 1;
                    $id=null;
                    while($row = $stmt->fetch())
                    {
                      
                        if(((($_POST['newSearch']) == ($row['vehiclePrint'])) == true)||((($_POST['newSearch']) == ($row['vehicle_chassis_number'])) == true)||((($_POST['newSearch']) == ($row["registration_number"])) == true))
                        {
                            $row[]=$row;
                            
                            $expireDate = strtotime($row['registration_to']);
                            $timeLeft = ceil(($expireDate-time())/60/60/24);
                            if($timeLeft > 30)
                            {
                                $color = 'text-dark';
                            }
                            elseif($timeLeft == 30)
                            {
                                $color = 'text-warning';
                            }
                            elseif($timeLeft < 30)
                            {
                                $color = 'text-danger';
                            }
                            echo "
                            <tr class='$color my-1'>
                            <td class='m-1 p-1'>$i</td>
                            <td class='m-1 p-1'>{$row['vehiclePrint']}</td>
                            <td class='m-1 p-1'>{$row['vehicle_type']}</td>
                            <td class='m-1 p-1'>{$row['vehicle_chassis_number']}</td>
                            <td class='m-1 p-1'>{$row['vehicle_production_year']}</td>
                            <td class='m-1 p-1'>{$row['registration_number']}</td>
                            <td class='m-1 p-1'>{$row['fuel_type']}</td>
                            <td class='m-1 p-1'>{$row['registration_to']}</td>  
                            <td class='m-1 p-1'>
                            <a href='deleteEntry.php?id={$row['id']}' class='btn btn-danger btn-sm mr-1'>Delete</a>
                            <a href='editVehicleD.php?id={$row['id']}' class='btn btn-warning btn-sm mr-1'>Edit</a>";
                            if(($color == 'text-warning')||($color == 'text-danger'))
                            {
                                echo "<a href='extendEntry.php?id={$row['id']}' class='btn btn-success btn-sm'>Extend</a>";
                            }
                            echo "</td>";
                            $i++;
                        }
                        else
                        {
                            $_SESSION['noResult'] = 'There is no data on the search criteria';
                        }
                    }
                }
                else
                {
                    $sql = "SELECT registrations.id, vehicle_models.vehicle_model AS vehiclePrint, registrations.vehicle_type, registrations.vehicle_chassis_number, registrations.vehicle_production_year, registrations.registration_number, registrations.fuel_type, registrations.registration_to, vehicle_models.vehicle_model  
                    FROM registrations 
                    LEFT JOIN vehicle_models
                    ON registrations.vehicle_model_id = vehicle_models.id
                    WHERE 1";
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt = $pdo->query($sql);
                    $i = 1;
                    $id=null;
                    while($row = $stmt->fetch())
                    {
                        $expireDate = strtotime($row['registration_to']);
                        $timeLeft = ceil(($expireDate-time())/60/60/24);
                        if($timeLeft > 30)
                        {
                            $color = 'text-dark';
                        }
                        elseif($timeLeft == 30)
                        {
                            $color = 'text-warning';
                        }
                        elseif($timeLeft < 30)
                        {
                            $color = 'text-danger';
                        }
                    ?>
                        <tr class="<?=$color?> my-1">
                        <td class="m-1 p-1"><?=$i?></td>
                        <td class="m-1 p-1"><?=$row['vehiclePrint']?></td>
                        <td class="m-1 p-1"><?=$row['vehicle_type']?></td>
                        <td class="m-1 p-1"><?=$row['vehicle_chassis_number']?></td>
                        <td class="m-1 p-1"><?=$row['vehicle_production_year']?></td>
                        <td class="m-1 p-1"><?=$row['registration_number']?></td>
                        <td class="m-1 p-1"><?=$row['fuel_type']?></td>
                        <td class="m-1 p-1"><?=$row['registration_to']?></td>  
                <?php 
                        $i++;
                        echo "
                        <td class='m-1 p-1'>
                        <a href='deleteEntry.php?id={$row['id']}' class='btn btn-danger btn-sm mr-1'>Delete</a>
                        <a href='editVehicleD.php?id={$row['id']}' class='btn btn-warning btn-sm mr-1'>Edit</a>";
                        if(($color == 'text-warning')||($color == 'text-danger'))
                        {
                            echo "<a href='extendEntry.php?id={$row['id']}' class='btn btn-success btn-sm'>Extend</a>";
                        }
                        echo "</td>";
                    }
                }
            ?>
        </tbody>
    </table>
</main>
<?php
require_once __DIR__ . "/classes/footer.php";
?>