<?php 

include ("connection/conn.php");

$fullname = ((isset($_POST['fullname']) && !empty($_POST['fullname'])) ? sanitize($_POST['fullname']) : '');
$company = ((isset($_POST['company']) && !empty($_POST['company'])) ? sanitize($_POST['company']) : '');
$role = ((isset($_POST['role']) && !empty($_POST['role'])) ? sanitize($_POST['role']) : '');
$email = ((isset($_POST['email']) && !empty($_POST['email'])) ? sanitize($_POST['email']) : '');
$phone = ((isset($_POST['phone']) && !empty($_POST['phone'])) ? sanitize($_POST['phone']) : '');
$facebook = ((isset($_POST['facebook']) && !empty($_POST['facebook'])) ? sanitize($_POST['facebook']) : '');
$twitter = ((isset($_POST['twitter']) && !empty($_POST['twitter'])) ? sanitize($_POST['twitter']) : '');
$linkedin = ((isset($_POST['linkedin']) && !empty($_POST['linkedin'])) ? sanitize($_POST['linkedin']) : '');
$message = ((isset($_POST['message']) && !empty($_POST['message'])) ? sanitize($_POST['message']) : '');
$bio = ((isset($_POST['bio']) && !empty($_POST['bio'])) ? sanitize($_POST['bio']) : '');


