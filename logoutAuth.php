<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location:index.php");
    die();
}
else
{
    require_once __DIR__ . "/classes/db.php";
    require_once __DIR__ . "/classes/header.php";
}

session_destroy();
header("Location:index.php");
die();
?>