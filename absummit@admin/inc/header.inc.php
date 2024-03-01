<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  
    <link rel="shortcut icon" href="<?= PROOT; ?>assets/media/logo/logo-sm.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bfc.css" />
    <title>Admin . Africa Blockchain Summit</title>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bd-navbar sticky-top bg-secondary">
        <nav class="container-xxl bd-gutter flex-wrap flex-lg-nowrap" aria-label="Main navigation">
            <div class="d-lg-none" style="width: 1.5rem;"></div>
            <a class="navbar-brand p-0 me-0 me-lg-2" href="/" aria-label="Bootstrap">
                <img src="<?= PROOT; ?>assets/media/logo/logo-sm.png" style="width: 20px; height: 40px;" alt="ABS Logo">
            </a>
            <div class="d-flex">
                <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-label="Toggle navigation">
                    <svg class="bi" aria-hidden="true"><use xlink:href="#three-dots"></use></svg>
                </button>
            </div>

            <div class="offcanvas-lg offcanvas-end flex-grow-1" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel" data-bs-scroll="true">
                <div class="offcanvas-header px-4 pb-0">
                    <h5 class="offcanvas-title text-white" id="bdNavbarOffcanvasLabel">ABS </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body p-4 pt-0 p-lg-0">
                    <hr class="d-lg-none text-white-50">
                    <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="index">Dashboard</a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="tickets">Tickets</a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="speakers">Speakers</a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="schedule">Schedule</a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="attendees">Attendees</a>
                        </li>
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="subscribers">Suscribers</a>
                        </li>
                    </ul>
                    <hr class="d-lg-none text-white-50">
                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                        <li class="nav-item col-6 col-lg-auto">
                            <a class="nav-link py-2 px-0 px-lg-2" href="purchases">Purchases</a>
                        </li>
                        <li class="nav-item py-1 col-12 col-lg-auto">
                            <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                            <hr class="d-lg-none text-white-50">
                        </li>
                        <li class="nav-item dropdown">
                            <button type="button" class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                                <span class="d-lg-none" aria-hidden="true">Bootstrap</span><span class="visually-hidden">Bootstrap&nbsp;</span> <span class="visually-hidden">(switch to other versions)</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Account</h6></li>
                                <li><a class="dropdown-item" href="profile">Me</a></li>
                                <li><a class="dropdown-item" href="settings">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>