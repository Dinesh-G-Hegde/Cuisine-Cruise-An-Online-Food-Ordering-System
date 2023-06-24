<?php

session_start();
include("../connections.php");
include("../helpers.php");
$userdata = check_login($con);

$rid = $_GET['q'];

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
    <title>Food Section</title>
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url(<?php
                                                                                            // include("../connections.php");

                                                                                            $query = "SELECT RImg FROM restaurant WHERE RId = $rid";
                                                                                            $res = mysqli_query($con, $query);
                                                                                            $rimg = mysqli_fetch_array($res);
                                                                                            // $res->close();
                                                                                            // $con->next_result();
                                                                                            echo $rimg['RImg'];

                                                                                            ?>
);
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
    <main class="main-content">
        <h1 class="text-center text-white">Menu</h1>
        <div class="container-fluid">
            <div class="intro-section">
                <div class="row row-cols-1 row-cols-md-4 g-4">

                    <?php
                        $query_res = "SELECT * FROM food WHERE RId=$rid";
                        $food_details = mysqli_query($con, $query_res);
                    while ($entry = mysqli_fetch_array($food_details)) {
                        echo '<div class="col-auto ">
                        <div class="card h-100">
                            <img src="' . $entry['FImg'] . '" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">' . $entry['FoodName'] . '</h5>
                                <h5 class="card-title">Price: ₹' . $entry['Price'] . '</h5>
                                <p class="card-text">' . $entry['Description'] . '.</p><a href="./food.php?q=' . $entry['RId'] . '" target="_blank"">
                                <a href="addtocart.php?fid=' . $entry['FId'] . '&qty=1" class="btn btn-dark bg-dark">Add to cart</a>
                                </div></div></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

</body>

</html>