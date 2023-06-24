<?php

session_start();

include("../connections.php");
include("../helpers.php");

$userdata = check_login(($con));

$CurrOrders = "SELECT * FROM orders WHERE Delivery_Agent='$userdata[UserID]'";
$res = mysqli_query($con,$CurrOrders);
$DelStatus = ["Order Picked Up", "Delivered"];
if (isset($_POST['Agent'])){
    $a = $_POST['Agent'];
    $exp = explode(",",$a);
    $status = $DelStatus[$exp[0]];
    mysqli_query($con, "UPDATE orders SET Status='$status' WHERE Ord_No='$exp[1]'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icons/online-delivery.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../admin/stylesheet/index.css">
    <title>OFDMS</title>
    <style>
        .container-fluid {
            box-shadow: 5px 5px 25px var(--bs-warning);
            border-color: var(--bs-warning);
        }
    </style>
<body>
<header>
        <nav class="navbar navbar-dark bg-dark">
            <?php
            include("header.php");
            ?>

        </nav>
    </header>
<main class="main-content">
        <h1 class="text-center text-white">Orders</h1>       
        <div class="container-fluid">
            
            <table class="table table-dark table-hover">
            <thead>
            <tr>
            <td>
                <h5>OrderId</h5>
            </td>
            <td>
                <h5>Delivery Address</h5>
            </td>
            <td>
                <h5>Ordered From</h5>
            </td>
            <td>
                <h5>Order Status</h5>
            </td>
            <td></td>
            </tr>
            </thead>
            <tbody>

            
            
                <?php
                    
                    while($row = mysqli_fetch_array($res)){

                        echo '
                            <tr>
                            <td>#'.$row['Ord_No'].'</td>
                            <td>';

                            $delAddr = mysqli_fetch_row(mysqli_query($con, "SELECT Address FROM user WHERE UserID='$row[userID]'"))[0];
                            echo ''.$delAddr.'</td>
                            <td>';
                        
                            $rname = "SELECT RName FROM restaurant WHERE RId='$row[rid]'";
                            $sol = mysqli_query($con, $rname);
                            $name = mysqli_fetch_row($sol)[0];
                            // print_r($name);
                        
                        echo ''.$name.'</td>
                            <td>'.$row['Status'].'</td>
                            <td>';
                        if ($row['Status'] == 'Order Placed'){
                            echo '<form name="form" action="#" method="post">
                            <input name="Agent" type="hidden" value="0,'.$row['Ord_No'].'">
                            <input type="submit" class="btn btn-warning" value="Change Status to \'Order Picked\'">
                            </form></td>';
                        }
                        elseif($row['Status'] == $DelStatus[0]){
                            echo '<form name="form" action="#" method="post">
                            <input name="Agent" type="hidden" value="1,'.$row['Ord_No'].'">
                            <input type="submit" class="btn btn-success" value="Change Status to \'Delivered\'">
                            </form></td>';
                        }
                        else{
                            echo '<td></td>';
                        }
                        
                            echo '
                            </tr>
                        ';
                    }


                ?></tbody>
            </table>
        </div>
    </main>
</body>
</html>