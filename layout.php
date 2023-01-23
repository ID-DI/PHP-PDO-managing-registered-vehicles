<?php
session_start();
require_once __DIR__ . "/classes/db.php";
require_once __DIR__ . "/classes/header.php";

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  die();
}?>

 <div class="conatiner">
  <div class="row my-5 ">
    <table class="table table-striped col-10 offset-1 bg-light border mt-5">
<?php
if(isset($_SESSION['extendEntry']))
{
  echo "<h4 class='text-success font-weight-bold text-uppercase mx-auto'>{$_SESSION['extendEntry']}</h4>";

}
elseif(isset($_SESSION['success']))
{?> 
    <h4 class="text-success font-weight-bold text-uppercase mx-auto"><?=$_SESSION['success']?></h4>
<?php
unset($_SESSION['success']);
}
elseif(isset($_SESSION['deletedTxt']))
{?>
      <h4 class="text-danger font-weight-bold text-uppercase mx-auto"><?=$_SESSION['deletedTxt']?></h4>
<?php

}
?>
      <thead >
        <tr class = "font-weight-light font-10">
          <th scope="col" class="font-12">#</th> 
          <th scope="col" class="font-12">Vehicle model</th>
          <th scope="col" class="font-12">Vehicle type</th>
          <th scope="col" class="font-12">Chassis number</th>
          <th scope="col" class="font-12">Production year</th>
          <th scope="col" class="font-12">Registration number</th>
          <th scope="col" class="font-12">Fuel type</th>
          <th scope="col" class="font-12">Registration to</th>
        </tr>
      </thead>
      <tbody >
        <tr >
          <th scope="row">1</th>
          <td><?=$_SESSION['all']['vehiclePrint']?></td>
          <td><?=$_SESSION['all']['vehicle_type']?></td>
          <td><?=$_SESSION['all']['vehicle_chassis_number']?></td>
          <td><?=$_SESSION['all']['vehicle_production_year']?></td>
          <td><?=$_SESSION['all']['registration_number']?></td>
          <td><?=$_SESSION['all']['fuel_type']?></td>
          <?php
            if(isset($_SESSION['extendEntry']))
            {
              echo "
              <td class = 'd-flex justify-content-between'><form action='extendEntry.php?id={$_SESSION['all']['id']}' method='POST'>
              <input type='date' name='extendEntry'>
              <button type='submit' class='btn btn-outline-success btn-sm p-1 mx-auto my-1'>Extend</button>
            </form></td>";
            unset($_SESSION['extendEntry']);
            }
            else{?>
          <td><?=$_SESSION['all']['registration_to']?></td>
          <?php
            }
          ?>
        </tr>
      </tbody>
    </table>

  </div>
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <?php
      //  var_dump($_SESSION['all']);
      //  die;
        if(isset($_SESSION['deletedTxt']))
        {
        echo "
        <div class='d-flex flex-row justify-content-center'>
          <form action='deleteEntry.php?id={$_SESSION['all']['id']}' method ='POST'>
            <input type='hidden' name='deleteEntry'>
            <button type='submint' class='btn btn-outline-danger mr-2'>Delete</button>
          </form>
            <a href='dashbord.php' class='btn btn-outline-success '>No</a>
        </div>";
        }
        unset($_SESSION['all']);
        unset($_SESSION['deletedTxt']);
      ?>
    </div>
  </div>
</div>


<?php
  require_once __DIR__ . "/classes/footer.php";
?>