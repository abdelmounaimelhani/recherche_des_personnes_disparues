<?php $bg1 = (isset($_SESSION["user"])) ? "bg-dark" : "bg-warning" ; ?>
<?php $bg2 = (isset($_SESSION["user"])) ? "bg-gradient-faded-dark" : "bg-gradient-faded-warning" ; ?>
<div class="min-height-200 <?=$bg1?> position-absolute w-100"></div>
<aside class="<?=$bg2?> sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="text-white ms-1 font-weight-bold">LOGO</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="?action=Accueil">
                    <div
                        class=" icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-home text-white text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">Accueil</span>
                </a>
            </li>

            <?php if (isset($_SESSION['user'])) :?>
            
            <li class="nav-item">
                <a class="nav-link " href="?action=Disparues">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-friends text-white text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">les Disparus</span>
                </a>
            </li>
            <?php endif;if (isset($_SESSION['ass'])) : ?>
            <li class="nav-item">
                <a class="nav-link " href="?action=Individue">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-friends text-white text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">L'individus</span>
                </a>
            </li>

            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link " href="?action=Recherch_desparu">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-search text-white text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">Recherch Disparu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="?action=Messge">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-envelope text-white text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">Messages</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-white text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="http://localhost/Project/?action=Profile">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-white text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="?action=logout">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-info text-sm opacity-10"></i>
                    </div>
                    <span class="text-white nav-link-text ms-1">Docennexion</span>
                </a>
            </li>
        </ul>
    </div>
</aside>