<header>
    <!-- Site Overlay -->
    <div class="site-overlay"></div>
    <!-- Topbar Navbar -->
    <nav class="navbar navbar-expand-xl navbar-light bg-white topbar mb-4 shadow fixed-top" id="navbarheight">
        <img src='<?php echo SITE_URL; ?>/images/logo.png' alt='logoSPIE' class='pr-3'/>
        <!-- Nav Item - User Information -->
        <h4 class="mr-3" id="bienvenue">Bienvenue <span class="text-primary"><?php echo $_SESSION["user"]["nom"]; ?></span></h4>
        <a class="text-primary nav-link" id="logout" href="<?php echo SITE_URL; ?>/admin/users/logout.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
            Logout
        </a>
        <!-- Topbar Toggle -->
        <button class="my-menu-btn navbar-toggler" type="button" data-target="#pushy-menu" aria-controls="#pushy-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class='collapse navbar-collapse' id='topbarCollapse'>
            <ul class="navbar-nav ml-auto">
                <li class='nav-item'>
                    <a class="nav-link text-dark" href="<?php echo SITE_URL; ?>/index.php">
                        <i class="fas fa-tachometer-alt fa-sm fa-fw mr-1"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo SITE_URL; ?>/pages/affaire.php">
                        <i class="fas fa-business-time fa-sm fa-fw mr-1"></i>
                        Numéro d'affaire
                    </a>
                </li>
                <li class='nav-item'>
                    <a class="nav-link text-dark" href="<?php echo SITE_URL; ?>/pages/clients.php">
                        <i class="far fa-address-card fa-sm fa-fw mr-1"></i>
                        Clients
                    </a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo SITE_URL; ?>/pages/stock/index.php">
                        <i class="far fa-file-alt fa-sm fa-fw mr-1"></i>
                        Stock
                    </a>
                </li>
         
                <li class='nav-item'>
                    <a class="nav-link text-dark" href="<?php echo SITE_URL; ?>/pages/fabricants.php">
                        <i class="fas fa-people-carry fa-sm fa-fw mr-1"></i>
                        Fabricants
                    </a>
                </li>
                <li class='nav-item'>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/index.php">
                        <mark class="text-alert ">ONLY Admin</mark>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Pushy Menu -->
    <nav class="pushy pushy-right" data-menu-btn-class=".my-menu-btn">
        <div class='pushy-content'>
            <ul  class="navbar-nav ml-auto">
                <li class='pushy-link'>
                    <a href="<?php echo SITE_URL; ?>/index.php">
                        <i class="fas fa-tachometer-alt fa-sm fa-fw mr-1"></i>
                        Home
                    </a>
                </li>
                <li class="pushy-link">
                    <a href="<?php echo SITE_URL; ?>/pages/affaire.php">
                        <i class="fas fa-business-time fa-sm fa-fw mr-1"></i>
                        Numéro d'affaire
                    </a>
                </li>
                <li class='pushy-link'>
                    <a href="<?php echo SITE_URL; ?>/pages/clients.php">
                        <i class="far fa-address-card fa-sm fa-fw mr-1"></i>
                        Clients
                    </a>
                </li>
                <li class="pushy-link">
                    <a href="<?php echo SITE_URL; ?>/pages/stock/index.php">
                        <i class="far fa-file-alt fa-sm fa-fw mr-1"></i>
                        Stock
                    </a>
                </li>
                <li class='pushy-link'>
                    <a href="<?php echo SITE_URL; ?>/pages/fabricants.php">
                        <i class="fas fa-people-carry fa-sm fa-fw mr-1"></i>
                        Fabricants
                    </a>
                </li>
                <li class='pushy-link'>
                    <a href="<?php echo SITE_URL; ?>/admin/index.php">
                        <span>ONLY Admin</span>
                    </a>
                </li>
            </ul>
        </div
    </nav>
</header>