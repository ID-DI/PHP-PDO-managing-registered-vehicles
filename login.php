<?php
session_start();

if(isset($_SESSION['username'])) {
    //already logged in
    header("Location: dashbord.php");
    die();
}

require_once __DIR__ . "/classes/header.php";
?>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 text-center my-5">
            <h4 class="my-3">Enter your credentials:</h4>
            <form action = "loginAuth.php" method = "POST" >
                <div class="form-group">
                    <?php
                        if(isset($_SESSION['error']))
                        {?>
                          <h4 class="font-weight-bold text-danger"><?= $_SESSION['error']?></h4>
                    <?php 
                        unset($_SESSION['error']);    
                        }?>
                 
                <input type="text" name="username" class="form-controls" placeholder="Username:">  
                <input type="password" name="password" class="form-controls" placeholder="Password:">  
                </div>
                <button type="submit" class="btn btn-outline-dark mt-3">Submit</button>
            </form>
        </div>
    </div>
</div> 

<?php
require_once __DIR__ . "/classes/footer.php";
?>