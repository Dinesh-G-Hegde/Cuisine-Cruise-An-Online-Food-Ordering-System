<div class="container justify-content-space-between">
                <a class="navbar-brand" href="#">
                    <img src="../images/icons/online-delivery.svg" alt="LOGO" height="80px">
                    <div class="h1 d-inline-block align-text-top">Cuisine Cruise</div>
                </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Navigate to</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">
                        <li class="nav-item nav-item-active">
                            <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="orders.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="restaurants.php">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="food.php">Foods</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Register
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="NewDeliveryAgent.php">New Delivery Agent</a></li>
                                <li><a class="dropdown-item" href="addrestaurants.php">New Restaurant</a></li>
                                <li><a class="dropdown-item" href="addfood.php">New Food</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <a href="../logout.php" class="btn btn-danger">Log Out</a>
            </div>
            </div>