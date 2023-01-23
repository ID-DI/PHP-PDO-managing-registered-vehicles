<?php
    session_start();

    if(!isset($_SESSION['username']))
    {
        header("Location:login.php");
        die();
    }
    else
    {
        require_once __DIR__ . "/classes/header.php";
    }

    if(isset($_SESSION['error']))
    {
?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4 class='font-weight-normal text-danger my-2 text-center'><?=$_SESSION['error']?></h4>
                <?php unset($_SESSION['error']);
                }
                elseif(isset($_SESSION['deleted']))
                {
                    echo "<h4 class='font-weight-normal text-danger my-2 text-center'>{$_SESSION['deleted']}</h4>";
                    unset($_SESSION['deleted']);
                }
                elseif(isset($_SESSION['addVehicle']))
                {
                    echo "<h4 class='font-weight-normal text-success my-2 text-center'>{$_SESSION['addVehicle']}</h4>";
                    unset($_SESSION['addVehicle']);
                }
                ?>
            </div>

            <div class="col-md-6 offset-md-3">
                <h3 class="font-weight-bold my-3 text-center my-5">Add/remove vehicle models</h3>
            </div>
                <?php
                if(!isset($_SESSION['yesVehicle']) && !isset($_SESSION['noVehicle']))
                {?>

                <form action="vehicleModelAuth.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control col-6 offset-3" name="searchVehicle" placeholder="Search for vehicle model">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>        

            <?php
            }?>
        
            <div class="col-md-6 offset-md-3">      
                <?php
                    if(isset($_SESSION['yesVehicle']))
                    {
                ?>
                        <form action="VehicleModelDelete.php" method="POST">
                            <div class="input-group mb-3 d-flex flex-column">
                                <input type="hidden" class="form-control" name="deleteVehicle" value="<?=$_SESSION['yesVehicle']['vehicle_model']?>">
                                <p class="text-center"><?=$_SESSION['yesVehicleTxt']?></p>
                                <div class="mx-auto">
                                    <button class="btn btn-outline-danger mx-auto" type="submit">Delete</button>
                                     <a href="vehicleModel.php" class="btn btn-outline-success">No</a>
                                </div>

                            </div>
                        </form>
                <?php
                    unset($_SESSION['yesVehicle']);
                    unset($_SESSION['yesVehicleTxt']);
                    }
                    elseif(isset($_SESSION['noVehicle']))
                    {?>
                        <form action="VehicleModelAdd.php" method="POST">
                        <div class="input-group mb-3 text-center d-flex flex-column">
                            <input type="hidden" class="form-control" name="addVehicle" value="<?=$_SESSION['searchVehicle']?>">
                            <p><?=$_SESSION['noVehicle']?></p>
                            <div class="mx-auto">
                                <button class="btn btn-outline-success mx-auto" type="submit">Add</button>
                                <a href="vehicleModel.php" class="btn btn-outline-danger">No</a>
                            </div>
                        </div>

                    </form>
                <?php
                    unset($_SESSION['noVehicle']);
                    }
                ?>
            </div>
        </div>
    </div>
</main>





<?php
    require_once __DIR__ . "/classes/footer.php";
?>