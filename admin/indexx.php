<?php
include("config.php");

if(!isset($_SESSION['user'])){
    header("location: admin_log.php");
}else{
    header("location: dashboard.php");
}