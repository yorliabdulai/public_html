<?php
    require_once ('connection/conn.php');

    $title = 'Press';
    $nav_color = 'navbar-light';
    $btn_outline_light = 'light';
    include ('inc/head.php');

?>
    
    <section class="py-15 py-xl-20 pb-xl-15">
        <div class="container mt-10">
            <h1>News</h1>
        </div>
    </section>

    <!-- news -->
    <section class="py-15 py-xl-20 bg-black inverted">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <h2 class="fs-5 fw-normal">News Attention</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="javascript:;" class="eyebrow action underline">news <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr class="mt-3 mb-10">
                </div>
            </div>
            <div class="row g-4 g-xl-6 align-items-start justify-content-between">
                <div class="col-lg-5">
                    <article class="card">
                        <a href="<?= PROOT; ?>press" class="card-title">
                            <h3 class="fs-3">find all the press materials and releases for the Africa Blockchain Summit.</h3>
                        </a>
                        <time datetime="2020-12-20 21:30" class="eyebrow text-muted">Africa Blockchain Summit, 2023</time>
                    </article>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 g-xl-6" data-masonry>
                        <div class="col-md-6">
                            <article class="card">
                                <a href="https://events.coinpedia.org/africa-blockchain-summit-2435/" class="card-title">
                                    <h6>https://events.coinpedia.org/africa-blockchain-summit-2435/</h6>
                                </a>
                                <time datetime="ABS" class="eyebrow text-muted">Africa Blockchain Summit, 2023</time>
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="card">
                                <a href="https://bravenewcoin.com/events/africa-blockchain-summit-2023" class="card-title">
                                    <h6>https://bravenewcoin.com/events/africa-blockchain-summit-2023</h6>
                                </a>
                                <time datetime="ABS, 2023" class="eyebrow text-muted">ABS, 2023</time>
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="card">
                                <a href="https://allevents.in/accra/africa-blockchain-summit/200024896162748" class="card-title">
                                    <h6>https://allevents.in/accra/africa-blockchain-summit/200024896162748</h6>
                                </a>
                                <time datetime="ABS, 2023" class="eyebrow text-muted">Africa Blockchain Summit, 2023</time>
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="card">
                                <a href="https://binance.com/hu/feed/post/1049700" class="card-title">
                                    <h6>https://binance.com/hu/feed/post/1049700</h6>
                                </a>
                                <time datetime="ABS, 2023" class="eyebrow text-muted">Africa Blockchain Summit</time>
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="card">
                                <a href="https://bitcoinethereumnews.com/blockchain/insights-about-the-upcoming-africa-blockchain-summit-2023" class="card-title">
                                    <h6>https://bitcoinethereumnews.com/blockchain/insights-about-the-upcoming-africa-blockchain-summit-2023</h6>
                                </a>
                                <time datetime="ABS, 2023" class="eyebrow text-muted">Africa Blockchain Summit, 2023</time>
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="card">
                                <a href="https://stayhappening.com/e/africa-blockchain-summit-E2ISVQ6FKLD" class="card-title">
                                    <h6>https://stayhappening.com/e/africa-blockchain-summit-E2ISVQ6FKLD</h6>
                                </a>
                                <time datetime="ABS, 2023" class="eyebrow text-muted">Africa Blockchain Summit, 2023</time>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include ('inc/foot.php'); ?>