$output = '';
if (isset($_POST['submit'])) {
    if (!empty($fullname) || $fullname != '') {
        if (!empty($email) || $email != '') {
        //     if (strlen($bio) > 400) {
        // 		$output = '<div class="alert alert-secondary">Bio must be less than or equal to 400 words.</div>';
        // 	}
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            	// check if speaker do not already exist
            	$sql = "
            		SELECT * FROM bsa_speaker 
            		WHERE speaker_email = ? 
            		OR speaker_phone = ?
            	";
            	$statement = $conn->prepare($sql);
            	$statement->execute([$email, $phone]);
            	if ($statement->rowCount() > 0) {
					$output = '<div class="alert alert-secondary">Your email or phone already exist!</div>';
            	} else {

	        		$file = $_FILES['profile'];
					$fileName = $file['name'];
					$fileTmpName = $file['tmp_name'];
					$fileSize = $file['size'];
					$fileError = $file['error'];
					$fileType = $file['type'];

					$fileExt = explode('.', $fileName);
					$fileActualExt = strtolower(end($fileExt));

					$allowed = array('jpg', 'jpeg', 'png');

					if (in_array($fileActualExt, $allowed)) {
						if ($fileError === 0) {
							if ($fileSize < 5000000) {
								$fileNewName = uniqid('', true).".".$fileActualExt;
								$fileDestination = 'assets/media/speaker/'.$fileNewName;
								$move_file = move_uploaded_file($fileTmpName, $fileDestination);
								
								if (!$move_file) {
					                $output = '<div class="alert alert-secondary">Picture was not able to upload, refresh page and try again.</div>';
								}

								$added_date = date("Y-m-d H:i:s");
								if (empty($output)) {								
				                    $to      = 'info@blockchainsummit.africa';
                                    $subject = 'I want to be a SPEAKER.';
                                    $body = '
                                        <html>
                                        <head>
                                           <title>Africa Blockchain Summit</title>
                                        </head>
                                        <body>
                                           <p>
                                        	    <center>
                                        	       <img src="https://blockchainsummit.africa/' . $fileDestination . '" alt="img" style="width: 150px; height: 150px; object-fit: cover;">
                                                	<h3>Full Name: </h3>
                                                	<b>'.$fullname.'</b>
                                                	<br>
                                                	<h3>Email: </h3>
                                                	<b>'.$email.'</b>
                                                	<br>
                                                	<h3>Phone: </h3>
                                                	<b>'.$phone.'</b>
                                                	<h3>Company: </h3>
                                                    <b>' . $company . '</b>
                                                    <h3>Role: </h3>
                                                    <h3>'. ucwords($role) . '</b>
                                                    <br>
                                                    <h3>Twitter: </h3>
                                                    <b>' . $titter . '</b>
                                                    <br>
                                                    <h3>LinkedIn: </h3>
                                                    <b>' . $linkedin . '</b>
                                                    <br>
                                                    <h3>Facebook: </h3>
                                                    <b>' . $facebook . '</b>
                                                    <hr>
                                                    <h3>BIO: </h3>
                                                    <br><b>' . nl2br($bio) . '</b>
                                                    <hr>
                                                    <h3>Message: </h3>
                                                    <br><b>' . nl2br($message) . '</b>
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
    					                    INSERT INTO `bsa_speaker`(`speaker_name`, `speaker_company`, `speaker_role`, `speaker_email`, `speaker_phone`, `speaker_twitter`, `speaker_linkedin`, `speaker_facebook`, `speaker_img`, `speaker_bio`, `speaker_message`, `speaker_added_date`) 
    					                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    					                ";
    					                $statement = $conn->prepare($query);
    					                $result = $statement->execute([$fullname, $company, $role, $email, $phone, $twitter, $linkedin, $facebook, $fileDestination, $bio, $message, $added_date]);
    					                if (isset($result)) {
    					                    $Subject =  "Your request to be a Speaker.";
            			                    $body = "
            			                        <center>
            			                            <h3>" . ucwords($fullname) . ",</h3>
            		                                <p>
            		                                    Africa Blockchain Summit received your request to be a speaker.
            		                                    <br>
            		                                    We will get back to you soon.
            		                                    <br><br>
            		                                    Best Regards,
            		                                    <br>
            		                                    Africa Blockchain Summit.
            			                            </p>
            			                        </center>
            			                    ";
            			                	send_email(ucwords($fullname), $email, $Subject, $body);
            			                	redirect(PROOT . 'speaker-requested');
    					                }
                                    } else {
							            $output = '<div class="alert alert-secondary">Something went wrong, try again!</div>';
                                    }
				                }
							} else {
								$output = '<div class="alert alert-secondary">Your picture is too big!</div>';
							}
						} else {
							$output = '<div class="alert alert-secondary">There was an error uploading picture!</div>';
						}
					} else {
						$output = '<div class="alert alert-secondary">You cannot upload file of this type!</div>';
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
    <title>Be a Speaker ~ Africa Blockchain Summit</title>
</head>
<body>
	
    <!-- contact -->
    <section class="py-15 py-xl-10">
      	<div class="container">
        	<div class="row justify-content-center">
          		<div class="col-lg-8 mb-5">
          			<img src="assets/media/logo/logo-sm.png" width="40" height="80" alt="ABS Logo">
            		<h2 class="fw-bold">Be a <span class="d-block">SPEAKER.</span></h2>
            		Get in touch with us directly on&nbsp;
            		<a href="mailto:info@blockchainsummit.africa?subject=BE A SPEAKER!">info@blockchainsummit.africa</span></a>
          		</div>
		        <div class="col-lg-8">
		        	<span><?= $output; ?></span>
		            <form method="POST" class="row g-3" name="be-a-speaker" enctype="multipart/form-data">
		             	<div class="col-md-12">
		                	<label for="fullname" class="form-label">Your Full Name</label>
		                	<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Full Name" value="<?= $fullname; ?>" required>
		              	</div>
		              	<div class="col-md-6">
		                	<label for="company" class="form-label">Your Company</label>
		                	<input type="text" class="form-control" id="company" name="company" value="<?= $company; ?>" placeholder="Your Company">
		              	</div>
		              	<div class="col-md-6">
		                	<label for="role" class="form-label">Role in Company</label>
		                	<input type="text" class="form-control" id="role" name="role" value="<?= $role; ?>" placeholder="Title in your compnay">
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
		                	<input type="text" class="form-control" id="twitter" name="twitter" value="<?= $twitter; ?>" placeholder="Twitter" required>
		              	</div>
		              	<div class="col-md-6">
		               		<label for="linkedin" class="form-label">LinkedIn</label>
		                	<input type="text" class="form-control" id="linkedin" name="linkedin" value="<?= $linkedin; ?>" placeholder="LinkedIn">
		              	</div>
		              	<div class="col-md-12">
		                	<label for="bio" class="form-label">BIO</label>
		                	<textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Bio ..." required><?= $bio; ?></textarea>
		                	<div class="form-text">400 words or less.</div>
		              	</div>
		              	<div class="col-md-12">
		                	<label for="profile" class="form-label">Potrait Photo</label>
		                	<input type="file" class="form-control" id="profile" name="profile" required>
		              	</div>
		              	<div class="col-md-12">
		                	<label for="message" class="form-label">Message <span class="text-muted">(Optional)</span></label>
		                	<textarea class="form-control" id="message" name="message" rows="3" placeholder="Message"><?= $message; ?></textarea>
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