<!DOCTYPE html>
<html lang="en">
<?php
include("../connections.php");
include("../helpers.php");
error_reporting(0);
session_start();
check_login($con);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OFDMS: Foods</title>
  <link rel="icon" href="../images/icons/online-delivery.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./stylesheet/res.css">

    <style>
      body{
        background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), url(./../images/pagebg/foods-bg.jpg);
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
        <div class="h1 text-center mt-2">Food</div>
  <div class="container-fluid">

    <table class="table table-dark bg-dark table-hover">
      <thead>
        <tr>
          <!-- <th> Food Id</th> -->
          <th>Image</th>
          <th>Food Name</th>
          <th>Restaurant Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php

        $sql = "SELECT f.*,r.RName FROM food f, restaurant r WHERE r.RId = f.RId order BY(FId) asc";
        $query = mysqli_query($con, $sql);

        if (!mysqli_num_rows($query)) {
          echo '<tr><td colspan="11"><center>No Food</center></td></tr>';
        } else {
          while ($rows = mysqli_fetch_array($query)) {

            echo ' <tr>
            <td><div class="col-md-3 col-lg-8 m-b-10">
            <center><img src="'. $rows['FImg'].'" class="img-responsive radius"  
            style="max-width:auto;max-height:50px;border-radius:50%;"/></center>
            </div></td>
            <td>' . $rows['FoodName'] . '</td>
<td>' . $rows['RName'] . '</td>
<td>' . $rows['Description'] . '</td>
<td>' . $rows['Price'] . '</td>



<td>
<a href="updatefood.php?res_upd=' . $rows['FId'] . '" class ="btn btn-success">Update</a>
<a href="deletefood.php?res_del=' . $rows['FId'] . '" class ="btn btn-danger">Delete</a> </td>
</tr>';
          }
        }
        ?>
      </tbody>
    </table>
    <a href="addfood.php" class="btn btn-primary text-center">Add Food</a>
  </div>
</body>

</html>