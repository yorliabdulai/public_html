        <!-- footer -->
    <footer class="py-15 py-xl-20 bg-light">
        <div class="container">
            <div class="row justify-content-between g-5 mb-5 mb-lg-10">
                <div class="col-lg-4">
                    <a href="<?= PROOT; ?>" class="navbar-brand"><img src="<?= PROOT; ?>assets/media/logo/logo-full.png" alt="Logo"></a>
                    <p class="mt-2 text-muted pe-lg-5">Building Blockchains for Africa's Future.</p>
                    <span class="h5">
                        <a href="tel:+26773296536">+267 73 296 536</a>
                        <br>
                        <a href="tel:+233244376573">+233 24 437 6573</a>
                        <br>
                        <li class="list-inline-item"><a href="https://web.facebook.com/people/Bitcoin-Freedom-Summit/100089473803686/" class="text-reset">facebook</a></li>
                        <li class="list-inline-item ms-1"><a href="https://twitter.com/ab_summit" class="text-reset">twitter</a></li>
                        <li class="list-inline-item ms-1"><a href="https://linkedin.com/bitfreesummit" class="text-reset">linkedin</a></li>
                    </span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3 g-xl-5">
                        <div class="col-6 col-md-4">
                            <span class="eyebrow text-muted mb-1 d-flex">Menu</span>
                            <ul class="list-unstyled">
                                <li class="mb-1"><a href="<?= PROOT; ?>speaker" class="text-reset text-primary-hover">Speakers</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>tour" class="text-reset text-primary-hover">Tour</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>exhibit" class="text-reset text-primary-hover">Exhibit</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>hackathon" class="text-reset text-primary-hover">Hackathon</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>about-us" class="text-reset text-primary-hover">About us</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                          <span class="eyebrow text-muted mb-1 d-flex">Browse</span>
                          <ul class="list-unstyled">
                                <li class="mb-1"><a href="https://blocklive.io/event/abs2023" class="text-reset text-primary-hover">Get tickets</a></li>
                                <li class="mb-1">
                                <li class="mb-1"><a href="<?= PROOT; ?>register" class="text-reset text-primary-hover">Register</a></li>
                                    <a href="<?= PROOT; ?>be-a-speaker" class="text-reset text-primary-hover">Be a speaker</a>
                                    </li>
                                <li class="mb-1"><a href="mailto:sponsor@blockchainsummit.africa?subject=BE OUR SPONSOR!" class="text-reset text-primary-hover">Be our sponsor</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>register-hackathon" class="text-reset text-primary-hover">Hackathon Application Form</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <span class="eyebrow text-muted mb-1 d-flex">Explore</span>
                              <ul class="list-unstyled">
                                <li class="mb-1"><a href="<?= PROOT; ?>partners" class="text-reset text-primary-hover">Partners</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>sponsors" class="text-reset text-primary-hover">Sponsors</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>travel" class="text-reset text-primary-hover">Travel</a></li>
                                <li class="mb-1"><a href="<?= PROOT; ?>press" class="text-reset text-primary-hover">Press</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between g-2 g-lg-5">
                <div class="col-md-6 col-lg-4 order-md-2 text-md-end">
                    <span class="small text-muted"><?= ucwords($address) . ', ' . ucwords($city); ?><br><?= ucwords($country); ?></span>
                </div>
                <div class="col-md-6 col-lg-3 order-md-1">
                    <p class="small text-muted">Copyrights &copy; Africa Blockchain Summit <script>document.write(new Date().getFullYear())</script></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= PROOT; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/vendor.bundle.js"></script>
    <script src="<?= PROOT; ?>assets/js/index.bundle.js"></script>
    <script>
        // SUBSCRIBE TO NEW PRODUCTS
        function subscribe_products() {
            var email = $('#subscribe').val();

            if (email == '') {
                alert('Enter email to subscribe');
                return false;
            } else if (!isEmail(email)) {
                alert('Please enter a valid email.');
                return false;
            } else {
                $.ajax({
                    url : '<?= PROOT; ?>control/subscriber.php',
                    method : 'POST',
                    data : {email : email},
                    success : function(data) {
                        alert(data);
                        location.reload();
                    },
                    error : function() {
                        alert('Something went wrong.');
                    }
                });
            }

        }

        function isEmail(email) { 
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }
    </script>

</body>
</html>