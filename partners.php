<?php

include ("connection/conn.php");

$title = 'Home';
$nav_color = 'navbar-light';
$btn_outline_light = 'dark';

include ('inc/head.php');

?>
    <!-- listing -->
    <section class="py-15 py-xl-20">
        <div class="container mt-5 mt-xl-10">
            <div class="row justify-content-center mb-5 mb-xl-10">
                <div class="col-lg-8 text-center">
                    <!--<h1 class="fw-light mb-3"><span class="fw-bold">1 partner</span> for now.</h1>-->
                    <h1 class="fw-light mb-3"><span class="fw-bold">partners</span></h1>
                    <button class="btn btn-filter rounded-pill current" data-filter="*" data-target="#grid1">all</button>
                    <button class="btn btn-filter rounded-pill" data-filter=".filter-media" data-target="#grid1">media partners</button>
                    <button class="btn btn-filter rounded-pill" data-filter=".filter-ecosystem" data-target="#grid1">ecosytem partners</button>
                </div>
            </div>

            <div class="row g-1" id="grid1" data-isotope>
                <div class="col-12 filter-media">
                    <a href="https://events.coinpedia.org/africa-blockchain-summit-2435/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/coinpedia.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">CoinPedia</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Coinpedia Blockchain</li>
                                        <li class="list-inline-item">Fintech News Media</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
		        <div class="col-12 filter-ecosystem">
                    <a href="https://satoshicentre.tech/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/satoshi-center-logo.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Satoshi Center</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Fintech</li>
                                        <li class="list-inline-item">Blockchain Hub & Co-Working Spaces</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-media">
                    <a href="https://bravenewcoin.com/events/africa-blockchain-summit-2023" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/bave_newcoin_digital_currency_insights.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Brave Newcoin</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Digital Currency Insights</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-ecosystem">
                    <a href="https://fintechgh.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/ghana_fintech_and_payments_association.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Ghana Fintech</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">And Payment Association</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
		        <div class="col-12 filter-media">
                    <a href="https://ethereum.org/en/community/events/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <svg viewBox="0 0 115 182" height="100" focusable="false" class="chakra-icon css-1io60e2"><path d="M57.5054 181V135.84L1.64064 103.171L57.5054 181Z" fill="#F0CDC2" stroke="#1616B4" stroke-linejoin="round"></path><path d="M57.6906 181V135.84L113.555 103.171L57.6906 181Z" fill="#C9B3F5" stroke="#1616B4" stroke-linejoin="round"></path><path d="M57.5055 124.615V66.9786L1 92.2811L57.5055 124.615Z" fill="#88AAF1" stroke="#1616B4" stroke-linejoin="round"></path><path d="M57.6903 124.615V66.9786L114.196 92.2811L57.6903 124.615Z" fill="#C9B3F5" stroke="#1616B4" stroke-linejoin="round"></path><path d="M1.00006 92.2811L57.5054 1V66.9786L1.00006 92.2811Z" fill="#F0CDC2" stroke="#1616B4" stroke-linejoin="round"></path><path d="M114.196 92.2811L57.6906 1V66.9786L114.196 92.2811Z" fill="#B8FAF6" stroke="#1616B4" stroke-linejoin="round"></path></svg>
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Ethereum</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <!-- <li class="list-inline-item">And Payment Association</li> -->
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-media">
                    <a href="https://icoholder.com/en/events/africa-blockchain-summit-2023-27858" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/icoholder.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">ICO Holder</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">News</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-ecosystem">
                    <a href="https://www.fedi.xyz/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/fedi.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Fedi</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Community money, chat, and more</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-media">
                    <a href="https://www.cryptonewsz.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/CryptoNewSZ.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Cryptonewz</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Smart tracker</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-media">
                    <a href="https://klarda.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/klarda.png" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Klarda</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Investing</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-media">
                    <a href="https://allconfsbot.website/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/allconfsbot.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Allconfsbot</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">With its user-friendly interface and wide range of features, Allconfs Bot is the perfect tool for anyone looking to stay up-to-date with events happening around the world.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 filter-media">
                    <a href="https://www.cryptopolitan.com/" target="_blank" class="card bg-white card-hover-border">
                        <div class="card-body">
                            <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                <div class="col-md-2 col-lg-3">
                                    <img src="<?= PROOT; ?>assets/media/partners/cryptopolitan.jpg" alt="Logo" class="logo">
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-lg mb-0">Cryptopolitan</p>
                                    <ul class="list-inline list-inline-separated text-muted">
                                        <li class="list-inline-item">Discover our daily newsletter, empowering investors with market insights.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-lg-end">
                                    <span>Visit media</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

<?php include ('inc/foot.php'); ?>