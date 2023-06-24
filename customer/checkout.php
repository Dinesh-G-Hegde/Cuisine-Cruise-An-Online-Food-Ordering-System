<?php

session_start();

include("../connections.php");
include("../helpers.php");

$userdata = check_login(($con));
$user = $userdata['UserID'];
$sql = "call fetch_cart($user)";
$result = mysqli_query($con, $sql);
$rest = mysqli_fetch_all($result);
$result->close();
$con->next_result();

foreach ($rest as $key => $eachrest) {
    $total = 0;
    $rid = $eachrest[0];
    $cart = json_decode($eachrest[1], true);
    foreach ($cart as $foodid => $qty) {
        $r = mysqli_query($con, "SELECT * FROM food WHERE FId='$foodid'");
        $food = mysqli_fetch_array($r);
        $total += $food['Price'] * $qty;
        $orderDetails = json_encode($cart);
        $query = "INSERT INTO `orders`(`userID`,`rid`,`Order_Details`, `Total`) VALUES ('$user','$rid','$orderDetails','$total')";
        mysqli_query($con, $query);
        $remove = "DELETE FROM cart WHERE UserID='$user' AND RId='$rid'";
        mysqli_query($con, $remove);
    }
}

header("Location:orders.php");




// echo 'Order Placed';

?>