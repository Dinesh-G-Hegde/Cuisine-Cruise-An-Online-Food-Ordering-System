<?php

session_start();

include("../connections.php");
include("../helpers.php");

$userdata = check_login(($con));

$query = "SELECT * FROM stats";
$stat = mysqli_query($con, $query);
$row = mysqli_fetch_array($stat);
$stat->close();
$con->next_result();

$today = "SELECT SUM(`Total`) AS Total FROM orders WHERE DATE(`Ordered_On`)=CURDATE() AND `Status` = 'Delivered'";
$price = mysqli_query($con, $today);
$today_total = mysqli_fetch_array($price)['Total'];
$price->close();
$con->next_result();

$sumtotal = "SELECT SUM(`Total`) AS Total FROM orders WHERE `Status` = 'Delivered'";
$res = mysqli_query($con, $sumtotal);
$total = mysqli_fetch_array($res)['Total'];
$res->close();
$con->next_result();

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
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <?php
            include("header.php");
            ?>

        </nav>
    </header>
    <section>
        <div class="container-fluid" style="font-size: 1.3rem;">
            <div class="d-flex">
                <div class="col-8">
                    <div class="intro-section">
                        <div class="card text-bg-danger">
                            <div class="d-flex flex-row" style="gap:0;padding:0.8rem;">
                                <img src="../images/icons/users.svg" alt="Users" class="img-fluid rounded" width="96" height="96">
                                <div class="card-body" style="padding-left:0;">
                                    <h3 class="card-title"><?php echo $row['NoOfUsers']; ?></h3>
                                    <p class="card-text">Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="card text-bg-dark">
                            <div class="d-flex flex-row" style="gap:0;padding:0.8rem;">
                                <img src="../images/icons/delivery-man.svg" alt="Users" class="img-fluid rounded" width="96" height="96">
                                <div class="card-body" style="padding-left:0;">
                                <h3 class="card-title"><?php echo $row['NoOfDelAgents']; ?></h3>
                                <p class="card-text">Delivery Agents</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card text-bg-warning">
                            <div class="d-flex flex-row" style="gap:0;padding:0.8rem;">
                                <img src="../images/icons/restaurants.svg" alt="Users" class="img-fluid rounded" width="96" height="96">
                                <div class="card-body" style="padding-left:0;">
                                <h3 class="card-title"><?php echo $row['NoOfRestaurants']; ?></h3>
                                <p class="card-text">Restaurants</p>
                                </div>
                            </div>
                        </div>
                        <div class="card text-bg-light">
                            <div class="d-flex flex-row" style="gap:0;padding:0.8rem;">
                                <img src="../images/icons/user-interface.svg" alt="Users" class="img-fluid rounded" width="96" height="96">
                                <div class="card-body" style="padding-left:0;">
                                <h3 class="card-title"><?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM orders"))[0] ; ?></h3>
                                <p class="card-text">Orders Till Date</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col text-light">
                    <div class="card text-bg-success" style="padding:0.8rem;align-items:center;">
                        <h2 class="card-title">Earnings</h2>
                        <img src="../images/icons/revenue.png" alt="Users" class="img-fluid" width="96" height="96">
                        <div class="card-body">
                            <h4>Today: ₹<?php
                                    if ($today_total != ''){
                                        echo $today_total;
                                    }
                                    else{
                                        echo '0';
                                    }
                                ?>.00</h4>
                            <h3>Total: ₹<?php
                                    if ($total != ''){
                                        echo $total;
                                    }
                                    else{
                                        echo '0';
                                    }
                                ?>.00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


</body>

</html>