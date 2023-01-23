<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require_once __DIR__ . "/classes/db.php";
}
else
{
    $_SESSION['error'] = "Only POST requests.";
    header("Location:login.php");
    die();
}

// tuka prave proverka za username!!!
$sql = "SELECT * FROM admins WHERE (username = :username)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username'=>$_POST['username']]);

if($stmt->rowCount() == 1)
{
    $admin = $stmt->fetch();

    if(password_verify($_POST['password'], $admin['pass']))
    {
        $_SESSION['username'] = $admin['username'];
        header("Location:dashbord.php");
        die();
    } 
    else
    {
        $_SESSION['error'] = "Wrong password";
        header("Location:login.php");
        die();
    }
}
else
{
    $_SESSION['error'] = "Wrong credentials";
    header("Location:login.php");
    die();
}