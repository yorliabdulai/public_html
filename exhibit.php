<?php 

include ("connection/conn.php");

$company = ((isset($_POST['company']) && !empty($_POST['company'])) ? sanitize($_POST['company']) : '');
$email = ((isset($_POST['email']) && !empty($_POST['email'])) ? sanitize($_POST['email']) : '');
$phone = ((isset($_POST['phone']) && !empty($_POST['phone'])) ? sanitize($_POST['phone']) : '');
$facebook = ((isset($_POST['facebook']) && !empty($_POST['facebook'])) ? sanitize($_POST['facebook']) : '');
$twitter = ((isset($_POST['twitter']) && !empty($_POST['twitter'])) ? sanitize($_POST['twitter']) : '');
$linkedin = ((isset($_POST['linkedin']) && !empty($_POST['linkedin'])) ? sanitize($_POST['linkedin']) : '');
$address = ((isset($_POST['address']) && !empty($_POST['address'])) ? sanitize($_POST['address']) : '');
$bio = ((isset($_POST['bio']) && !empty($_POST['bio'])) ? sanitize($_POST['bio']) : '');

$output = '';
if (isset($_POST['submit'])) {
    if (!empty($company) || $company != '') {
        if (!empty($email) || $email != '') {
        	if (strlen($bio) > 400) {
        		$output = '<div class="alert alert-secondary">Bio must be less than or equal to 400 words.</div>';
        	}
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            	// check if speaker do not already exist
            	$sql = "
            		SELECT * FROM bfs_exhibit 
            		WHERE exhibit_email = ? 
            		OR exhibit_phone = ? 
            		OR exhibit_company = ?
            	";
            	$statement = $conn->prepare($sql);
            	$statement->execute([$email, $phone, $company]);
            	if ($statement->rowCount() > 0) {
					$output = '<div class="alert alert-secondary">Company name or email or phone already exist!</div>';
            	} else {
					$added_date = date("Y-m-d H:i:s");
					if (empty($output)) {								
	                    $to      = 'info@blockchainsummit.africa';
                        $subject = 'Want to join the exhibition list.';
                        $body = '
                            <html>
                            <head>
                               <title>Bitcoin Freedom Summit</title>
                            </head>
                            <body>
                               <p>
                            	    <center>
                                    	<h3>Company Name</h3>
                                    	<b>'.$company.'</b>
                                    	<br>
                                    	<h3>Email</h3>
                                    	<b>'.$email.'</b>
                                    	<br>
                                    	<h3>Phone</h3>
                                    	<b>'.$phone.'</b>
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
			                    INSERT INTO `bfs_exhibit`(`exhibit_company`, `exhibit_email`, `exhibit_phone`, `exhibit_facebook`, `exhibit_twitter`, `exhibit_linkedin`, `exhibit_address`, `exhibit_bio`, `added_date`) 
			                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
			                ";
			                $statement = $conn->prepare($query);
			                $result = $statement->execute([$company, $email, $phone, $twitter, $linkedin, $facebook, $address, $bio, $added_date]);
			                if (isset($result)) {
			                	// send mail to exhibitor
			                	$Subject =  "Your request for Exhibition.";
			                    $body = "
			                        <center>
			                            <h3>" . ucwords($company) . ",</h3>
		                                <p>
		                                    Africa Blockchain Summit received your request to be on the exhibition list.
		                                    <br>
		                                    We will get back to you soon.
		                                    <br><br>
		                                    Best Regards,
		                                    <br>
		                                    Africa Blockchain Summit.
			                            </p>
			                        </center>
			                    ";
			                	send_email(ucwords($company), $email, $Subject, $body);

			                    $_SESSION['flash_success'] = 'Speaker added!';
			                    redirect(PROOT . 'exhibit-requested');
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
    <title>Exhibit ~ Blockchain Summit</title>
</head>
<body>
	
    <!-- contact -->
    <section class="py-15 py-xl-10">
      	<div class="container">
        	<div class="row justify-content-center">
          		<div class="col-lg-8 mb-5">
          			<img src="assets/media/logo/logo-sm.png" width="40" height="80" alt="ABS Logo">
            		<h2 class="fw-bold">Exhibition</h2>
            		Get in touch with us directly on&nbsp;
            		<a href="mailto:info@blockchainsummit.africa">info@blockchainsummit.africa</span></a>
          		</div>
		        <div class="col-lg-8">
		        	<span><?= $output; ?></span>
		            <form method="POST" class="row g-3" name="be-a-speaker" enctype="multipart/form-data">
		              	<div class="col-md-6">
		                	<label for="company" class="form-label">Your Company</label>
		                	<input type="text" class="form-control" id="company" name="company" value="<?= $company; ?>" placeholder="Your Company">
		              	</div>
		              	<div class="col-md-6">
		                	<label for="email" class="form-label">Email</label>
		                	<input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" placeholder="Email" required>
		              	</div>
		              	<div class="col-md-6">
		                	<label for="phone" class="form-label">Phone</label>
		                	<input type="text" class="form-control" id="phone" name="phone" value="<?= $phone; ?>" placeholder="Phone" required>
		              	</div>
		              	<div class="col-md-6">
		                	<label for="facebook" class="form-label">Facebook</label>
		                	<input type="text" class="form-control" id="facebook" name="facebook" value="<?= $facebook; ?>" placeholder="Facebook">
		              	</div>
		              	<div class="col-md-6">
		                	<label for="twitter" class="form-label">Twitter</label>
		                	<input type="text" class="form-control" id="twitter" name="twitter" value="<?= $twitter; ?>" placeholder="Twitter">
		              	</div>
		              	<div class="col-md-6">
		               		<label for="linkedin" class="form-label">LinkedIn</label>
		                	<input type="text" class="form-control" id="linkedin" name="linkedin" value="<?= $linkedin; ?>" placeholder="LinkedIn">
		              	</div>
		              	<div class="col-12">
		               		<label for="address" class="form-label">Address</label>
		                	<input type="text" class="form-control" id="address" name="address" value="<?= $address; ?>" placeholder="Address">
		              	</div>
		              	<div class="col-md-12">
		                	<label for="bio" class="form-label">About</label>
		                	<textarea class="form-control" id="bio" name="bio" rows="3" placeholder="About company ..." required><?= $bio; ?></textarea>
		                	<div class="form-text">400 words or less.</div>
		              	</div>
              			<div class="col-md-12">
		                	<button type="submit" id="submit" name="submit" class="btn btn-block btn-warning rounded-pill">Submit</button>
		                	<br>
		                	<br>
		                	<a href="index"><< go back</a>
		              	</div>
		            </form>
		        </div>
		    </div>
		</div>
	</section>

</body>
</html>
