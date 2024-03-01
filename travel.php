<?php

include ("connection/conn.php");

$title = 'Home';
$nav_color = 'navbar-light';
$btn_outline_light = 'light';

include ('inc/head.php');

?>
    <section class="py-15 py-xl-20">
        <div class="container mt-5 mt-xl-10">
            <h1 class="mb-1">TRAVEL INFORMATION</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= PROOT; ?>assets/media/abs-visa-application-requirement-to-ghana.pdf">To go to Ghana, are you prepared? then you should start gathering your belongings. You should, however, double-check these crucial data before making the first move. Here are some helpful hints for your stay if you're attending the "Africa Blockchain Summit."</a></li>
                </ol>
            </nav>
            
            <div class="row mt-4">
                <div class="col-lg-10">
                    <div class="accordion accordion-highlight" id="accordion-1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-1">
                                <button class="accordion-button fs-lg collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-1" aria-expanded="false" aria-controls="collapse-1-1">
                                    <i class="bi bi-map text-yellow fs-5 me-2"></i> Ghana Entry Requirements
                                </button>
                            </h2>
                            <div id="collapse-1-1" class="accordion-collapse collapse" aria-labelledby="heading-1-1" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        <ol type="a">
                                            <li class="mb-1">
                                                A valid passport or other appropriate travel documents are required of all travellers to Ghana. 
                                            </li>
                                            <li class="mb-1">
                                                All visitors entering Ghana must possess valid entrance visas, or entry permits in the case of Commonwealth nationals, issued by a Ghana diplomatic mission or consulate abroad, or by any other visa granting authority designated by the Ghanaian government to act on its behalf. Nationals of the ECOWAS and other nations with which the Government of Ghana has explicit bilateral agreements are free from this rule. 
                                            </li>
                                            <li class="mb-1">
                                                If already immunised, provide proof (a certificate) indicating the duration of a vaccination status of not more than ten (10) years prior to entering Ghana. Yellow fever vaccination is required for all travellers over the age of nine (9) months entering or transiting through Ghana at least ten (10) days prior to the proposed date of travel.
                                            </li>
                                            <li class="mb-1">
                                                Applicants should be aware that they might be interviewed.
                                            </li>
                                            <li class="mb-1">
                                                Within the given time limit, the visa permits entrance into Ghana. Please be aware that Ghana Immigration will confirm the length of your permitted stay there at the point of entrance. Therefore, applicants are recommended to get in touch with the Ghana Immigration Service if their stay would go over the approved amount of time.
                                            </li>
                                        </ol>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-2">
                                <button class="accordion-button fs-lg collapsed" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#collapse-1-2" aria-expanded="false" aria-controls="collapse-1-2">
                                    <i class="bi bi-columns text-yellow fs-5 me-2"></i> Requirements for granting a visa
                                </button>
                            </h2>
                            <div id="collapse-1-2" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        <ol type="a">
                                            <li class="mb-1">
                                                Personnel from international organisations and guests travelling to Ghana for leisure, study, business, or transit may be given visas.
                                            </li>
                                            <li class="mb-1">
                                                Either a single entry or multiple entry visa may be issued. First-time visitors are not eligible for entry-level visas of one year or longer.
                                            </li>
                                            <li class="mb-1">
                                                The three months following the date of issuance are the deadline for using issued visas.
                                            </li>
                                            <li class="mb-1">
                                                Visitors who are coming for business must provide documentation, such as a letter from their company, but visitors who are visiting Ghana on the invitation of Ghanaian residents or institutions must provide a letter of invitation from their hosts.
                                            </li>
                                            <li class="mb-1">
                                                Visitors may be asked to produce proof of sufficient cash for the duration of their stay in the country, a return or through ticket to the country to which they have the right of admission, or both. Prospective workers are permitted to work up to the authorised immigrant quota. Travellers arriving from countries where Ghana has no diplomatic or consular representation may be granted emergency visas at entry points, but such applications must be approved by the Comptroller-General of the Ghana Immigration Service through their sponsors before they arrive in Ghana.
                                            </li>
                                        </ol>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?= PROOT; ?>assets/media/abs-visa-application-requirement-to-ghana.pdf" class="btn btn-outline-primary mt-4">More information</a>
            

            <div class="row g-4 g-xl-5 justify-content-between mt-5">
                <div class="col-md-6 col-lg-7">
                    <article class="card hover-arrow">
                        <a href="https://angehillhotel.com-accra.com/en/" target='_blank'><img src="<?= PROOT; ?>assets/media/hotels/ange-hotel.jpg" class="card-img-top"
                                alt="Image"></a>
                        <div class="card-body p-0 pe-lg-10 mt-2">
                            <a href="https://angehillhotel.com-accra.com/en/" target='_blank' class="card-title">
                                <h5>ANGE HOTEL</h5>
                            </a>
                            <time datetime="7.1 km" class="eyebrow text-muted">7.1 km</time>
                            <br>
                            <a target="_blank" href="https://angehillhotel.com/en/" class="btn btn-outline-primary btn-sm mt-1">Book Hotel</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="card hover-arrow">
                        <a href="https://mensvicgrandhotel.com-accra.com/en" target='_blank'><img src="<?= PROOT; ?>assets/media/hotels/mensvic-hotel.jpg" class="card-img-top"
                                alt="Image"></a>
                        <div class="card-body p-0 pe-lg-10 mt-2">
                            <a href="https://mensvicgrandhotel.com-accra.com/en/" target='_blank' class="card-title">
                                <h5>MENSVIC HOTEL</h5>
                            </a>
                            <time datetime="4.4 km" class="eyebrow text-muted">4.4 km</time>
                            <br>
                            <a target="_blank" href="https://mensvicgrandhotel.com-accra.com/en/" class="btn btn-outline-primary btn-sm mt-1">Book Hotel</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-6">
                    <article class="card hover-arrow">
                        <a target='_blank' href="http://www.mjgrandhotelghana.com/"><img src="<?= PROOT; ?>assets/media/hotels/mj-grande-hotel.jpg" class="card-img-top"
                                alt="Image"></a>
                        <div class="card-body p-0 pe-lg-10 mt-2">
                            <a target='_blank' href="http://www.mjgrandhotelghana.com/" class="card-title">
                                <h5>MJ GRANDE HOTEL</h5>
                            </a>
                            <time datetime="5.2 km" class="eyebrow text-muted">5.2 km</time>
                            <br>
                            <a target="_blank" href="http://www.mjgrandhotelghana.com/" class="btn btn-outline-primary btn-sm mt-1">Book Hotel</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-5">
                    <article class="card hover-arrow">
                        <a target="_blank" href="https://tomreikhotel.com/"><img src="<?= PROOT; ?>assets/media/hotels/tomreik-hotel.jpg" class="card-img-top"
                                alt="Image"></a>
                        <div class="card-body p-0 pe-lg-10 mt-2">
                            <a target="_blank" href="https://tomreikhotel.com/" class="card-title">
                                <h5>TOMREIK HOTEL</h5>
                            </a>
                            <time datetime="5.0 km" class="eyebrow text-muted">5.0 km</time>
                            <br>
                            <a target="_blank" href="https://tomreikhotel.com/" class="btn btn-outline-primary btn-sm mt-1">Book Hotel</a>
                        </div>
                    </article>
                </div>


            </div>
        </div>
    </section>
  

   <?php include ('inc/foot.php'); ?>