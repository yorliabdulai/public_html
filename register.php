<?php 

include ("connection/conn.php");

$fullname = ((isset($_POST['fullname']) && !empty($_POST['fullname'])) ? sanitize($_POST['fullname']) : '');
$email = ((isset($_POST['email']) && !empty($_POST['email'])) ? sanitize($_POST['email']) : '');
$phone = ((isset($_POST['phone']) && !empty($_POST['phone'])) ? sanitize($_POST['phone']) : '');
$region = ((isset($_POST['region']) && !empty($_POST['region'])) ? sanitize($_POST['region']) : '');
$reference = ((isset($_POST['reference']) && !empty($_POST['reference'])) ? sanitize($_POST['reference']) : '');
$output = '';

if (isset($_POST['submit'])) {
    if (!empty($fullname) || $fullname != '') {
        if (!empty($email) || $email != '') {
        	if (!empty($phone) || $phone != '') {
        	
	            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

	            	// check if speaker do not already exist
	            	$sql = "
	            		SELECT * FROM abs_registration 
	            		WHERE registration_email = ? 
	            		OR registration_phone = ?
	            	";
	            	$statement = $conn->prepare($sql);
	            	$statement->execute([$email, $phone]);
	            	if ($statement->rowCount() > 0) {
						$output = '<div class="alert alert-secondary">Your email or phone already exist!</div>';
	            	} else {
									

						$added_date = date("Y-m-d H:i:s");
						if (empty($output)) {								
		                    $to      = 'info@blockchainsummit.africa';
	                        $subject = 'I will like to attend for the summit.';
	                        $body = '
	                            <html>
	                            <head>
	                               <title>Africa Blockchain Summit</title>
	                            </head>
	                            <body>
	                               <p>
	                            	    <center>
	                                    	<h3>Full Name</h3>
	                                    	<b>'.$fullname.'</b>
	                                    	<br>
	                                    	<h3>Email</h3>
	                                    	<b>'.$email.'</b>
	                                    	<br>
	                                    	<h3>Phone</h3>
	                                    	<b>'.$phone.'</b>
	                                    	<br>
	                                    	<h3>Region</h3>
	                                    	<b>'.$region.'</b>
	                                    	<br>
	                                    	<h3>Reference</h3>
	                                    	<b>'.$reference.'</b>
	                                	</center>
	                                </p>
	                           </body>
	                           </html>
	                        ';
	                        $headers = "MIME-Version: 1.0" . "\r\n";
	                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	                        $headers .= "From:" . $email;
	                            
	                        if (mail($to, $subject, $body, $headers)) {
				                $query = "
				                    INSERT INTO `abs_registration`(`registration_full_name`, `registration_email`, `registration_phone`, `registration_region`, `registration_reference`, `registration_date`) 
				                    VALUES (?, ?, ?, ?, ?, ?)
				                ";
				                $statement = $conn->prepare($query);
				                $result = $statement->execute([$fullname, $email, $phone, $region, $reference, $added_date]);
				                if (isset($result)) {
				                	$last_id = $conn->lastInsertId();
				                	$uniqueid =  'ABS23-'  . $last_id . '-' . time();
				                	
				                	$conn->query("UPDATE abs_registration SET registration_identity = '" . $uniqueid . "' WHERE id = $last_id")->execute();
				                	
				                    $Subject =  "Registration for ABS 2023.";
				                    $body = "
				                        <center>
				                            <h3>" . ucwords($fullname) . ",</h3>
			                                <p>
			                                	Thank you for registering to be part of the upcoming Africa Blockchain Summit 
			                                	<br>
			                                	on 27th to 28th October 2023.
			                                	<br>
			                                	Entering ID: <b>" . $uniqueid . "</b>
			                                    <br>
			                                    <br>
			                                    Best Regards,
			                                    <br>
			                                    Africa Blockchain Summit.
				                            </p>
				                        </center>
				                    ";
				                	send_email(ucwords($fullname), $email, $Subject, $body);
				                	$_SESSION['last_id'] = $last_id;
				                	redirect(PROOT . 'thankyou');
				                }
	                        } else {
					            $output = '<div class="alert alert-secondary">Something went wrong, try again!</div>';
	                        }
		                }
					}
	         	} else {
	                $output = '<div class="alert alert-secondary">Invalid Email</div>';
				} 
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  
    <link rel="shortcut icon" href="<?= PROOT; ?>assets/media/logo/banner.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/libs.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/index.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bsa.css" />
    <title>Be an Attendee ~ Africa Blockchain Summit</title>
</head>
<body>
	
    <!-- contact -->
    <section class="py-15 py-xl-10">
      	<div class="container">
        	<div class="row justify-content-center">
          		<div class="col-lg-8 mb-5">
          			<img src="assets/media/logo/logo-sm.png" width="40" height="80" alt="ABS Logo">
            		<h2 class="fw-bold">Register Now <span class="d-block">to claim your free spot.</span></h2>
            		Get in touch with us directly on&nbsp;
            		<a href="mailto:speaker@bitfreesummit.africa?subject=BE A SPEAKER!">info@blockchainsummit.africa</span></a>
          		</div>
		        <div class="col-lg-8">
		        	<span><?= $output; ?></span>
		            <form method="POST" class="row g-3">
		             	<div class="col-md-12">
		                	<label for="fullname" class="form-label">Your Full Name</label>
		                	<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Full Name" value="<?= $fullname; ?>" required>
		              	</div>
		              	<div class="col-md-6">
		                	<label for="email" class="form-label">Email</label>
		                	<input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" placeholder="Email" required>
		              	</div>
		              	<div class="col-md-6">
		                	<label for="phone" class="form-label">Phone</label>
		                	<input type="text" class="form-control" id="phone" name="phone" value="<?= $phone; ?>" placeholder="Phone" required>
		              	</div>
		              	<div class="col-md-4">
		                	<label for="region" class="form-label">Region</label>
		                	<select type="text" class="form-control" id="region" name="region" required>
		                		<option value="">select your region</option>
		                		<option <?= ((isset($_POST['region']) == 'Northern') ? 'selected' : ''); ?>value="Northern">Northern</option>
		                		<option <?= ((isset($_POST['region']) == 'Ashanti') ? 'selected' : ''); ?>value="Ashanti">Ashanti</option>
		                		<option <?= ((isset($_POST['region']) == 'Western') ? 'selected' : ''); ?>value="Western">Western</option>
		                		<option <?= ((isset($_POST['region']) == 'Volta') ? 'selected' : ''); ?>value="Volta">Volta</option>
		                		<option <?= ((isset($_POST['region']) == 'Eastern') ? 'selected' : ''); ?>value="Eastern">Eastern</option>
		                		<option <?= ((isset($_POST['region']) == 'Upper West') ? 'selected' : ''); ?>value="Upper West">Upper West</option>
		                		<option <?= ((isset($_POST['region']) == 'Central') ? 'selected' : ''); ?>value="Central">Central</option>
		                		<option <?= ((isset($_POST['region']) == 'Upper East') ? 'selected' : ''); ?>value="Upper East">Upper East</option>
		                		<option <?= ((isset($_POST['region']) == 'Greater Accra') ? 'selected' : ''); ?>value="Greater Accra">Greater Accra</option>
		                		<option <?= ((isset($_POST['region']) == 'Savannah') ? 'selected' : ''); ?>value="Savannah">Savannah</option>
		                		<option <?= ((isset($_POST['region']) == 'North East') ? 'selected' : ''); ?>value="North East">North East</option>
		                		<option <?= ((isset($_POST['region']) == 'Bono East') ? 'selected' : ''); ?>value="Bono East">Bono East</option>
		                		<option <?= ((isset($_POST['region']) == 'Oti') ? 'selected' : ''); ?>value="Oti">Oti</option>
		                		<option <?= ((isset($_POST['region']) == 'Ahafo') ? 'selected' : ''); ?>value="Ahafo">Ahafo</option>
		                		<option <?= ((isset($_POST['region']) == 'Bono') ? 'selected' : ''); ?>value="Bono">Bono</option>
		                		<option <?= ((isset($_POST['region']) == 'Western North') ? 'selected' : ''); ?>value="Western North">Western North</option>
		                	</select>
		              	</div>
		              	<div class="col-md-8">
		                	<label for="phone" class="form-label">Reference</label>
		                	<select class="form-select" aria-label="Default select example" id="reference" name="reference" required>
		                		<option value=""></option>
		                		<option value="From a friend">From a friend</option>
		                		<option value="Noones">Noones</option>
		                		<option value="Metis Africa">Metis Africa</option>
		                		<option value="Fedi">Fedi</option>
		                		<option value="School of Pharmacy (UG)">School of Pharmacy (UG)</option>
		                		<option value="SRC (UG)">SRC (UG)</option>
		                		<option value="Organizer">Organizer</option>
		                		<option value="Online search">Online search</option>
		                		<option value="Social media">Social media</option>
		                		<option value="Advertising">Advertising</option>
		                	</select>
		              	</div>
              			<div class="col-md-12">
		                	<button type="submit" id="submit" name="submit" class="btn btn-block btn-primary rounded-pill">Submit</button>
		                	<br>
		                	<br>
		                	<a href="<?= PROOT; ?>index"><< go back</a>
		              	</div>
		            </form>
		        </div>
		    </div>
		</div>
	</section>

</body>
</html>
