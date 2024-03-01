<?php
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
        if (isset($_GET['tid']) && !empty($_GET['tid'])) {
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
        } else {
            redirect(PROOT . 'ticket');
        }
    ?> 

    <style>
        
        .bitnob-button {
          display: flex;
          justify-content: center;
          align-items: center;
          background-color:
          #031735;
          color: #ffffff;
          border: none;
          padding: 10px 30px;
          border-radius: 10px;
          cursor: pointer;
          font-family: 'Quicksand', sans-serif;
        }

        .button-div {
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
        }

        .bitnob-img {
          width: 20px;
          background-image: url("https://res.cloudinary.com/gabbyprecious/image/upload/v1650746449/cad8exitdhnparfqyfjf.png");
          background-position: center;
          background-size: contain;
          background-repeat: no-repeat;
          height: 20px;
        }
    </style>  
     <section class="py-15 py-xl-20">
        <div class="container mt-10">
            <div class="row justify-content-center mb-10">
                <div class="col-lg-8 text-center">
                    <h1 class="mb-2 text-color" id="ticket-name"><?= ucwords($row[0]['ticket_title']); ?></h1>
                    <p class="fs-lg text-secondary"><?= money_symbol('$', $row[0]['ticket_price']); ?></p>
                     <form onsubmit="getFormData(event, <?= $row[0]['id']; ?>)" class="form-container">
                        <div class="mb-1">
                            <div class="input-div">
                                <input type="text" name="buyer-fullname" id="buyer-fullname" class="form-control form-control-sm" placeholder="Full name" required>
                            </div>
                            <br>
                            <div class="input-div">
                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email" required>
                            </div>
                            <br>
                            <div class="input-div">
                                <label class="text-muted">Number of Tickets</label>
                                <input type="number" min="1" name="number-of-tickets" id="number-of-tickets" class="form-control form-control-sm" value="1" required>
                            </div>
                            <div class="form-text"></div>
                        </div>
                        <div class="d-grid gap-1 w-100 mt-3">
                            <div class="button-div">
                                <button type="submit" id="button-pay" class="bitnob-button">
                                    <div class="bitnob-img"></div>
                                    <p>Pay With Bitnob</p>
                                </button>
                                <a href="<?= PROOT; ?>ticket" style="float: left; margin-top: 8px;">Cancel.</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <?php include ('inc/foot.php'); ?>

    <script src="https://www.js.bitnob.co/v1/inline.js"></script>
    <script>
        function setReference() {
            let text = "";
            let possible =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (let i = 0; i < 10; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        function pay(publicKey, amount, customerEmail, reference, get_number, get_fullname, get_ticketname) {
            var data = {
                publicKey: publicKey,
                amount: amount,
                customerEmail: customerEmail,
                notificationEmail: 'gabbyprecious2000@gmail.com',
                description: "pay me my money",
                currency: "USD",
                reference: reference,
                callbackUrl: "https://webhook.site/9a821598af93b4f65717",
                //successUrl: "https://google.com?r="+reference,
                successUrl: "https://sites.local/bfc/verify-txn?r="+reference+"&a="+amount+"&n="+get_number+"&f="+get_fullname+"&e="+customerEmail+"&t="+get_ticketname
            };
            window.initializePayment(data, "sandbox");
        }

        function getFormData(e, id) {
            e.preventDefault();

            var ticket_price = 0;
            var get_ticketname = document.getElementById("ticket-name").innerText;
            var get_number = document.getElementById("number-of-tickets").value;
            var get_email = document.getElementById("email").value;
            var get_fullname = document.getElementById("buyer-fullname").value;

            if (get_number != '' && get_email != '' && get_fullname != '') {
                $.ajax({
                    url : '<?= PROOT; ?>control/get_ticket_price.php',
                    method: 'POST',
                    data: { id : id },
                    success: function(t_price) {
                        if (t_price > 0) {
                            ticket_price += t_price;
                            var amount = (get_number * ticket_price).toFixed(2);

                            var reference = setReference();
                            pay('<?= BITNOB_PUBLIC_KEY; ?>',
                                amount,
                                get_email,
                                reference,
                                get_number,
                                get_fullname,
                                get_ticketname
                            );
                            console.log(setReference())
                          
                        } else {
                            return false;
                        }
                    },
                    error: function() {
                        alert('Something went wrong.')
                    }
                })
                
            } else {

            }
        }

    </script>
</body>
</html>