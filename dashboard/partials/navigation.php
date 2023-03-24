<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="background-color: #526cfe!important;">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 fw-bold fs-3" href="<?= DASHBOARD_URL ?>">survey+</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- User handle-->
    <span class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 text-light">
      Howdy! <?= (isset($_SESSION["full_name"])) ? $_SESSION["full_name"] : "User" ?>
    </span>
    <!-- User handle-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form action="<?= base_url("includes/logout.inc.php") ?>" method="POST">
                        <button type="submit" class="dropdown-item fs-6">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>