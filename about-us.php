<?php
require_once ('connection/conn.php');

$title = 'About Us';
$nav_color = 'navbar-light';
$btn_outline_light = 'light';
include ('inc/head.php');


?>
  

    <div class="offcanvas-wrap">
        <!-- hero -->
        <section class="overflow-hidden py-15 py-xl-20">
            <div class="container">
                <div class="row align-items-end mb-10 mt-5">
                    <div class="col-lg-8">
                        <h1 class="text-color">Experience and Passion Together.</h1>
                    </div>
                    <!-- <div class="col-lg-4 text-lg-end">
                        <p class="fs-lg text-muted mb-1">Completed <span class="text-black">250k+</span> <span class="d-block">conferences Africawide</span></p>
                    </div> -->
                </div>
            </div>
        </section>

        <!-- numbers -->
        <section class="pb-15 pb-xl-20">
            <div class="container">
                <div class="row mb-10">
                    <div class="col-lg-10">
                        <span class="eyebrow text-normal-color mb-4">About Us</span>
                        <h3 class="fs-4">
                            <b>Africa Blockchain Summit</b> provides an opportunity for stakeholders in the blockchain industry to connect, network, and share ideas on how blockchain technology can address some of Africa's challenges. The summit covers topics such as blockchain applications in finance, supply chain management, real estates, healthcare, energy, and education.
                        <br><br><br>
                            The <u>Blockchain Foundation Africa</u> is a non-profit organization based in Ghana that aims to promote blockchain technology and its adoption in Africa. The organization hosts various events, including the Coinfest Ghana, organisers of the <a href="https://cointelegraph.com/news/bitcoin-education-comes-to-ghana">first Bitcoin Summit</a> in Africa, and the Africa Blockchain Summit, which brings together experts, policymakers, and blockchain enthusiasts to discuss the benefits and challenges of blockchain technology in Africa.
                        </h3>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col">
                        <span class="d-block display-3 fw-bold text-color">+80%</span>
                        <span class="lead text-secondary">working hours</span>
                    </div>
                    <div class="col">
                        <span class="d-block display-3 fw-bold text-color">84</span>
                        <span class="lead text-secondary">working hours</span>
                    </div>
                    <div class="col">
                        <span class="d-block display-3 fw-bold text-color">84</span>
                        <span class="lead text-secondary">working hours</span>
                    </div>
                    <div class="col">
                        <span class="d-block display-3 fw-bold text-color">84</span>
                        <span class="lead text-secondary">working hours</span>
                    </div>
                </div> -->
            </div>
        </section>


        <!-- team -->
        <section class="py-15 py-xl-20 bg-light overflow-hidden border-bottom">
            <div class="container">
                <div class="row mb-10">
                    <div class="col-lg-8">
                        <h2>Our Team</h2>
                    </div>
                </div>
                <div class="row g-3 g-xl-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="equal-1-1 mb-2">
                            <figure class="background" style="background-image: url('./assets/media/team/team-2.jpg'); background-position: unset;"></figure>
                        </div>
                        <h4 class="fs-5 mb-0">Alakanani Itireleng</h4>
                        <span class="text-secondary">Founder . Satoshi Centre</span>
                        <br>
                        <span class="text-secondary">
                            <a href="https://twitter.com/bitcoinlady" target="_blank" class="text-info"><i class="bi bi-twitter fs-5"></i></a>&nbsp;
                            <a href="https://www.facebook.com/motherPkay" target="_blank" class="text-primary"><i class="bi bi-facebook fs-5"></i></a>&nbsp;
                            <a href="https://bw.linkedin.com/in/bitcoinlady" target="_blank" class="text-info"><i class="bi bi-linkedin fs-5"></i></a>&nbsp;
                            <a href="mailto:alakanani@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>
                        </span>
                    </div>
                    <!--<div class="col-md-6 col-lg-4">-->
                    <!--    <div class="equal-1-1 equal-3-4 mb-2">-->
                    <!--        <figure class="background" style="background-image: url('./assets/media/team/team-1.jpg'); background-position: unset;"></figure>-->
                    <!--    </div>-->
                    <!--    <h4 class="fs-5 mb-0">Frank Deya</h4>-->
                    <!--    <span class="text-secondary">CEO . Satoshi Centre</span>-->
                    <!--    <br>-->
                    <!--    <span class="text-secondary">-->
                    <!--        <a href="https://twitter.com/FrankDeya" target="_blank" class="text-info"><i class="bi bi-twitter fs-5"></i></a>&nbsp;-->
                    <!--        <a href="https://www.linkedin.com/in/frank-deya-088a2357" target="_blank" class="text-info"><i class="bi bi-linkedin fs-5"></i></a>&nbsp;-->
                    <!--        <a href="mailto:frank@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>-->
                    <!--        </span>-->
                    <!--</div>-->
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="equal-1-1 mb-2">
                                <figure class="background" style="background-image: url('./assets/media/team/team-4.jpg'); background-position: unset;"></figure>
                            </div>
                            <h4 class="card-title">Philip Agyei Asare</h4>
                            <span class="text-secondary">Founder . Blockchain Foundation Africa</span>
                            <br>
                            <span class="text-secondary">
                                <a href="https://twitter.com/btc4revolution" target="_blank" class="text-info"><i class="bi bi-twitter fs-5"></i></a>&nbsp;
                                <a href="mailto:philip@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>&nbsp;
                                <a href="https://web.facebook.com/pagyeiasare" target="_blank" class="text-primary"><i class="bi bi-facebook fs-5"></i></a>&nbsp;
                                <a href="https://www.linkedin.com/in/philipagyeiasare/" target="_blank" class="text-info"><i class="bi bi-linkedin fs-5"></i></a>&nbsp;
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="equal-1-1 equal-3-4 mb-2">
                            <figure class="background" style="background-image: url('./assets/media/team/team-6.jpg');"></figure>
                        </div>
                        <h4 class="fs-5 mb-0">Akwasi Gyebi</h4>
                        <span class="text-secondary">Senior Manager . Blockchain Foundation Africa</span>
                        <br>
                        <span class="text-secondary">
                            <a href="https://twitter.com/cwesygyebi" target="_blank" class="text-info"><i class="bi bi-twitter fs-5"></i></a>&nbsp;
                            <a href="mailto:gyebi@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>
                        </span>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="equal-1-1 mb-2">
                            <figure class="background" style="background-image: url('./assets/media/team/team-3.jpg'); background-position: unset;"></figure>
                        </div>
                        <h4 class="fs-5 mb-0">Tuelo Baikgatlhi</h4>
                        <span class="text-secondary">Founder . Aiderapp.app</span>
                        <br>
                        <span class="text-secondary">
                            <a href="https://twitter.com/TBaikgatlhi" target="_blank" class="text-info"><i class="bi bi-twitter fs-5"></i></a>&nbsp;
                            <a href="https://www.facebook.com/tuelo.mogorosi" target="_blank" class="text-primary"><i class="bi bi-facebook fs-5"></i></a>&nbsp;
                            <a href="mailto:tuelo@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>
                            </span>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="equal-1-1 equal-3-4 mb-2">
                            <figure class="background" style="background-image: url('./assets/media/team/team-7.jpg');"></figure>
                        </div>
                        <h4 class="fs-5 mb-0">Nana Kwaku Osei Bonsu</h4>
                        <span class="text-secondary">Operations Manager . BFA</span>
                        <br>
                        <span class="text-secondary">
                            <a href="https://facebook.com/nanaosei.bonsu.52" target="_blank" class="text-primary"><i class="bi bi-facebook fs-5"></i></a>&nbsp;
                            <a href="mailto:bonsu@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>
                        </span>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="equal-1-1 equal-3-4 mb-2">
                            <figure class="background" style="background-image: url('./assets/media/team/team-5.png');"></figure>
                        </div>
                        <h4 class="fs-5 mb-0">Moro Tijani</h4>
                        <span class="text-secondary">Developer . BFA/Inqoins</span>
                        <br>
                        <span class="text-secondary">
                            <a href="https://twitter.com/MoroTijani2" target="_blank" class="text-info"><i class="bi bi-twitter fs-5"></i></a>&nbsp;
                            <a href="mailto:tijani@blockchainsummit.africa" class="text-secondary"><i class="bi bi-envelope-fill fs-5"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </section>

<?php include ('inc/foot.php'); ?>