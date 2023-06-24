<?php
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

if (isset($_POST['submit'])) {
  if (isset($_FILES['RImg']) && $_FILES['RImg']['error'] == 0) {


    $fname = $_FILES['RImg']['name'];
    // $file_extensions = pathinfo($fname, PATHINFO_EXTENSION);
    $temp = $_FILES['RImg']['tmp_name'];
    $target_file = '../images/restaurants/' . $fname;

    if (move_uploaded_file($temp, $target_file)) {
      header("Location: restaurants.php");
    } else {
      die("File upload unsuccessfull!!");
      header("Location: addrestaurants.php");
    }
  } else {
    switch ($_FILES['RImg']['error']) {
      case UPLOAD_ERR_INI_SIZE:
        echo "The uploaded file exceeds the upload_max_filesize directive in php.ini";
        break;
      case UPLOAD_ERR_FORM_SIZE:
        echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
        break;
      case UPLOAD_ERR_PARTIAL:
        echo "The uploaded file was only partially uploaded";
        break;
      case UPLOAD_ERR_NO_FILE:
        echo "No file was uploaded";
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        echo "Missing a temporary folder";
        break;
      case UPLOAD_ERR_CANT_WRITE:
        echo "Failed to write file to disk";
        break;
      case UPLOAD_ERR_EXTENSION:
        echo "File upload stopped by extension";
        break;
      default:
        echo "Unknown upload error";
        break;
    }
  }



  $query = "INSERT INTO restaurant (RName,RType,Contact,Address,RImg) VALUE('" . $_POST['RName'] . "','" . $_POST['RType'] . "','" . $_POST['Contact'] . "','" . $_POST['Address'] . "','" . $target_file . "')";
  $run = mysqli_query($conn, $query);
  header("location:restaurants.php");
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OFDMS: Add Restaurant</title>
  <link rel="icon" href="../images/icons/online-delivery.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./stylesheet/res.css">

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
        <div class="row input-group mx-auto mb-3">
          <div class="form-floating">
            <input type="text" class="form-control" id="RName" name="RName" placeholder="Name">
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
            <input type="number" class="form-control" id="Contact" name="Contact" placeholder="Contact">
            <label for="Contact">Contact</label>
          </div>
        </div>
        <div class="row input-group mx-auto mb-3">
          <div class="form-floating">
            <input type="text" class="form-control" id="Address" placeholder="Address" name="Address">
            <label for="Address">Address</label>
          </div>
        </div>
        <div class="col input-group mx-auto mb-3">
          <input type="file" class="form-control" id="RImg" name="RImg">
          <label class="input-group-text" for="RImg">Upload</label>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">ADD</button>
      </form>
    </div>
  </div>
</body>



</html>