<?php

include ("connection/conn.php");

$title = 'Home';
$nav_color = 'navbar-light';
$btn_outline_light = 'light';

include ('inc/head.php');

?>
    <!-- listing -->
    <section class="py-15 py-xl-20">
        <div class="container mt-5 mt-xl-10">
            <div class="row justify-content-center mb-5 mb-xl-10">
                <div class="col-lg-8 text-center">
                    <!--<h1 class="fw-light mb-3"><span class="fw-bold">1 sponsor</span> for now.</h1>-->
                    <h1 class="fw-light mb-3"><span class="fw-bold">sponsors</span>.</h1>
                    <button class="btn btn-filter rounded-pill current" data-filter="*" data-target="#grid1">all</button>
                    <button class="btn btn-filter rounded-pill" data-filter=".filter-lead" data-target="#grid1">lead</button>
                    <button class="btn btn-filter rounded-pill" data-filter=".filter-diamon" data-target="#grid1">diamond</button>
                    <button class="btn btn-filter rounded-pill" data-filter=".filter-golden" data-target="#grid1">golden</button>
                    <button class="btn btn-filter rounded-pill" data-filter=".filter-silver" data-target="#grid1">silver</button>
                </div>
            </div>

            <div class="row g-1" id="grid1" data-isotope>
                <div class="col-12 filter-lead">
                    <a href="https://noones.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/noones.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Noones</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">A world-leading peer-to-peer Bitcoin marketplace where everyone is welcome.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-silver">
                    <a href="https://inqoins.io" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/inqoins.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Inqoins</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Buy</li>
                                        <li class="list-inline-item">Sell and trade on the go. Anywhere, anytime.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-silver">
                    <a href="https://www.fedi.xyz/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/fedi.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Fedi</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Community money, chat, and more</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-silver">
                    <a href="https://bitafrika.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/bitafrika.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">BitAfrika</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">The easiest way to buy and sell bitcoin, bitcoincash, litecoin, ethereum, tron, usdt and many more africa</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!--<div class="col-12 filter-silver">-->
                <!--    <a href="https://www.fluus.com/" target="_blank" class="card bg-white card-hover-border">-->
                <!--        <div class="card-body">-->
                <!--            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">-->
                <!--                <div class="col-md-2 col-lg-3">-->
                <!--                    <img src="<?= PROOT; ?>assets/media/sponsors/fluus.jpg" alt="Logo" class="logo">-->
                <!--                </div>-->
                <!--                <div class="col-md-6">-->
                <!--                    <p class="fs-lg mb-0">Fluus</p>-->
                <!--                    <ul class="list-inline list-inline-separated text-muted">-->
                <!--                        <li class="list-inline-item">Buy, Sell, or Swap Cryptocurrencies & Tokens</li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--                <div class="col-md-3 text-lg-end">-->
                <!--                    <span>Visit partner</span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </a>-->
                <!--</div>-->
                <div class="col-12 filter-silver">
                    <a href="https://www.ottochain.io/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/ottochain.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Ottochain</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">First consumer chain launched by Octopus Network that adopts Octopus 2.0 Interchain Security.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-silver">
                    <a href="https://www.betcoin.ag/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/betcoin.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Betcoin</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">The Leading Cryptocurrency Gaming Platform.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-silver">
                    <a href="https://bithub.africa/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/bithub.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Bithub Africa</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">With Africa's fast-growing population, technologies like blockchain, IoT, machine learning, and AI can revolutionize access to energy.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-silver">
                    <a href="https://scrt.network/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/secret.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Secret Network</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">More Privacy</li>
                                         <li class="list-inline-item">Limitless Possibilities.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><div class="col-12 filter-silver">
                    <a href="https://blockchaingaming.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/sponsors/blockchaingaming.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Blockchain Gaming</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">leArn,plAy,eArn!</li>
                                         <li class="list-inline-item">Your blockchain gaming journey begins here!</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit sponsor</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

<?php include ('inc/foot.php'); ?>