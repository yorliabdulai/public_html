<?php

	// Connection To Database
	$servername = 'sdb-h.hosting.stackcp.net';
	$username = 'absummit-313836df72';
	$password = 'oajxvfdw15';
	$conn = new PDO("mysql:host=$servername;dbname=absummit-313836df72", $username, $password);


	function getBrowserAndOs() {

	    $user_agent = $_SERVER['HTTP_USER_AGENT'];
	    $browser = "N/A";

	    $browsers = array(
	        '/msie/i' => 'Internet explorer',
	        '/firefox/i' => 'Firefox',
	        '/safari/i' => 'Safari',
	        '/chrome/i' => 'Chrome',
	        '/edge/i' => 'Edge',
	        '/opera/i' => 'Opera',
	        '/mobile/i' => 'Mobile browser'
	    );

	    foreach ($browsers as $regex => $value) {
	        if (preg_match($regex, $user_agent)) { $browser = $value; }
	    }

	    $visitor_agent_division = explode("(", $user_agent)[1];
	    list($os, $division_two) = explode(")", $visitor_agent_division);

	    $refferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

	    $visitor_broswer_os = array(
	        'browser' => $browser,
	        'operatingSystem' => $os,
	        'refferer' => $refferer
	    );

	    $output = json_encode($visitor_broswer_os);

	    return $output;
	}


	session_start();
	date_default_timezone_set("Africa/Accra");


	require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
 	require_once(BASEURL.'helpers/helpers.php');



////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// ADMIN LOGIN
 	if (isset($_SESSION['IQNadmin'])) {
 		$admin_id = $_SESSION['IQNadmin'];
 		$data = array(
 			':admin_id' => $admin_id
 		);
 		$sql = "
 			SELECT * FROM inqoins_admin 
 			WHERE admin_id = :admin_id 
 			LIMIT 1
 		";
 		$statement = $conn->prepare($sql);
 		$statement->execute($data);

 		foreach ($statement->fetchAll() as $admin_data) {
 			$admin_fullname = ucwords($admin_data['admin_fullname']);
 			$fn = explode(' ', $admin_data['admin_fullname']);
 			$admin_data['first'] = ucwords($fn[0]);
 			$admin_data['last'] = '';
 			if (count($fn) > 1) {
 				$admin_data['last'] = ucwords($fn[1]);
 			}
 		}
 	}

 	$flash = '';
 	if (isset($_SESSION['flash_success'])) {
 	 	$flash = '<div class="bg-success" id="temporary"><p class="text-center text-white">'.$_SESSION['flash_success'].'</p></div>';
 	 	unset($_SESSION['flash_success']);
 	}

 	if (isset($_SESSION['flash_error'])) {
 	 	$flash = '<div class="bg-danger" id="temporary"><p class="text-center text-white">'.$_SESSION['flash_error'].'</p></div>';
 	 	unset($_SESSION['flash_error']);
 	}




 	//Conference
    $get_conference = $conn->query("SELECT * FROM bfc_conference WHERE id = 1 LIMIT 1")->fetchAll();
    foreach ($get_conference as $row) {
        $head = $row['conference_title'];
        $city = $row['conference_city'];
        $country = $row['conference_country'];
        $from = $row['conference_from'];
        $to =  $row['conference_to'];
        $month = $row['conference_month'];
        $year = $row['conference_year'];
        $address = $row['conference_address'];
    }


?>
