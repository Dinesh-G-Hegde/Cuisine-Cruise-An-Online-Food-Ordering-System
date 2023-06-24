<?php

session_start();

include("../connections.php");
include("../helpers.php");

$userdata = check_login(($con));
$query = "SELECT * FROM orders WHERE userID='$userdata[UserID]'";
$res = mysqli_query($con, $query);


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icons/online-delivery.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./stylesheet/index.css">
    <title>OFDMS</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <?php
            include('header.php');
            ?>
        </nav>
    </header>


    <main class="main-content">
        <h1 class="text-center text-white">My Orders</h1>       
        <div class="container-fluid">
            
            <table class="table table-dark table-hover">
            <thead>
            <tr>
            <td>
                <h5>OrderId</h5>
            </td>
            <td>
                <h5>Ordered Placed At</h5>
            </td>
            <td>
                <h5>Ordered From</h5>
            </td>
            <td>
                <h5>Delivery Agent</h5>
            </td>
            <td>
                <h5>Order Status</h5>
            </td>
            </tr>
            </thead>
            <tbody>

            
            
                <?php
                    
                    while($row = mysqli_fetch_array($res)){
                        if($row['Delivery_Agent'] == NULL){
                            $DelAg = 'Delivery Agent Not Assigned';
                        }
                        else{
                            $qu = "SELECT Name FROM user WHERE UserID='$row[Delivery_Agent]'";
                            $DelAg = mysqli_fetch_row(mysqli_query($con,$qu))[0];
                        }

                        echo '
                            <tr>
                            <td>#'.$row['Ord_No'].'</td>
                            <td>'.$row['Ordered_On'].'</td>
                            <td>';
                        
                            $rname = "SELECT RName FROM restaurant WHERE RId='$row[rid]'";
                            $sol = mysqli_query($con, $rname);
                            $name = mysqli_fetch_row($sol)[0];
                            // print_r($name);
                        
                        echo ''.$name.'</td>
                            <td>'.$DelAg.'</td>
                            <td>'.$row['Status'].'</td>
                            </tr>
                        ';
                    }


                ?></tbody>
            </table>
        </div>
    </main>


</body>

</html>