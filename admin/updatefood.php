<?php //include("connect.php");
error_reporting(0);
session_start();

$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "ofdms";  //database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$conn) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}
// $conn=include("connect.php");

if(isset($_POST['submit'])) 
{
    
    $query = "update food set FoodName='$_POST[FoodName]',Description='$_POST[Description]',Price='$_POST[Price]' where FId='$_GET[res_upd]'";
    $run = mysqli_query($conn, $query);
    header("location:food.php");  
    //move_uploaded_file($temp, $store);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
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
<div class="cards">
        <div class="container-fluid">
            <form action="#" method="post" enctype="multipart/form-data">
            <?php $ssql = "select * from restaurant where RId='$_GET[res_upd]'";
            $res = mysqli_query($conn, $ssql);
            $row = mysqli_fetch_array($res); ?>
                <div class="row input-group mx-auto mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="RName" name="RName" placeholder="Name"  value="<?php echo $row['RName'];  ?>">
                        <label for="RName">Name</label>
                    </div>
                </div>
                <div class="col input-group mx-auto mb-3" style="justify-content:space-evenly">
                    <div class="col-3">
                        <input type="radio" class="form-control-input" id="RType" name="RType" value="Vegetarian" checked>
                        <label for="RType">Veg</label>
                    </div>
                    <div class="col-3">
                        <input type="radio" class="form-control-input" id="Rtype1" name="RType" value="Non-Vegetarian">
                        <label for="RType">Non-Veg</label>
                    </div>
                </div>
                <div class="row input-group mx-auto mb-3 ">
                    <div class="form-floating ">
                        <input type="number" class="form-control" id="Contact" name="Contact" placeholder="Contact"  value="<?php echo $row['Contact'];  ?>">
                        <label for="Contact">Contact</label>
                    </div>
                </div>
                <div class="row input-group mx-auto mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="Address" placeholder="Address" name="Address" value="<?php echo $row['Address'];?>">
                        <label for="Address">Address</label>
                    </div>
                </div>
                <div class="col input-group mx-auto mb-3">
                    <input type="file" class="form-control" id="RImg" name="RImg" value="<?php echo $row['RImg']; ?>">
                    <label class="input-group-text" for="RImg">Upload</label>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
        </div>
    </div>
</body>



</html>