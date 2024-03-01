<?php

include ("connection/conn.php");

    $title = 'Home';
    $nav_color = 'navbar-dark';
    $btn_outline_light = 'white';

    include ('inc/head.php');

    // TICKETS
    $ticketQuery = "
        SELECT * FROM bfc_ticket
        ORDER BY bfc_ticket.ticket_price ASC";
    $statement = $conn->prepare($ticketQuery);
    $statement->execute();
    $count_ticket = $statement->rowCount();
    $ticket_result = $statement->fetchAll();

    // SPEAKERS
    $speakerQuery = "
        SELECT * FROM bsa_speaker 
        WHERE be_a_speaker = ?
        ORDER BY bsa_speaker.speaker_name ASC
        LIMIT 7
    ";
    $statement = $conn->prepare($speakerQuery);
    $statement->execute([1]);
    $count_speaker = $statement->rowCount();
    $speaker_result = $statement->fetchAll();
?>

  
    <section class="cover overflow-hidden bg-primary inverted">
        <div class="d-flex flex-column min-vh-100 py-20 container foreground">
            <div class="row justify-content-center my-auto">
                <div class="col-lg-8 col-xl-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start text-start pb-2 pt-lg-2 pb-xl-0 pt-xl-5 mt-xxl-5">
                        <span class="fs-sm"><span class="text-secondary fw-semibold">300+</span> attendees are already with us</span>
                    </div>
                    <h1 class="display-1 mb-1"><?= ucwords($head); ?></h1>
                    <div class="text-secondary fs-3">
                        <span data-typed='{"strings": ["<?= $from; ?> - <?= $to; ?> <?= $month; ?>, <?= $year; ?>", "<?= ucwords($city); ?>, <?= strtoupper($country); ?>"]}'></span>
                    </div>
                    <span class="fs-sm"><span class="text-secondary fw-semibold">Theme</span>
                    <h1 class="fw-bold"><span class="d-lg-block">Building Blockchains for Africa's Future</span>.</h1>
                </div>
            </div>
        </div>
        <figure class="background background-dimm" style="background-image: url('assets/media/peakpx.jpg')" data-top-top="transform: translateY(0%);" data-top-bottom="transform: translateY(20%);"></figure>
        <span class="scroll-down"></span>
    </section>
    
    <section class="py-15 py-xl-20 border-bottom bg-light">
        <div class="container">
            <div class="row mb-8">
                <div class="col-lg-10">
                    <h2>Sponsors</h2>
                </div>
            </div>
            <div class="row g-1 g-lg-3">
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://noones.io" target="_blank">
                            <img src="assets/media/sponsors/noones.png" alt="Logo" class="logo" style="width: 200px"> 
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://inqoins.io" target="_blank">
                            <img src="assets/media/sponsors/inqoins.png" alt="Logo" class="logo" style="width: 200px">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://www.fedi.xyz/" target="_blank">
                            <img src="assets/media/sponsors/fedi.jpg" alt="Logo" class="logo" style="width: 200px">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://bitafrika.com/" target="_blank">
                            <img src="assets/media/sponsors/bitafrika.jpg" alt="Logo" class="logo" style="width: 200px">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://www.ottochain.io/ " target="_blank">
                            <img src="assets/media/sponsors/ottochain.jpg" alt="Logo" class="logo" style="mix-blend-mode: difference;">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://www.betcoin.ag/" target="_blank">
                            <img src="assets/media/sponsors/betcoin.png" alt="Logo" class="logo" style="">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://bithub.africa/" target="_blank">
                            <img src="assets/media/sponsors/bithub.jpg" alt="Logo" class="logo" style="">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://scrt.network/" target="_blank">
                            <img src="assets/media/sponsors/secret.jpg" alt="Logo" class="logo" style="">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center border rounded-pill p-2">
                        <a href="https://blockchaingaming.com/" target="_blank">
                            <img src="assets/media/sponsors/blockchaingaming.png" alt="Logo" class="logo" style="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="py-15 py-xl-20">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-10 col-xl-5 mb-5 mb-xl-0">
                    <h2 class="text-color">Immerse yourself in two days of creative discussion.</h2>
                    <p class="text-secondary lead">We think blockchain technology offers exceptional chances for economic development and is laying the groundwork for a safer and more secure Internet.</p>
                    <a href="<?= PROOT; ?>ticket" class="action underline text-normal-color">Get Tickets <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-xl-6">
                    <div class="row g-3 g-xl-5" data-masonry>
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="card equal-xl-1-1 bg-primary inverted">
                                <div class="card-wrap">
                                    <div class="card-header pb-0">
                                        <i class="bi bi-clock-fill fs-3"></i>
                                    </div>
                                    <div class="card-footer mt-auto">
                                        <h3 class="fs-4"><?= $from . '-' . $to . ' ' . substr($month, 0, 3); ?></h3>
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
                                        <h3 class="fs-4"><?= ucwords($city) . ', ' . ucwords($country); ?></h3>
                                    </div>
                                </div>
                                <figure class="background background-overlay" style="background-image: url('assets/media/university-of-ghana.jpg')" data-top-top="transform: translateY(0%);" data-top-bottom="transform: translateY(20%);"></figure>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="card equal-xl-1-1 bg-light">
                                <div class="card-wrap">
                                    <div class="card-header pb-0">
                                        <i class="bi bi-people-fill fs-3"></i>
                                    </div>
                                    <div class="card-footer mt-auto">
                                        <!-- <h3 class="fs-4">22 Speakers</h3> -->
                                        <h3 class="fs-4">Speakers</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- features -->
    <section class="py-15 py-xl-20">
        <div class="container">
            <div class="row justify-content-center mb-6">
                <div class="col-lg-8 text-center">
                    <span class="badge bg-opaque-primary text-secondary mb-2 rounded-pill">Theme</span>
                    <h1 class="fw-bold"><span class="d-lg-block">Building Blockchains for Africa's Future</span>.</h1>
                    <div class="row mb-8">
                        <div class="col">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up">
                    <div class="row separated">
                        <div class="col-lg-7 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-warning fw-bold">INVESTORS</h5>
                            </div>
                        </div>
                        <div class="col-lg-5 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-primary fw-bold">BUILDERS</h5>
                            </div>
                        </div>
                        <div class="col-lg-5 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-info fw-bold">DEVELOPERS</h5>
                            </div>
                        </div>
                        <div class="col-lg-7 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-danger fw-bold">STUDENTS</h5>
                            </div>
                        </div>
                        <div class="col-lg-7 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-secondary fw-bold">ENTREPRENEURS</h5>
                            </div>
                        </div>
                        <div class="col-lg-5 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-dark fw-bold">EVANGELISTS</h5>
                            </div>
                        </div>
                        <div class="col-lg-7 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-primary fw-bold">BANKERS</h5>
                            </div>
                        </div>
                        <div class="col-lg-5 p-5">
                            <div class="d-flex align-items-end">
                                <h5 class="fs-1 mb-0 me-2 lh-1 text-warning fw-bold">GOVERNMENTS</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- speakers -->
    <section class="py-0">
        <div class="container-full">
            <div class="row g-0">
                <div class="col-sm-6 col-md-6 col-lg-8 col-xl-3">
                    <div class="card h-100 bg-primary inverted">
                        <div class="card-wrap">
                            <div class="card-footer mt-auto">
                                <h2 class="text-color">Speakers</h2>
                                <a href="<?= PROOT; ?>speaker"><small class="text-muted">View all speakers</small></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($count_speaker > 0): ?>
                    <?php foreach ($speaker_result as $speaker): ?>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <a href="<?= $speaker["speaker_twitter"]; ?>" title="" target="_blank" class="card card-hover-gradient inverted equal-1-1">
                                <div class="card-wrap">
                                    <div class="card-footer text-shadow mt-auto">
                                        <h5 class="mb-0"><?= ucwords($speaker['speaker_name']); ?></h5>
                                        <span class="text-muted"><?= ucwords($speaker['speaker_company']); ?> / <span class="text-muted"><?= ucwords($speaker['speaker_role']); ?></span>
                                    </div>
                                </div>
                                <figure class="background" style="background-image: url('<?= PROOT . $speaker["speaker_img"]; ?>')">
                                </figure>
                            </a>
                        </div>
                    <?php endforeach; ?>
                        <div class="col-lg-12 text-center mt-5">
                            <a href="<?= PROOT; ?>speaker"><small class="text-muted">View all speakers</small></a>
                        </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <!-- cta -->
    <section class="py-15 py-xl-20">
        <div class="container">
            <div class="row g-4 g-xl-6">
                <div class="col-lg-6" data-aos="fade-up">
                    <a href="be-a-speaker" class="card h-100 border card-arrow">
                        <div class="card-body">
                            <h4 class="card-title fw-light fs-4"><span class="fw-bold">Let's connect.</span> Be a speaker.</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="mailto:sponsor@blockchainsummit.africa?subject=BE OUR SPONSOR!" class="card card-arrow bg-primary inverted overflow-hidden">
                        <div class="card-body">
                            <h4 class="card-title fw-light fs-4">We'd love to <span class="fw-bold">get in touch</span> with you as a sponsor.</h4>
                        </div>
                        <img class="position-absolute top-50 start-50 translate-middle level-3" src="./assets/media/svg/dialog.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    
        <!-- price -->
    <?php if ($count_ticket > 100): ?>
    <section class="py-20 mx-0 mx-lg-3">
        <div class="container">
            <div class="row justify-content-center mb-6">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-1">Tickets selling fast</h2>
                    <p class="lead text-secondary">You are given entry to the exclusive event by purchasing a ticket.</p>
                </div>
            </div>
            <div class="row g-4 align-items-end g-0 separated" data-aos="fade-up" data-aos-delay="100">
                <?php foreach ($ticket_result as $ticket_row): ?>
                    <div class="col-md-4 bg-white">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h1 mb-10 fw-bold text-normal-color"><?= money_symbol('$', $ticket_row['ticket_price']); ?></h2>
                                <ul class="list-unstyled mb-4">
                                    <li class="py-1 lead"><?= ucwords($ticket_row['ticket_title']); ?></li>
                                    <li class="py-1"><?= nl2br($ticket_row['ticket_list']); ?></li>
                                </ul>
                                <div class="d-grid"> 
                                    <!-- <a href="<?= PROOT; ?>ticket/<?= $ticket_row['id']; ?>" class="btn btn-outline-warning btn-with-icon rounded-pill mb-1">Buy with FIAT <i class="bi bi-arrow-right"></i></a> -->
                                    <a href="<?= $ticket_row['ticket_link']; ?>" class="btn btn-primary btn-with-icon rounded-pill">Buy with CRYPTO <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- organizers -->
    <section class="bg-primary mx-xl-3 py-15 py-xl-20 inverted overflow-hidden">
        <div class="container level-1">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mb-5">Organizers</h2>
                    <div class="row">
                        <div class="col-sm">
                            <a href="https://blockchainfoundationafrica.com">
                                <img src="assets/media/organizers/bcfa-long-logo.jpg" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="col-sm">
                            <a href="https://satoshicentre.tech">
                                <img src="assets/media/organizers/satoshi-center-logo.png" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="grouped-inputs p-1 border rounded-pill mb-2">
                        <div class="row g-1">
                            <div class="col-lg-9">
                                <input type="email" name="subscribe" id="subscribe" class="form-control px-4 rounded-pill" aria-label="Text input with dropdown button" placeholder="Your email address">
                            </div>
                            <div class="col-lg-3 d-grid">
                                <button type="button" onclick="subscribe_products(); return false;"  class="btn btn-white rounded-pill">Subscribe</button>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">We'll never share your email with anyone else.</small>
                </div>
            </div>
        </div>
        <figure class="background background-dimm background-parallax" style="background-image: url('./assets/media/bg-11.jpg')" data-bottom-top="transform: translateY(0%);" data-top-bottom="transform: translateY(20%);"></figure>
    </section>
    
    <!-- media partners list -->
    <section class="py-10">
        <div class="container">
            <div class="carousel carousel-align text-center">
                <div data-carousel='{"gutter": 48, "loop": false, "nav": false, "controls": false, "responsive": {"0": {"items": 2}, "768": {"items": 4}, "1200": {"items": 5}}}'>
                    <div>
                        <a href="https://ethereum.org/en/community/events/">
                            <svg viewBox="0 0 115 182" height="80" focusable="false" class="chakra-icon css-1io60e2"><path d="M57.5054 181V135.84L1.64064 103.171L57.5054 181Z" fill="#F0CDC2" stroke="#1616B4" stroke-linejoin="round"></path><path d="M57.6906 181V135.84L113.555 103.171L57.6906 181Z" fill="#C9B3F5" stroke="#1616B4" stroke-linejoin="round"></path><path d="M57.5055 124.615V66.9786L1 92.2811L57.5055 124.615Z" fill="#88AAF1" stroke="#1616B4" stroke-linejoin="round"></path><path d="M57.6903 124.615V66.9786L114.196 92.2811L57.6903 124.615Z" fill="#C9B3F5" stroke="#1616B4" stroke-linejoin="round"></path><path d="M1.00006 92.2811L57.5054 1V66.9786L1.00006 92.2811Z" fill="#F0CDC2" stroke="#1616B4" stroke-linejoin="round"></path><path d="M114.196 92.2811L57.6906 1V66.9786L114.196 92.2811Z" fill="#B8FAF6" stroke="#1616B4" stroke-linejoin="round"></path></svg>
                        </a>
                    </div>
                    <div>
                        <a href="https://events.coinpedia.org/africa-blockchain-summit-2435/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/coinpedia.png" alt="Coinpedia Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://satoshicentre.tech/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/satoshi-center-logo.png" alt="Satoshi Centre Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://bravenewcoin.com/events/africa-blockchain-summit-2023" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/bave_newcoin_digital_currency_insights.jpg" alt="Brave Newcoin Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://fintechgh.com/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/ghana_fintech_and_payments_association.jpg" alt="Ghana Fintech Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://www.cryptonewsz.com/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/icoholder.png" alt="ICO Holder Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://www.fedi.xyz/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/fedi.jpg" alt="Fedi Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://www.cryptonewsz.com/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/CryptoNewSZ.png" alt="Cryptonewz Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://klarda.com/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/klarda.png" alt="Klarda Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://allconfsbot.website/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/allconfsbot.jpg" alt="Allconfsbot Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://www.cryptopolitan.com/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/cryptopolitan.jpg" alt="Cryptopolitan Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://scrt.network/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/secret.jpg" alt="Secret Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="https://bithub.africa/" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/bithub.jpg" alt="Bithub Logo" class="logo">
                        </a>
                    </div>
                    <div>
                        <a href="javascript:;" target="_blank">
                            <img src="<?= PROOT; ?>assets/media/partners/blockchaingaming.png" alt="Blockchain Gaming Logo" class="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-15 py-xl-20 bg-black inverted">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="accordion accordion-minimal accordion-highlight" id="accordion-1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-1">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-1" aria-expanded="false" aria-controls="collapse-1-1">
                                    How to apply as a Speaker ?
                                </button>
                            </h2>
                            <div id="collapse-1-1" class="accordion-collapse collapse" aria-labelledby="heading-1-1" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">Use this "<a href="<?= PROOT; ?>become-a-speaker" class="text-primary">link</a>" to apply as a speaker by filling in the form details.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-2">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-2" aria-expanded="false" aria-controls="collapse-1-2">
                                    How to join the sponser list?
                                </button>
                            </h2>
                            <div id="collapse-1-2" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        To join the sponser list you will need to send use an email through <a href="mailto:sponsor@blockchainsummit.africa" class="text-primary">sponsor@blockchainsummit.africa</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-3">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-3" aria-expanded="false" aria-controls="collapse-1-2">
                                    How do i buy a ticket?
                                </button>
                            </h2>
                            <div id="collapse-1-3" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        <!-- Tickets are only available when prices are being set, and from there you choose between Fiat or Crypto purchase. -->
                                        Tickets are only available when prices are being set.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="accordion-item">-->
                        <!--    <h2 class="accordion-header" id="heading-1-4">-->
                        <!--        <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-4" aria-expanded="false" aria-controls="collapse-1-2">-->
                        <!--            How do i buy ticket with FIAT?-->
                        <!--        </button>-->
                        <!--    </h2>-->
                        <!--    <div id="collapse-1-4" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">-->
                        <!--        <div class="accordion-body">-->
                        <!--            <p class="text-secondary">-->
                        <!--                To buy with Fiat, you will have to navigate to the price section and pick the category of your choice and hit on "Buy with Fiat" button. Provide your email and the number of tickets you want to purchase and proceed with payment.-->
                        <!--            </p>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-5">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-5" aria-expanded="false" aria-controls="collapse-1-2">
                                    How do i buy ticket with Crypto?
                                </button>
                            </h2>
                            <div id="collapse-1-5" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        To buy with Crypto, you will have to navigate to the price section and pick the category of your choice and hit on "Buy with Crypto" button. Provide your email and the number of tickets you want to purchase and proceed with payment.
                                        <!--NB: We accept only Bitcoin (BTC).-->
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-7">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-7" aria-expanded="false" aria-controls="collapse-1-4">
                                    Do I get free updates?
                                </button>
                            </h2>
                            <div id="collapse-1-7" class="accordion-collapse collapse" aria-labelledby="heading-1-4" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        <span class="fw-bold text-white">Yes.</span> Everyone can take advantage of lifetime updates by subscribing to our daily updates.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img class="img-fluid" src="<?= PROOT; ?>assets/media/svg/faq.svg" alt="FAQ">
                </div>
            </div>
        </div>
    </section>
    
    <!-- location -->
    <section>
        <div class="container py-20 foreground">
            <div class="row g-0">
                <div class="col-md-6 col-xl-5">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h2 class=""><?= ucwords($country) . ', ' . ucwords($city)?></h2>
                        </div>
                        <div class="card-body bg-light pt-0">
                            <ul class="list-group list-group-minimal">
                                <li class="list-group-item d-flex align-items-center mb-1">
                                    <div class="icon-box bg-opaque-primary rounded-circle me-2"><i class="bi bi-pin-angle"></i></div>
                                    <?= ucwords($address); ?>
                                </li>
                                <li class="list-group-item d-flex align-items-center mb-1">
                                    <div class="icon-box bg-opaque-primary rounded-circle me-2"><i class="bi bi-envelope text-color"></i></div>
                                    info@blockchainsummit.africa
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="icon-box bg-opaque-primary rounded-circle me-2"><i class="bi bi-telephone"></i></div>
                                    +233 24 437 6573
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer pt-0 text-end">
                            <a href="https://goo.gl/maps/u2mHkxRuGdyQZJVD9" target="_blank" class="action underline">Find directions <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="media h-100">
            <iframe title="map"
              style="
                    border:0;
                    z-index: 0;
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0px;
                    left: 0px;
                    border: medium none;
                "
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAl7HieEr-PAcYjTI1TBy_pd9oC1-xpZaI&q=University+of+Ghana">
            </iframe>
        </div>
    </section>


<?php include ('inc/foot.php'); ?>

<div class="modal fade" id="popupModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="bi bi-x modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-8 text-center">
                <h3 id="popupModalLabel">Free tickets available</h3>
                <p class="text-secondary">Up to 50 people can get free ticket to the event on 27 to 28 October at University of Ghana ABS23 event, hurry up and grab your free ticket before it get exhausted</p>
                <div class="d-grid gap-1 w-100 mt-3">
                    <a href="<?= PROOT; ?>register" class="btn btn-primary rounded-pill">Click here...</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(window).on('load', function() {
        $('#popupModal').modal('show');
    });
</script>
