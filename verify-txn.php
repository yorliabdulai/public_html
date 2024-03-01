<?php 

require_once ('connection/conn.php');

if (isset($_GET['r'])) {
    $purchase_reference = $_GET['r'];
    $purchase_total_amt = $_GET['a'];
    $purchase_number_of_tickets = $_GET['n'];
    $purchase_fullname = $_GET['f'];
    $purchase_email = $_GET['e'];
    $purchase_ticket_type = $_GET['t'];

    if ($purchase_reference == "") {
        header("Location: javascript://history.go(-1)");
    } else {
        $curl = curl_init();
      
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($purchase_reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".PAYSTACK_PRIVATE_KEY."",
                "Cache-Control: no-cache",
            ),
        ));
      
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
      
        if ($err) {
            // echo "cURL Error #:" . $err;
            echo "<script>console.log('cURL Error #:" . $err . ');</script>';
        } else {
            $result = json_decode($response);
            if ($result->data->status == 'success') {
                $status = $result->data->status;
                $purchase_reference = $result->data->reference;
                $amount = $result->data->amount;
                $fname = $result->data->customer->first_name;
                $lname = $result->data->customer->last_name;
                $full_name = ucwords($fname .' '. $lname);
                $email = $result->data->customer->email;
                date_default_timezone_set("Africa/Accra");
                $purchase_datetime = date("Y-m-d H:i:s");

                $data = [
                    $purchase_reference,
                    $purchase_fullname,
                    $purchase_email,
                    $purchase_ticket_type,
                    $purchase_number_of_tickets,
                    $purchase_total_amt,
                    $purchase_datetime
                ];
                $query = "
                    INSERT INTO `bfc_fiat_purchase`(`purchase_reference`, `purchase_fullname`, `purchase_email`, `purchase_ticket_type`, `purchase_number_of_tickets`, `purchase_total_amt`, `purchase_datetime`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)

                ";
                $statement = $conn->prepare($query);
                $result = $statement->execute($data);

                if (isset($result)) {
                    $subject =  "Ticket Purchased, [{$purchase_reference}].";
                    $body = "
                        <center>
                            <h3>
                                Hi " . ucwords($purchase_fullname) . ",</h3>
                                <p>
                                    Africa Blockchain Summit received your payment of
                                    <br>
                                    <h2>" . money_symbol('$ ', $purchase_total_amt) . "</h2>
                                    <br><br>
                                     REFERENCE: {$purchase_reference}
                                    <br>
                                    TICKET TYPE: {$purchase_ticket_type}
                                    <br>
                                     NUMBER OF TICKETS: {$purchase_number_of_tickets}
                                    <br>
                                    DATE: ".pretty_date($purchase_datetime)."
                            </p>
                        </center>
                    ";
                    
                    send_email(ucwords($purchase_fullname), $purchase_email, $subject, $body);
                }

            } else {
                redirect(PROOT . 'no-txn?Transaction was not made!');
            }
        }
    }

} else {
    redirect(PROOT . "tickets");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  
    <link rel="shortcut icon" href="<?= PROOT; ?>assets/media/logo/logo-sm.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/libs.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/index.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bfc.css" />
    <title>Verify Transaction ~ Africa Blockchain Summit</title>
</head>
<body class="bg-light">

	<section class="overflow-hidden">
		<div class="container d-flex flex-column py-5 min-vh-100 level-3">
      		<div class="row align-items-center justify-content-center justify-content-lg-between my-auto">
        		<div class="col-md-8 col-lg-5 order-lg-2 mb-5 mb-lg-0" data-aos="fade-up">
          			<img src="<?= PROOT; ?>assets/media/logo/logo-sm.png" class="img-fluid" alt="Africa Blockchain Summit">
        		</div>
        		<div class="col-md-10 col-lg-6 col-xl-5 text-center text-lg-start order-lg-1">
          			<h1 style="color: #653600;">You just paid...</h1>
                    <small class="text-muted">receipt has been send to your mailbox, you can also take a screenshot this for easy recovery</small>
                    
                    <div class="card sticky-top" style="background-color: rgb(253 149 0 / 14%);">
                        <div class="accordion accordion-classic" id="accordion-1">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-1-1">
                                    <button class="accordion-button collapsed fw-bold fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-1" aria-expanded="false" aria-controls="collapse-1-1">
                                        <?= money_symbol('$', $purchase_total_amt); ?>
                                    </button>
                                </h2>
                                <div id="collapse-1-1" class="accordion-collapse" aria-labelledby="heading-1-1" data-bs-parent="#accordion-1">
                                    <div class="accordion-body">
                                        <ol class="list-group list-group-minimal">
                                            <li class="list-group-item d-flex justify-content-between align-items-start text-secondary">
                                                Name
                                                <span class="text-black"><?= ucwords($purchase_fullname); ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start text-secondary">
                                                Email
                                                <span class="text-black"><?= $purchase_email; ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start text-secondary">
                                                Reference
                                                <span class="text-black"><?= $purchase_reference; ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start text-secondary">
                                                Ticket Type
                                                <span class="text-black"><?= ucwords($purchase_ticket_type); ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start text-secondary">
                                                No. Tickets
                                                <span class="text-black"><?= $purchase_number_of_tickets; ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start text-secondary">
                                                Date
                                                <span class="text-black"><?= pretty_date($purchase_datetime); ?></span>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
          			<div class="row align-items-center g-3">
			            <div class="col-md-auto">
			              	<a href="<?= PROOT; ?>tickets" class="btn btn-warning btn-with-icon rounded-pill btn-lg">Buy more <i
			                  class="bi bi-arrow-right"></i></a>
			            </div>
				        <div class="col text-md-start">
				          	<p style="color: #fa9309a1">Fingers cross 🤞, left <span class="fw-bold">26 August, 2023</span> for the mega conference.
				         	</p>
				    	</div>
				 	</div>
				</div>
			</div>
		</div>
	</section>

  <script src="<?= PROOT; ?>assets/js/vendor.bundle.js"></script>
  <script src="<?= PROOT; ?>assets/js/index.bundle.js"></script>

</body>
</html>