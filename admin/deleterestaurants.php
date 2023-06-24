<?php
include("../connections.php");
error_reporting(0);
session_start();

mysqli_query($con,"DELETE FROM restaurant WHERE RId = '".$_GET['res_del']."'");
header("location:restaurants.php");  

?>