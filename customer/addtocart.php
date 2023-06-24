<?php

session_start();

include("../connections.php");
include("../helpers.php");

//To check user login
$userdata = check_login($con);

// To extract user id from login details
$user = (int)$userdata['UserID'];

// Food id of food that is to be added to cart and its qty
$foodid = $_GET['fid'];
$qty = (int)$_GET['qty'];


// Details of food to be fetched from food table
$fooddetails = "SELECT * FROM food WHERE FId = $foodid";
$resFood = mysqli_query($con, $fooddetails);
$food = mysqli_fetch_array($resFood);
$resId = $food['RId'];

//Details of cart of the user
$QueryCart= "SELECT Cart FROM cart WHERE UserID = $user AND RId=$resId";
$CartDefault = mysqli_query($con, $QueryCart);
$usercart = mysqli_fetch_assoc($CartDefault)['Cart'];


// If the user initially does not have an entry at the cart table
if(!mysqli_num_rows($CartDefault)){
    $json_string = array($foodid=>$qty);
    $cart = json_encode($json_string);
    $sqlInsert = "INSERT INTO `cart`(`UserID`,`RId`, `Cart`) VALUES ('$user','$resId','$cart')";
}

// When user has a cart with same restaurant Id
else{
    
    // Converting cart from json format to associative array
    $curcart = json_decode($usercart,true);
    
    // Add food of appropriate quantity to user's cart

    $curcart[$foodid] = $qty;



    //Converting PHP Associative Array into JSON format
    $cart = json_encode($curcart);
    
    
    //Query for updating cart
    $sqlInsert = "UPDATE cart SET Cart='$cart' WHERE UserID='$user' AND RId='$resId'";
}

// Executing required query
mysqli_query($con,$sqlInsert);


// Redirecting back to the menu
header("Location: food.php?q=$food[RId]");

?>
