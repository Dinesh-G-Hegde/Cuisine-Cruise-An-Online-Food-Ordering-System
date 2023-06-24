<?php

function check_login($con){
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];

        $query = "SELECT * FROM user WHERE UserID = '$id' LIMIT 1";

        $res = mysqli_query($con,$query);

        if($res && mysqli_num_rows($res)>0){
            $userdata = mysqli_fetch_assoc($res);
            return $userdata;
        }
    }

    //Redirect to login
    $root = $_SERVER[`DOCUMENT_ROOT`];
    header("Location: $root/OFDMS/login.php ");
    die;
}

?>