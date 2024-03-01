<?php

require_once ('connection/conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="Hackathon - Africa Blockchain Summit">
    <meta name="description" content="Empowering innovation through blockchain technology">
    <meta name="keywords" content="icp, hackathon, internet, competition, bcfa, bfa, internet computer protocol, bitfree, cryptocurrency, crypto, bitcoin freedom, bitcoin, africa, freedom, conference, summit, bitcoin, paxful, blockchainfoundationafrica, inqoins, bwb, noones">
    <meta name="author" content="Blochain Foundation Africa" />
    <meta name="copyright" content="Blockhain Foundation Africa" />
    <meta name="robots" content="index, follow">
    <meta name="title" content="Hackathon - Africa Blockchain Summit 2023">
    <meta name="language" content="English">
    <link rel="canonical" href="https://blockchainsummit.africa/hackathon" />

    <meta property="og:type" content="article" />
    <meta property="og:title" content="Hackathon - Africa Blockchain Summit 2023" />
    <meta property="og:description" content="Empowering innovation through blockchain technology" />
    <meta property="og:image" content="/assets/media/hackathon-flyer.png" />
    <meta property="og:url" content="https://blockchainsummit.africa/" />
    <meta property="og:site_name" content="Hackathon - Africa Blockchain Summit 2023" />
  
    <link rel="shortcut icon" href="<?= PROOT; ?>assets/media/logo/logo-sm.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/libs.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/index.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bsa.css" />
    <title>Hackathon ~ Africa Blockchain Summit</title>
</head>
<body>

<style>
    *, body {
        font-family: monospace !important;
    }

    #mainNav {
        display: none !important;
    }

    .background[class*="-overlay"]::after {
        opacity: 0.8 !important;
        background: #000905 !important;
    }
