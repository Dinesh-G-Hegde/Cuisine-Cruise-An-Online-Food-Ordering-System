<a class="navbar-brand" href="#">
    <img src="../images/icons/online-delivery.svg" alt="LOGO" height="80px">
    <div class="h1 d-inline-block align-text-top">Cuisine Cruise
    </div>
</a>


<!-- <a href="../logout.php" class="btn btn-danger">Log Out</a> -->
<div class="justify-content-end">
    <div class="d-flex gap-2 justify-content-end">
        <div class="cart">
            <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar">
                <span class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.1rem" height="1.1rem" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />

                    </svg>
                </span>
                Cart
            </button>

            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Your Cart</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php

                    $sql = "call fetch_cart($userdata[UserID])";
                    $result = mysqli_query($con, $sql);
                    $rest = mysqli_fetch_all($result);
                    // print_r($rest);
                    $result->close();
                    $con->next_result();
                    $total = 0;
                    if (empty($rest)) {
                        echo '
                                    <div class="d-grid mx-auto my-auto">
                                    <p class="text-muted">Cart is currently empty. Add some items.</p>
                                    </div>
                                    ';
                    } else {
                        // $result = mysqli_query($con, $sql);
                        // $result->close();
                        // $con->next_result();
                        foreach ($rest as $key => $eachrest) {
                            $rname = "SELECT RName FROM restaurant WHERE RId=$eachrest[0]";
                            $sol = mysqli_query($con, $rname);
                            $name = mysqli_fetch_row($sol)[0];
                            echo $name;
                            echo '<br><hr style="border-color:white;">';
                            $cart = json_decode($eachrest[1], true);

                            foreach ($cart as $foodid => $qty) {
                                $r = mysqli_query($con, "SELECT * FROM food WHERE FId='$foodid'");
                                $food = mysqli_fetch_array($r);
                                $total += $food['Price'] * $qty;
                                echo '<div class="card mb-3" style="max-height: 250px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="' . $food['FImg'] . '" class="img-fluid rounded-start" height="100%"; alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">' . $food['FoodName'] . '</h5>
                <h6 class="card-title">Quantity : ' . $qty . '</h6>
                <p class="card-text"><small class="text-muted">Price: ₹' . $food['Price'] * $qty . ' </small></p>
                <form action="addtocart.php" method="get">
                    <input type="hidden" name="fid" value="' . $foodid . '">
                    <input type="number" name="qty" min="1" placeholder="1" value="1" style="max-width:50px;">
                    <button class="btn btn-success btn-sm" type="submit">Change Quantity</button>
                </form>
                <div class="d-grid mx-auto">
                <a href="removefromcart.php?fid=' . $foodid . '" class="btn btn-danger">Remove</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
                                    ';
                            }
                        }
                    }

                    $con->next_result();
                    ?>
                </div>
                <button class="btn btn-warning" style="border-radius:0;pointer-events:none;">Total : ₹<?php echo $total; ?>.00</button>
                <form action="checkout.php" method="post">
                    <div class="d-grid mx-auto">
                        <input class="btn btn-outline-success" style="border-radius:0;<?php if ($total == 0) {
                                                                                            echo 'pointer-events:none;';
                                                                                        } ?>" type="submit" value="Place Order" name="submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="btn-group dropstart">
            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" style="padding-bottom:0;">Profile</a></li>
                <li><a class="dropdown-item" href="orders.php" style="padding-bottom:0;">My Orders</a></li>
                <li><a class="dropdown-item" href="index.php  " style="padding-bottom:0;">HomePage</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><span><a href="../logout.php" class="dropdown-item text-warning bg-danger">Log Out</a></span></li>
            </ul>
        </div>
    </div>