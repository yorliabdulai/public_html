<?php

	// Connection To Database
	$servername = 'sdb-61.hosting.stackcp.net';
	$username = 'puubu123-353032375127';
	$password = '43ldy04e8g';
	$conn = new PDO("mysql:host=$servername;dbname=puubu123-353032375127", $username, $password);
	session_start();

    date_default_timezone_set('Africa/Accra');
    require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once(BASEURL.'helpers/helpers.php');

 	// GRAP VISITOR OR USER INFO
 	require_once (BASEURL . 'vendor/autoload.php');
	use ipinfo\ipinfo\IPinfo;

	$access_token = IPINFO_PRIVATE_KEY;
	$client = new IPinfo($access_token);
	$details = $client->getDetails();

	// $page = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
	// $page .= iif(!empty($_SERVER['QUERY_STRING']), "?{$_SERVER['QUERY_STRING']}", "");
 // 	$referrer = $_SERVER['HTTP_REFERER'];

	// $user_visitor_query = "
	// 	INSERT INTO puubu_election_logs (election_logs_election_id, election_logs_description, election_logs_page, election_logs_referrer) 
	// 	VALUE ()
	// ";


 	if (isset($_SESSION['crAdmin'])) {
 		$data = array(
 			':c_aid' => (int)$_SESSION['crAdmin']
 		);
 		$sql = "SELECT * FROM puubu_admin WHERE c_aid = :c_aid LIMIT 1";
 		$statement = $conn->prepare($sql);
 		$statement->execute($data);

 		foreach ($statement->fetchAll() as $row) {
 			$fullName = ucwords($row['cfname'] . ' ' . $row['clname']);
 			$lName = ucwords($row['clname']);
 			$fname = ucwords($row['cfname']);
 		}
 	}

 	if (isset($_SESSION['voter_accessed'])) {
 		// code...
	 	$voterId = $_SESSION['voter_accessed'];
		$voterQuery = "
		    SELECT * FROM registrars 
		    INNER JOIN election 
		    ON election.eid = registrars.election_type 
		    WHERE registrars.id = ? 
		    AND election.eid = registrars.election_type
		    LIMIT 1
		";
		$statement = $conn->prepare($voterQuery);
		$statement->execute([$voterId]);
		$voter_count = $statement->rowCount();
		$voter_result = $statement->fetchAll();
 	}


 	// Display on Messages on Errors And Success
 	if (isset($_SESSION['flash_success'])) {
 	 	echo '<div class="bg-success" id="temporary" style="margin-top: 60px; color: #fff;"><p class="text-center">'.$_SESSION['flash_success'].'</p></div>';
 	 	unset($_SESSION['flash_success']);
 	 }

 	 if (isset($_SESSION['flash_error'])) {
 	 	echo '<div class="bg-danger" id="temporary" style="margin-top: 60px; color: #fff;"><p class="text-center">'.$_SESSION['flash_error'].'</p></div>';
 	 	unset($_SESSION['flash_error']);
 	 }




?>
