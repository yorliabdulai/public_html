<?php
header('Location: https://blocklive.io/event/abs2023');
exit;
require_once ('connection/conn.php');

$nav_color = 'navbar-light';
$title = 'Ticket';
$btn_outline_light = 'light';
include ('inc/head.php');

// TICKETS
$ticketQuery = "
    SELECT * FROM bfc_ticket
    ORDER BY bfc_ticket.ticket_price ASC";
$statement = $conn->prepare($ticketQuery);
$statement->execute();
$count_ticket = $statement->rowCount();
$ticket_result = $statement->fetchAll();

?>

    <?php 
        if (isset($_GET['tid']) && !empty($_GET['tid'])):
            $id = sanitize((int)$_GET['tid']);
            if (is_numeric($id)) {
                // code...
                // code...
                $sql = "
                    SELECT * FROM bfc_ticket 
                    WHERE id = ? 
                    LIMIT 1
                ";
                $statement = $conn->prepare($sql);
                $statement->execute([$id]);
                $row_count = $statement->rowCount();
                $row = $statement->fetchAll();
                if ($row_count > 0) {
                    // code...
                    $price =  $row[0]['ticket_price'];
                } else {
                    redirect(PROOT . 'ticket');
                }

            } else {
                redirect(PROOT . 'ticket');
            }
    ?>

     <section class="py-15 py-xl-20">
        <div class="container mt-10">
            <div class="row justify-content-center mb-10">
                <div class="col-lg-8 text-center">
                    <h1 class="mb-2 text-color" id="ticket-name"><?= ucwords($row[0]['ticket_title']); ?></h1>
                    <p class="fs-lg text-secondary"><?= money_symbol('$', $row[0]['ticket_price']); ?></p>
                    <form id="paymentForm">
                        <div class="mb-1">
                            <input type="text" name="buyer-fullname" id="buyer-fullname" class="form-control form-control-sm" placeholder="Full name" required>
                            <br>
                            <input type="email" name="buyer-email" id="buyer-email" class="form-control form-control-sm" placeholder="Email" required>
                            <br>
                            <label class="text-muted">Number of Tickets</label>
                            <input type="number" min="1" name="number-of-tickets" id="number-of-tickets" class="form-control form-control-sm" value="1" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="d-grid gap-1 w-100 mt-3">
                            <button type="button" class="btn btn-warning rounded-pill" onclick="payWithPaystack(<?= $row[0]['id']; ?>);event.preventDefault();">Purchase</button>
                            <a href="<?= PROOT; ?>ticket">Cancel.</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>


    <?php else: ?>
  
    <!-- pricing -->
    <section class="py-15 py-xl-20">
        <div class="container mt-10">
            <div class="row justify-content-center mb-10">
                <div class="col-lg-8 text-center">
                    <h1 class="mb-2 text-color">Buy your ticket now</h1>
                    <p class="fs-lg text-secondary">You are given entry to the exclusive event by purchasing a ticket.</p>
                </div>
            </div>
            <div class="row g-4 align-items-end g-0 separated" data-aos="fade-up" data-aos-delay="100">
                <?php if ($count_ticket > 0): ?>
                    <?php foreach ($ticket_result as $ticket): ?>
                    <div class="col-md-4 bg-white">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h1 mb-10 fw-bold text-normal-color"><?= money_symbol('$', $ticket['ticket_price']); ?></h2>
                                <ul class="list-unstyled mb-4">
                                    <li class="py-1 lead"><?= ucwords($ticket['ticket_title']); ?></li>
                                    <li class="py-1"><?= nl2br($ticket['ticket_list']); ?></li>
                                </ul>
                                <div class="d-grid">
                                    <!--<a href="<?= PROOT; ?>ticket/<?= $ticket['id']; ?>" class="btn btn-warning btn-with-icon rounded-pill mb-1">Buy with FIAT <i class="bi bi-arrow-right"></i></a>-->
                                    <a href="<?= $ticket['ticket_link']; ?>" class="btn btn-warning btn-with-icon rounded-pill">Buy with CRYPTO <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="py-15 py-xl-20 bg-warning inverted">
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
                                    <p class="text-secondary">Use this "<a href="<?= PROOT; ?>become-a-speaker" class="text-warning">link</a>" to apply as a speaker by filling in the form details.</p>
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
                                        To join the sponser list you will need to send use an email through <a href="mailto:sponsor@blockchainsummit.africa" class="text-warning">sponsor@blockchainsummit.africa</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-3">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-3" aria-expanded="false" aria-controls="collapse-1-2">
                                    How do i buy ticket?
                                </button>
                            </h2>
                            <div id="collapse-1-3" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        Tickets are only available when prices are being set, and from there you choose between Fiat or Crypto purchase.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-4">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-4" aria-expanded="false" aria-controls="collapse-1-2">
                                    How do i buy ticket with FIAT?
                                </button>
                            </h2>
                            <div id="collapse-1-4" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        To buy with Fiat, you will have to navigate to the price section and pick the category of your choice and hit on "Buy with Fiat" button. Provide your email and the number of tickets you want to purchase and proceed with payment.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1-5">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-5" aria-expanded="false" aria-controls="collapse-1-2">
                                    How do i buy ticket with Crypto?
                                </button>
                            </h2>
                            <div id="collapse-1-5" class="accordion-collapse collapse" aria-labelledby="heading-1-2" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="text-secondary">
                                        To buy with Crypto, you will have to navigate to the price section and pick the category of your choice and hit on "Buy with Crypto" button. Provide your email and the number of tickets you want to purchase and proceed with payment. NB: We accept only Bitcoin (BTC).
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
    <?php endif; ?>
    <?php 
        include ('inc/foot.php');
        if (isset($_GET['tid']) && !empty($_GET['tid'])):
    ?>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript">
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("button", payWithPaystack, false);

    function payWithPaystack(id) {
        var ticket_price = 0;
        var get_ticketname = document.getElementById("ticket-name").innerText;
        var get_number = document.getElementById("number-of-tickets").value;
        var get_email = document.getElementById("buyer-email").value;
        var get_fullname = document.getElementById("buyer-fullname").value;


        if (get_number != '' && get_email != '' && get_fullname != '') {
            $.ajax({
                url : '<?= PROOT; ?>control/get_ticket_price.php',
                method: 'POST',
                data: { id : id },
                success: function(t_price) {
                    if (t_price > 0) {
                        ticket_price += t_price;
                        //var pre_amount = (get_number * ticket_price).toFixed(2);
                        var pre_amount = (get_number * ticket_price);
                        pre_amount = (pre_amount + 0.5);
                        pre_amount = parseInt(get_number * ticket_price);

                        let handler = PaystackPop.setup({
                        key: '<?= PAYSTACK_PUBLIC_KEY; ?>', // Replace with your public key
                        email: get_email,
                        amount: pre_amount * 100,
                        currency: "GHS",
                        ref: 'ABS'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                        // label: "Optional string that replaces customer email"
                        onClose: function() {
                            window.location = "https://blockchainsummit.africa/ticket";
                            alert('Transaction Cancelled.');
                        },
                        callback: function(response) {
                            let message = 'Payment complete! Reference: ' + response.reference;

                            let total_amt = pre_amount;
                            window.location = "https://blockchainsummit.africa/verify-txn?r=" + response.reference+"&a="+total_amt+"&n="+get_number+"&f="+get_fullname+"&e="+get_email+"&t="+get_ticketname;
                            // window.location = "https://sites.local/bfc/verify-txn/"+response.reference+"/"+total_amt+"/"+get_number+"/"+get_fullname+"/"+get_email+"/"+get_ticketname;
                        }
                    });
                    handler.openIframe();
                    } else {
                        return false;
                    }
                },
                error: function() {
                    alert('Something went wrong.')
                }
            })
        } else {
            return false;
        }
    }
</script>
<?php endif; ?>

</body>
</html>