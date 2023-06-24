<!DOCTYPE html>
<html lang="en">
<?php
include("../connections.php");
error_reporting(0);
session_start();

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OFDMS:Restaurants</title>
  <link rel="icon" href="../images/icons/online-delivery.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./stylesheet/res.css">


<body>
<header>
        <nav class="navbar navbar-dark bg-dark">
            <?php
            include("header.php");
            ?>
          </nav>
        </header>
  <div class="h1 text-center mt-2">Restaurants</div>
  <div class="container-fluid">
    <table class="table table-dark bg-dark table-hover">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Type</th>
          <th>Contact</th>
          <th>Address</th>
          <th>Action</th>

        </tr>
        </tbody>
        <?php

        $sql = "SELECT * FROM restaurant order by RId asc";
        $query = mysqli_query($con, $sql);

        if (!mysqli_num_rows($query) > 0) {
          echo '<td colspan="11"><center>No Restaurants</center></td>';
        } else {
          while ($rows = mysqli_fetch_array($query)) {

            echo ' <tr>
            <td><div class="col-md-3 col-lg-8 m-b-10">
            <center><img src="'. $rows['RImg'] .'
            " class="img-responsive radius"  
            style="max-width:auto;max-height:50px;border-radius:50%;"/></center>
            </div></td>
            <td>' . $rows['RName'] . '</td>
            <td>' . $rows['RType'] . '</td>
            <td>' . $rows['Contact'] . '</td>
            <td>' . $rows['Address'] . '</td>
            
            <td>
            <a href="updaterestaurants.php?res_upd=' . $rows['RId'] . '" class ="btn btn-success">Update</a>
            <a href="deleterestaurants.php?res_del=' . $rows['RId'] . '" class ="btn btn-danger">Delete</a> </td>
            </tr>';
          }
        }
        ?>
    </table>

    <a href="addrestaurants.php" class="btn btn-primary text-center">Add Restaurants</a>
  </div>
</body>

</html>