<?php 
	// SUBSCRIBE 
	
	include ("../connection/conn.php");

	if (isset($_POST['email'])) {
		$email = sanitize($_POST['email']);
		$output = '';

		$select = "
			SELECT * FROM bfs_subscription 
			WHERE subscription_email = :subscription_email 
			LIMIT 1
		";
		$statement = $conn->prepare($select);
		$statement->execute(['subscription_email' => $email]);
		$row_count = $statement->rowCount();

		if ($row_count > 0) {
			$output = 'This email '. $email . ' has already subscribed';
		} else {
			$query = "
				INSERT INTO bfs_subscription (subscription_email) 
				VALUES (:subscription_email)
			";
			$statement = $conn->prepare($query);
			$result = $statement->execute([':subscription_email' => $email]);
			if ($result) {
				$to = $email;
                $subject = "Daily Update Subscription.";
                $body = "
                    <h3>Hello
                        {$to},</h3>
                        <p>
                            Thank you for subscribing to Africa Blockchain Summit. You will be recieving notifications on dialy updates, and more.
                        </p>
                        <p>
							Sincerely, <br>
							Africa Blockchain Summit.
                        </p>
                ";

				$mail_result = send_email($to, $to, $subject, $body);
				if ($mail_result) {
					$output = 'Email subscribed successfully';
                } else {
                    echo "Message could not be sent.";
                }
			}
		}
		echo $output;

	}









?>