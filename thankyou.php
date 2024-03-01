<?php 

include ("connection/conn.php");

if (isset($_SESSION['last_id'])) {
    $id = (int)$_SESSION['last_id'];
    $sql = "
        SELECT * FROM abs_registration WHERE id = ? 
        LIMIT 1
    ";
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);
    $result = $statement->fetchAll();
    if (isset($result)) {
        unset($_SESSION['last_id']);
        $register_id = $result[0]['registration_identity'];
    } else {
        session_destroy();
        redirect('register');
    }
} else {
    session_destroy();
    redirect('register');
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  
    <link rel="shortcut icon" href="<?= PROOT; ?>assets/logo/logo-sm.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/libs.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/index.bundle.css" />
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bfc.css" />
    <title>Register ~ Africa Blockchain Summit</title>
</head>
<body>
	
    <!-- contact -->
    <section class="py-15 py-xl-10">
      	<div class="container">
        	<div class="row justify-content-center">
          		<div class="col-lg-8 mb-5">
          			<img src="<?= PROOT; ?>assets/media/logo/logo-sm.png" width="40" height="80" alt="ABS Logo">
            		<h2 class="fw-bold">Hey, <span class="d-block"><?= ucwords($result[0]['registration_full_name']); ?>.</span></h2>
            		Your have successfully registered your details to be part of the Africa Blockchain Summit 2023. <br>NB: Save the Entering code below for the day of the event it will be required.
                    <br><br>Entering id: <h3><?= $register_id; ?></h3>
            		<br>For any futher quries contact&nbsp;
            		<a href="mailto:speaker@bitfreesummit.africa?subject=BE A SPEAKER!">info@ablockchainsummit.africa</span></a>
		            <br><br>
		            <a href="<?= PROOT; ?>index"><< go home</a>
            		<br>
            		<br>
            		<small class="text-muted">We'll never share your details with anyone else.</small>
          		</div>
		    </div>
		</div>
	</section>
</body>
</html>