</style>
  
    <!-- header -->
    <section class="bg-black overflow-hidden" data-aos="fade-in">
        <div class="d-flex flex-column py-15 min-vh-100 container foreground">
            <div class="row justify-content-center my-auto pb-5">
                <div class="col-lg-6 mb-5 mt-10">
                    <h1 class="display-2 fw-bolder text-warning">Africa <br>Blockchain <br>Summit</h1>
                    <h1 class="display-2 fw-bolder text-white">HACKATHON <br>11 - 18 /12/2023.</h1>
                    <p class="text-warning fw-bolder">Are you an innovator or entrepreneur with a passion for blockchain technology? Do you have a brilliant idea for a blockchain application or project that could change the world? Then join us for the Africa Blockchain Summit Hackathon!
                    <br>
                    To register for the 2023 ABS Hackathon, go on this link: <a href="<?= PROOT; ?>register-hackathon" class="text-info">ABS Hackathon Application Form</a>.</p>
                </div>
            </div>
            <div class="row justify-content-center inverted">
                <div class="col-lg-8 text-center">
                    <span class="text-muted">Powered by Internet Computer Protocol</span>
                    <div class="text-center">
                        <img src="assets/media/logo/icp.png" style="width: 200px; height: 200px;" alt="ICP Logo" class="logo">
                    </div>
                </div>
            </div>
        </div>
        <figure class="background background-overlay" style="background-image: url('<?= PROOT; ?>assets/media/bg/2.png')"
              data-top-top="transform: translateY(0%);" data-top-bottom="transform: translateY(10%);"></figure>
    </section>


    <!-- features -->
    <section class="py-15 py-xl-20">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <div class="row g-3 g-xl-5" data-masonry>
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="card equal-xl-1-1 bg-primary inverted">
                                <div class="card-wrap">
                                    <div class="card-header pb-0">
                                        <i class="bi bi-clock-fill fs-3"></i>
                                    </div>
                                    <div class="card-footer mt-auto">
                                        <h3 class="fs-4">11-18 Dec</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-xl-20" data-aos="fade-up">
                            <div class="card equal-xl-1-1 inverted">
                                <div class="card-wrap">
                                    <div class="card-header pb-0">
                                        <i class="bi bi-compass-fill fs-3"></i>
                                    </div>
                                    <div class="card-footer mt-auto">
                                        <h3 class="fs-4">Online, Google Meet</h3>
                                    </div>
                                </div>
                                <figure class="background background-overlay"
                                      style="background-image: url('<?= PROOT; ?>assets/media/logo/google-meet.png')" data-top-top="transform: translateY(0%);"
                                      data-top-bottom="transform: translateY(20%);"></figure>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="card equal-xl-1-1 bg-light">
                                <div class="card-wrap">
                                    <div class="card-header pb-0">
                                        <img src="<?= PROOT; ?>assets/media/logo/icp.svg" width="200" alt="">
                                    </div>
                                    <div class="card-footer mt-auto">
                                        <h3 class="fs-4">Powered by ICP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-xl-5 mb-5 mb-xl-0">
                    <h2>ABS - ICP hackathon</h2>
                    <p class="text-secondary lead">The Internet Computer is a third-gen blockchain that serves as a crypto cloud, replacing traditional IT. It allows building any Web3 service or enterprise system fully on blockchain, eliminating the need for centralized cloud computing like Amazon Web Services.</p>
                    <a href="<?= PROOT; ?>register-hackathon" class="action underline">Application Form <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- image frame -->
    <section class="py-15 py-xl-20">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="frame">
                        <img src="<?= PROOT; ?>assets/media/hero.jpg" class="img-fluid" alt="Hero">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <h2 class="fw-bold">Africa Blockchain Summit Hackathon!</h2>
                    <p class="text-secondary">During this exciting event, you will have the opportunity to network with like-minded individuals, form teams, and work together to develop groundbreaking blockchain solutions. Whether you’re a seasoned blockchain developer or just getting started in the industry, there’s a place for you here.</p>
                    <a href="<?= PROOT; ?>register-hackathon">ABS Hackathon Application Form</a>.
                </div>
            </div>
         </div>
    </section>

    <section class="bg-black mx-xl-3">
        <div class="container py-15 pb-10 py-xl-20 level-3">
            <div class="row">
                <div class="col-lg-6 inverted">
                    <h2 class="fw-bold">Registration.</h2>
                    <ul class="list-group list-group-minimal">
                        <li class="list-group-item d-flex align-items-center">
                            <div class="icon-box icon-box-sm bg-opaque-white rounded-circle me-2"><i class="bi bi-check2 text-white"></i>
                            </div>
                            Registration Deadline:&nbsp;8 December 2023
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="icon-box icon-box-sm bg-opaque-white rounded-circle me-2"><i
                                class="bi bi-check2 text-white"></i>
                            </div>
                            How to Register:&nbsp;<a href="<?= PROOT; ?>register-hackathon">https://blockchainsummit.africa/register-hackathon"</a>.
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="icon-box icon-box-sm bg-opaque-white rounded-circle me-2"><i
                                class="bi bi-check2 text-white"></i>
                            </div>
                            Requirements:&nbsp;A group or an individual with blockchain skills are required for particaipation
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="icon-box icon-box-sm bg-opaque-white rounded-circle me-2"><i
                                class="bi bi-check2 text-white"></i>
                            </div>
                            Fees:&nbsp;No fee payment for registration 
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid back back-static">
            <div class="row justify-content-end h-100">
                <div class="col-lg-6 overflow-hidden position-relative">
                    <figure class="background background-parallax"
                        style="background-image: url('<?= PROOT; ?>assets/media/bg/4.jpg')"
                        data-bottom-top="transform: translateY(0%);" data-top-bottom="transform: translateY(20%);">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 py-xl-15">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <p class="lead text-secondary">
                       Not only do you stand a chance to win amazing prizes, but you also get the satisfaction of knowing that your solution can bring value to society.
                   </p>
                    <p class="fs-lg text-secondary">
                        The Africa Blockchain Summit Hackathon will take place over several days, during which you will work on your project, attend workshops and talks from industry experts, and present your final product to a panel of judges for a chance to win cash prizes and other rewards.
                    </p>
                    <p class="fs-lg text-secondary">
                        Not only will you have the chance to showcase your skills and creativity, but you will also be contributing to the development of the blockchain industry in Africa. With its potential to revolutionize industries ranging from finance to healthcare to agriculture, blockchain technology has the power to transform the African continent and improve the lives of millions.
                    </p>
                    <p class="fs-lg text-secondary">
                        So join us for this exciting event, meet other blockchain enthusiasts, and take your skills to the next level. We can’t wait to see what you’ll come up with!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-15 py-xl-20 bg-light border-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <div class="col-md-10 col-lg-6 mb-5 mb-lg-0">
                    <h2 class="lh-sm mb-5">Africa blockchain summit hackathon</h2>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <ul class="list-group list-group-minimal">
                                <li class="list-group-item d-flex align-items-center mb-1">
                                    <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                        <i class="bi bi-check2 text-green"></i>
                                    </div>
                                    Empowering innovation through blockchain technology
                                </li>
                                <li class="list-group-item d-flex align-items-center mb-1">
                                    <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                        <i class="bi bi-check2 text-green"></i>
                                    </div>
                                    Rethink Africa’s Future with Blockchain
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                        <i class="bi bi-check2 text-green"></i>
                                    </div>
                                    Unlocking Innovation in Africa with Blockchain 
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-minimal">
                                <li class="list-group-item d-flex align-items-center mb-1">
                                    <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                        <i class="bi bi-check2 text-green"></i>
                                    </div>
                                    Advancing Africa’s Digital Future through Blockchain: Hackathon
                                </li>
                                <li class="list-group-item d-flex align-items-center mb-1">
                                    <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                        <i class="bi bi-check2 text-green"></i>
                                    </div>
                                    The Power of Collaboration: Africa Blockchain Hackathon
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                        <i class="bi bi-check2 text-green"></i>
                                    </div>
                                    Creating Sustainable Solutions for Africa with Blockchain 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-5 position-relative" data-aos='fade-up'>
                    <div class="equal-1-1 rounded-circle">
                        <figure class="background" style="background-image: url('<?= PROOT; ?>assets/media/hero-2.jpg')"></figure>
                    </div>
                    <img class="position-absolute bottom-0 start-0 rotate" src="<?= PROOT; ?>assets/media/svg/featured.svg" alt="img">
                </div>
            </div>
        </div>
    </section>



<?php include ('inc/foot.php'); ?>