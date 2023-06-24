<?php

session_start();
include("../connections.php");
include("../helpers.php");

$userdata=check_login($con);

$foodid = (int)$_GET['fid'];

// To extract user id from login details
$user = (int)$userdata['UserID'];

// Details of food to be fetched from food table
$fooddetails = "SELECT * FROM food WHERE FId = $foodid";
$resFood = mysqli_query($con, $fooddetails);
$food = mysqli_fetch_array($resFood);
$resId = $food['RId'];

//Details of cart of the user
$QueryCart= "SELECT Cart FROM cart WHERE UserID = $user AND RId=$resId";
$CartDefault = mysqli_query($con, $QueryCart);
$usercart = mysqli_fetch_assoc($CartDefault)['Cart'];

// Converting cart from json format to associative array
$curcart = json_decode($usercart,true);

unset($curcart[$foodid]);

if (empty($curcart)){
    $remove = "DELETE FROM cart WHERE UserID='$user' AND RId='$resId'";
}
else{
    $cart = json_encode($curcart);
    $remove = "UPDATE cart SET Cart='$cart' WHERE UserID='$user' AND RId='$resId'";
}


mysqli_query($con,$remove);

header("Location: food.php?q=$food[RId]");




?>