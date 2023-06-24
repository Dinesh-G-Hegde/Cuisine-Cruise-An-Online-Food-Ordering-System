<?php

session_start();

include("../connections.php");
include("../helpers.php");
check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['name'];
    // $lastname = $_POST['lastname'];
    $usermail = $_POST['mailid'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $query = "INSERT INTO `user` (`Name`, `MailID`, `Password`,`Address`, `Phone`, `UserType`) VALUES ('$firstname', '$usermail', '$password', '$address', '$phone', 'Delivery Agent')";

    mysqli_query($con, $query);

    header("Location: index.php");

    die;
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
    <script src="../form-validation.js"></script>
    <title>OFDMS</title>
    <style>
        .container-fluid {
            box-shadow: 5px 5px 25px var(--bs-primary);
            border-color: var(--bs-primary);
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
            <h2 class="row justify-content-center display-1 text-light">Register</h2>
            <form action="" class="needs-validation" method="post">



                <!-- NAME -->
                <div class="row input-group mx-auto mb-3">
                    <div class="input-group-text">
                        <span class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.5rem" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                            </svg>
                            </svg>
                        </span>
                        <!-- <i class="col-1 bi bi-person-fill"></i> -->
                        <div class="col-11 form-floating">
                            <input type="text" name="name" class=" form-control" id="Name" placeholder="John" required>
                            <label for="Name">Name</label>
                            <div id="FNvalid" class="valid-feedback"></div>
                        </div>
                    </div>
                </div>


                <!-- MAIL ID -->
                <div class="row input-group mx-auto mb-3">
                    <div class="input-group-text">
                        <span class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z" />
                                <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z" />
                            </svg>
                        </span>
                        <div class="col-11 form-floating">
                            <input type="text" name="mailid" class="form-control" id="MailId" placeholder="dognmevibin@mycar.com" required>
                            <label for="MailId">Email Address</label>
                            <div id="Mailvalid" class="valid-feedback"></div>
                        </div>
                    </div>
                </div>


                <!-- PASSWORD -->
                <div class="row input-group mx-auto mb-3">
                    <div class="input-group-text">
                        <span class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.5rem" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h5ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z" />
                            </svg>
                        </span>
                        <div class="col-11 form-floating">
                            <input type="password" name="password" class="form-control" id="Password" placeholder="Password" required>
                            <label for="Password">Password</label>
                            <div id="Passvalid" class="valid-feedback"></div>
                        </div>
                    </div>
                </div>




                <!--CONFIRM PASSWORD -->
                <div class="row input-group mx-auto mb-3">
                    <div class="input-group-text">
                        <span class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.5rem" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z" />
                            </svg>
                        </span>
                        <div class="col-11 form-floating">
                            <input type="password" class="form-control" id="ConfirmPassword" placeholder="Confirm Password" required>
                            <label for="ConfirmPassword">Confirm Password</label>
                            <div id="Passvalid" class="valid-feedback"></div>
                        </div>
                    </div>
                </div>



                <!-- ADDRESS -->
                <div class="row input-group mx-auto mb-3">
                    <div class="input-group-text">
                        <span class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                            </svg>
                        </span>
                        <div class="col-11 form-floating">
                            <textarea class="form-control" name="address" id="Address" placeholder="Type your address here." required></textarea>
                            <label for="Address">Address</label>
                            <div id="Addressvalid" class="valid-feedback"></div>
                        </div>
                    </div>
                </div>



                <!-- PHONE -->
                <div class="row input-group mx-auto mb-3">
                    <div class="input-group-text">
                        <span class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg>
                        </span>
                        <div class="col-11 form-floating">
                            <input type="number" name="phone" class="form-control" id="PhoneNumber" placeholder="Phone Number" maxlength="50" required>
                            <label for="PhoneNumber">Phone Number</label>
                            <div id="Phnovalid" class="valid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="d-grid col-4 input-group mx-auto mb-3">
                    <button id="register" class="btn btn-warning text-center" type="submit" disabled>Register</button>
                </div>

            </form>
        </div>
    </main>
</body>

</html>