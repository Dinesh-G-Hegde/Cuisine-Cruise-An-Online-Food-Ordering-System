<?php
include("../connections.php");
error_reporting(0);
session_start();

mysqli_query($con,"DELETE FROM food WHERE FId = '".$_GET['res_del']."'");
header("location:food.php");  

?>