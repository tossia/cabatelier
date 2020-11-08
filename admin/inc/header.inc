<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item no-arrow">
            <div class="text-dark nav-link">
                <span class="mr-2 d-none d-lg-inline align-middle">Bienvenue</span>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item no-arrow">
            <div class="text-primary nav-link">
                <span class="mr-2 d-none d-lg-inline"><?php echo $_SESSION["user"]["nom"]; ?></span>
            </div>
        </li>
        <li class="nav-item no-arrow">
            <a class="text-primary nav-link" href="<?php echo SITE_URL_ADMIN; ?>/users/logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
                Logout
            </a>
        </li>
        <li class="nav-item no-arrow">
            <a class="text-dark nav-link bg-warning" href="<?php echo SITE_URL; ?>/index.php">
                Page principale
            </a>
        </li>
    </ul>
</nav>