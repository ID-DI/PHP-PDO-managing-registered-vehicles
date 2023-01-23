<?php
session_start();
require_once __DIR__ . "/classes/db.php";
require_once __DIR__ . "/classes/header.php";

if (isset($_SESSION['username'])) {
    //already logged in
    header("Location: dashbord.php");
    die();
}

?>
<main class="container-fluid my-md-3">
    <div class="row">
        <div class="col-md-10 offset-md-1 bg-light">
            <div class="row">
                <div class="col-8 offset-2" >
                    <h1 class="text-capitalize text-center font-weight-bold pt-md-4 mb-0">vehicle registration</h1>
                    <h5 class="text-center font-weight-normal my-md-3">Enter you registration number to check its validity</h5>
                    <form  method ="POST" action="indexAuth.php" class = "mb-5 input-group">
                        <input type="text" name="registration_number" class="form-control w-50" placeholder="Registration number">
                        <button type="submit" class="btn btn-outline-primary form-control">Search</button>
                    </form>
                </div>
            </div>

            <?php
            if(isset($_SESSION['error']))
                {?>
                <h4 class="text-danger text-uppercase text-center pb-3"><?= $_SESSION['error']?></h4>
            <?php
                    unset($_SESSION['error']);
                }
            ?>
        </div>
    </div>


    <?php
        if(isset($_SESSION['all']))
        {
        echo "
        <div class='col-md-12 mb-3 '>
            <table class='table table-striped col-10 offset-1 bg-light border mt-5'>
                <thead >
                <tr class = 'font-weight-light font-10'>
                    <th scope='col' class='font-12'>#</th> 
                    <th scope='col' class='font-12'>Vehicle model</th>
                    <th scope='col' class='font-12'>Vehicle type</th>
                    <th scope='col' class='font-12'>Chassis number</th>
                    <th scope='col' class='font-12'>Production year</th>
                    <th scope='col' class='font-12'>Registration number</th>
                    <th scope='col' class='font-12'>Fuel type</th>
                    <th scope='col' class='font-12'>Registration to</th>
                </tr>
                </thead>
                <tbody >
                <tr >
                    <th scope='row'>1</th>
                    <td>{$_SESSION['all']['vehiclePrint']}</td>
                    <td>{$_SESSION['all']['vehicle_type']}</td>
                    <td>{$_SESSION['all']['vehicle_chassis_number']}</td>
                    <td>{$_SESSION['all']['vehicle_production_year']}</td>
                    <td>{$_SESSION['all']['registration_number']}</td>
                    <td>{$_SESSION['all']['fuel_type']}</td>
                    <td>{$_SESSION['all']['registration_to']}</td>
                </tr>
                </tbody>
            </table>
        </div>";
        }
        unset($_SESSION['all']);
        ?>
</main>

<?php
require_once __DIR__ . "/classes/footer.php"
?>
