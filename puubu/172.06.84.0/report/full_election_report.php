<?php 

	require_once ("../../connection/conn.php");
	require ('../fpdf/fpdf.php');

	ob_start();

	if (isset($_GET['election']) && !empty($_GET['election'])) {
		$election_id = sanitize((int)$_GET['election']);
		// code...
		$query = "
	        SELECT * FROM election 
	        WHERE eid = ? 
	        AND session = ? 
	        LIMIT 1
	    ";
	    $statement = $conn->prepare($query);
	    $statement->execute([$election_id, 2]);
	    $report_result = $statement->fetchAll();
	    $count_report = $statement->rowCount();

		if ($count_report > 0) {
	    	foreach ($report_result as $report_row) {

				$election = ucwords($report_row['election_name']) . ' ~ ' . ucwords($report_row['election_by']);
				$electionId = $report_row['eid'];
				
				class PDF extends FPDF {

					function Header() {
						$year = date("Y") . "/";
						$nextYear = date("Y") + 1; 
						$fontFamily = 'Helvetica';
						$this->SetFont($fontFamily, 'B', 16);
						$this->SetFillColor(120,280,0);
						$this->SetDrawColor(120,280,190);
						$this->SetTextColor(220,150,50);
						$this->Cell(0,10,'Puubu Report ' . $year.$nextYear,1,0,'C');
						$this->Ln(15);
					}


					function Footer() {
						$this->SetFont("Arial","I",10);
						$this->Cell(190,0,'','T',1,'',true);
						$copyright = 'Copyright © 2020 by Puubu Group.';
						$this->Cell(0,10,$copyright,0,0,'C');
						$this->Ln(8);
						$this->Cell(0,10,'Page ' . $this->PageNo() . " of {AllPages}",0,0,'C');
					}

				
				}

				$pdf = new PDF();

				$pdf->AliasNbPages('{AllPages}');

				$pdf->AddPage();

				$pdf->SetTitle("Report for election");

				$pdf->SetAutoPageBreak(true,15);

				$pdf->SetFont('Arial','',9);

				$pdf->SetDrawColor(50,50,100);

				$pdf = new PDF();
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont('Times','',12);

				$height = 5;

				// GET THE NUMBER OF REGISTRARS
				$registrarsQ = "
					SELECT * FROM registrars 
					INNER JOIN election 
					ON election.eid = registrars.election_type 
					WHERE  registrars.election_type = ? 
					AND election.eid = ?
				";
				$statement = $conn->prepare($registrarsQ);
				$statement->execute([$election_id, $election_id]);
				$voteTurnOut = $statement->rowCount();


				// GET THE NUMBER OF REGISTRARS WHO VOTED
				$sql = "
					SELECT * FROM voterhasdone 
					WHERE election_id = ?
				";
	            $statement = $conn->prepare($sql);
	            $statement->execute([$electionId]);
	            $countNumberVotes = $statement->rowCount();

				$voteTurnOutTxt = strtoupper($election . "  (Registered voters: " . $voteTurnOut . ", Number of registrars who voted: ".$countNumberVotes.")");

				$pdf->SetFont('Arial','B', 9);
				$pdf->Cell(0,10,$voteTurnOutTxt,1,1,'C');

				$positionQ = "SELECT * FROM positions WHERE election_id = ?";
				$statement = $conn->prepare($positionQ);
				$statement->execute([$election_id]);
				$positionResult = $statement->fetchAll();

				//Need to get a number to cycle through the candidates 
				foreach ($positionResult as $row) {

					$PositionName = strtoupper($row['position_name']) . ' - Skipped votes: ' . $row['position_skipped_votes'] . ' (' . round(($row['position_skipped_votes']/$countNumberVotes) * 100,0,PHP_ROUND_HALF_UP) .'%)';
					$pdf->SetFont('Arial','BU',9);
					$pdf->Cell(0,10,$PositionName,1,1,'C');
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(63,10,'Contestant',0,0);
					$pdf->SetX(70);
					$pdf->Cell(64,10,'Picture',0,0);
					$pdf->SetX(170);
					$pdf->Cell(63,10,'Votes',0,1);
					$pdf->SetFont('Arial','',9);
					$pdf->Ln(5);

					$sql8 = "
						SELECT COUNT(*) count_pc FROM cont_details 
						WHERE cont_position = :cont_position 
						AND del_cont = :del_cont
					";
			     	$statement = $conn->prepare($sql8);
			     	$statement->execute(
			            [
			                ':cont_position' => (int)$row['position_id'],
			                ':del_cont' => 'no'
			            ]
			        );
			        $sql8_count = $statement->rowCount();
			        $sql8_result = $statement->fetchAll();

					$votecountQ = "
						SELECT * FROM vote_counts 
						INNER JOIN cont_details 
						ON cont_details.cont_id = vote_counts.cont_id 
						WHERE vote_counts.election_id = ? 
						AND vote_counts.position_id = ? 
						AND cont_details.del_cont = ?
					";
					$statement = $conn->prepare($votecountQ);
					$statement->execute([$election_id, $row['position_id'], 'no']);
					$votecountResult = $statement->fetchAll();
					foreach ($votecountResult as $counts) {

						$ContName = ucwords($counts['cont_fname'] .' '. $counts['cont_lname']);
						$ContID = strtoupper($counts['cont_indentification']) .' | ';
						$ContResult = $counts['results'];
						$ContResultNO = $counts['results_no'];

						$pdf->Cell(64,0,$ContID.$ContName,0,0);

						$pdf->Cell(63,0,$pdf->Image('https://puubu.blockchainsummit.africa/media/uploadedprofile/'.$counts['cont_profile'],$pdf->GetX(),$pdf->GetY(),20,22.5),0,0,'R');
						foreach ($sql8_result as $row8) {
						 	if ($row8['count_pc'] > 1) {
							    $pdf->Cell(63,0,$ContResult . ' out of ' . $countNumberVotes . ' (' . round(($ContResult/$countNumberVotes) * 100,0,PHP_ROUND_HALF_UP) .'%)',0,0,'R');
						 	} else {
								$pdf->Cell(63,0,'Yes Votes: '.$ContResult . ' out of ' . $countNumberVotes . ' (' . round(($ContResult/$countNumberVotes) * 100,0,PHP_ROUND_HALF_UP) .'%)',0,0,'R');
								$pdf->Ln(10);
								$pdf->Cell(190,0,'No Votes: '.$ContResultNO . ' out of ' . $countNumberVotes . ' (' . round(($ContResultNO/$countNumberVotes) * 100,0,PHP_ROUND_HALF_UP) .'%)',0,0,'R');
						 	}
						}

						$pdf->Ln(40);

					}
					$pdf->Ln(15);
				}
				$pdf->Output();
			}
		} else {
			header('Location: ../reports?report=1&election='.$_GET["election"].'');
		}
				
	}
	ob_end_flush();

