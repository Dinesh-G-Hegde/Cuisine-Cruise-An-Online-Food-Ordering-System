<?php

session_start();

include("../connections.php");
include("../helpers.php");
check_login($con);

$CurrOrders = "SELECT * FROM orders WHERE DATE(`Ordered_On`)=CURDATE()";
$res = mysqli_query($con,$CurrOrders);

// $query = "SELECT UserId, Name FROM user WHERE UserType='Delivery Agent'";
$DeliveryAgents = mysqli_fetch_all(mysqli_query($con, "SELECT UserId, Name FROM user WHERE UserType='Delivery Agent'"));

if (isset($_POST['Agent'])){
    $a = $_POST['Agent'];
    $exp = explode(",",$a);
    mysqli_query($con, "UPDATE orders SET Delivery_Agent='$exp[0]', Status='Order Placed' WHERE Ord_No='$exp[1]'");
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
    <link rel="stylesheet" href="./stylesheet/index.css">
    <title>OFDMS</title>
    <style>
        .container-fluid {
            box-shadow: 5px 5px 25px var(--bs-warning);
            border-color: var(--bs-warning);
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <?php
            include("header.php");
            ?>

        </nav>
    </header>

    <main>
    <div class="container-fluid">
    <h1 class="text-center text-white">Orders</h1>
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
                        
                        echo '
                        <tr>
                        <td>#'.$row['Ord_No'].'</td>
                        <td>'.$row['Ordered_On'].'</td>
                        <td>';
                        
                        $rname = "SELECT RName FROM restaurant WHERE RId='$row[rid]'";
                        $sol = mysqli_query($con, $rname);
                        $name = mysqli_fetch_row($sol)[0];
                        
                        echo ''.$name.'</td>
                        <td> ';
                        if($row['Delivery_Agent'] == NULL){
                            $DelAg = 'Delivery Agent Not Assigned';
                            echo '<form id="'.$row['Ord_No'].'" name="Agent" action="#" method="post">
                            <select name="Agent" class="form-select form-select-lg mb-3 text-black" onchange="this.form.submit()">
                            <option selected disabled><button>
                        '.$DelAg.'</button></option>
                            ';

                            foreach ($DeliveryAgents as $arrkey => $value){
                                echo '<option value="'.$value[0].','.$row['Ord_No'].'">'.$value[1].'</option>';
                            }
                            echo '</form>
                            ';
                            echo ' <script>
                                document.getElementById("'.$row[`Ord_No`].'").onsubmit = function(){
                                    this.form.submit();
                                };
                            </script> ';
                    }
                    else{
                        $qu = "SELECT Name FROM user WHERE UserID='$row[Delivery_Agent]'";
                        $DelAg = mysqli_fetch_row(mysqli_query($con,$qu))[0];
                        echo $DelAg;
                        }
                        // print_r($DeliveryAgents);
                        echo '</td>
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