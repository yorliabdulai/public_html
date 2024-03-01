<?php

	include ("../connection/conn.php");

	if (isset($_POST['id'])) {
		$id = sanitize((int)$_POST['id']);
		if (is_numeric($id)) {
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
				echo $row[0]['ticket_price'];
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}