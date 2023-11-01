<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('./src/css/sidebar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('./src/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body>
    <header>
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse default-color">
            <div class="position-sticky">
                <div class="list-group mx-3 mt-4 default-color">
                    <a href="" class="text-light mt-4">
                        <i class="fas fa-tachometer-alt fa-fw fa-lg me-3"></i><span>Dashboard</span>
                    </a>
                    <hr class="text-light">
                    <a href="" class="text-light">
                        <i class="fa-solid fa-building fa-fw fa-lg me-3"></i><span>Organisasi</span>
                    </a>
                    <hr class="text-light">
                    <a href="<?php echo base_url('superadmin/admin') ?>" class="text-light">
                        <i class="fa-solid fa-chalkboard-user fa-fw fa-lg me-3"></i><span>Admin</span>
                    </a>
                    <hr class="text-light">
                    <a href="" class="text-light">
                        <i class="fa-solid fa-users fa-fw fa-lg me-3"></i><span>User</span>
                    </a>
                    <hr class="text-light">
                    <a href="" class="text-light">
                        <i class="fa-solid fa-address-card fa-lg me-3"></i><span>Absensi</span>
                    </a>
                </div>
            </div>
        </nav>


        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark default-color fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand">
                    <img src="<?php echo base_url('./src/assets/image/absensi.png'); ?>" height="50" alt=""
                        loading="lazy" />
                </a>
                <h5>Absensi Super Admin</h5>
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center fa-2xl" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user text-light profile"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="">My
                                    profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" onclick="logout()">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main style="margin-top: 58px;">
        <div class="container pt-4"></div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
</body>

</html>