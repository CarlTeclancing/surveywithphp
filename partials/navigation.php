<nav class="container-fluid border-bottom border-2 border-primary">

    <div class="container d-flex justify-content-between align-items-center py-4">

        <a href="<?= BASE_URL ?>" class="text-dark text-decoration-none fw-bolder display-5">
            <span>survey+</span>
        </a>

        <!-- Visibile only on mobile -->
        <div class="mobile_menu d-block d-lg-none">

            <button class="btn btn-primary text-white rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>



            <div class="offcanvas offcanvas-end bg-dark d-lg-none" tabindex="-1" id="offcanvasMenu" aria-labelledby="menuHeading">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="menuHeading">
                        <a href="#" class="text-white text-decoration-none fw-bolder display-5">
                            <span>survey+</span>
                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">

                    <h3 class="lead text-white"> Reach your audience wherever they may be. Share your survey via email, SMS Social media, blog and more.</h3>

                    <div class="mobile_menu__items mt-4 d-flex flex-column">

                        <ul class="nav d-flex flex-column">

                            <li class="nav-item">
                                <a href="<?= BASE_URL ?>" class="nav-link fs-4">Home</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link fs-4">About</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link fs-4">Features</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link fs-4">Explore</a>
                            </li>


                        </ul>


                        <div class="mt-4 d-flex flex-column justify-content-around align-items-center">

                            <?php if (!isset($_SESSION['user_id'])) : ?>

                                <a href="<?= BASE_URL . "/signup.php" ?>" class="d-block btn btn-outline-primary fs-4 w-100 rounded-0">Signup</a>

                                <a href="<?= BASE_URL . "/login.php" ?>" class="d-block btn btn-primary text-white fs-4 w-100 mt-3 rounded-0">Login</a>

                            <?php else : ?>

                                <a href="<?= DASHBOARD_URL ?>" class="d-block btn btn-outline-primary fs-4 w-100 rounded-0">Dashboard</a>


                                <form action="<?= base_url("includes/logout.inc.php") ?>" method="POST" class="w-100">
                                    <button type="submit" class="d-block btn btn-primary text-white rounded-0 fs-4 mt-3">Logout</button>
                                </form>

                            <?php endif ?>

                        </div>

                    </div>


                </div>
            </div>


        </div>

        <!-- Visibile only on large screens -->
        <div class="primary_menu d-none d-lg-block w-50 mx-auto">

            <nav class="primary_menu__nav d-flex justify-content-around">

                <a href="<?= BASE_URL ?>" class="fs-5 text-decoration-none text-dark <?= url_is("surveyplusweb") ? "active" : "" ?>">Home</a>
                <a href="#" class="fs-5 text-decoration-none text-dark">About</a>
                <a href="#" class="fs-5 text-decoration-none text-dark">Features</a>
                <a href="#" class="fs-5 text-decoration-none text-dark">Explore</a>

            </nav>


        </div>

        <!-- Visibile only on large screens -->
        <div class="d-none primary_menu__button--group d-lg-flex justify-content-around align-items-center">

            <?php if (!isset($_SESSION['user_id'])) : ?>

                <a href="<?= BASE_URL . "/signup.php" ?>" class="d-block btn btn-outline-secondary primary_menu__buttons--outline fs-5 w-100 rounded-0">Signup</a>

                <a href="<?= BASE_URL . "/login.php" ?>" class="d-block btn btn-primary text-white fs-5 w-100 rounded-0 ms-3">Login</a>

            <?php else : ?>

                <a href="<?= DASHBOARD_URL ?>" class="d-block btn btn-outline-secondary primary_menu__buttons--outline fs-5 w-100 rounded-0">Dashboard</a>

                <form action="<?= base_url("includes/logout.inc.php") ?>" method="POST">
                    <button type="submit" class="btn btn-primary text-white rounded-0 fs-5 ms-3">Logout</button>
                </form>
            <?php endif ?>

        </div>


    </div>


</nav>