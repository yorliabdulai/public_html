<?php 

	// SEARCH FOR REGISTRARS

	// DATABASE CONNECTION
	require_once("../../connection/conn.php");

	$limit = 10;
	$page = 1;

	if ($_POST['page'] > 1) {
		$start = (($_POST['page'] - 1) * $limit);
		$page = $_POST['page'];
	} else {
		$start = 0;
	}

	$query = "SELECT * FROM registrars INNER JOIN election ON election.eid = registrars.election_type ";
	if ($_POST['query'] != '') {
		$query .= 'WHERE std_fname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR std_lname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR std_id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	}
	$query .= 'GROUP BY id ORDER BY std_fname ASC ';

	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$statement = $conn->prepare($query);
	$statement->execute();
	$total_data = $statement->rowCount();

	$statement = $conn->prepare($filter_query);
	$statement->execute();
	$result = $statement->fetchAll();

	$output = ' 
		<h4 class="header-title mt-2" style="color: rgb(170, 184, 197);">List Of Voters - '.$total_data.'</h4>
		<div class="table-responsive">
			<table class="table table-nowrap table-sm table-centered table-hover mb-0" style="color: #aab8c5;">
				<thead>
					<tr>
						<th>#</th>
			            <th>Identity Number</th>
			            <th>Full Name</th>
			            <th>Email</th>
			            <th>Send Mail</th>
			            <th>Election Type</th>
			            <th>
			              	<span id="delete_checkedDisplay" style="display: none;">
			                	<button type="button" name="delete_checked" id="delete_checked" class="btn btn-sm btn-danger">delete All</button> <label>Select All <input type="checkbox" id="selectAll"></label>
			              	</span>
			            </th>
					</tr>
        		</thead>
        		<tbody>
	';

	if ($total_data > 0) {
		$i = 1;
		$count = 0;
		foreach ($result as $row) {
		    $count++;
			$option = '';
			if ($row["session"] == 0) {
				$option = '
					<span class="badge badge-dark"><a href="?deletevoter='.$row["id"].'" class="text-danger"><span data-feather="trash"></span></a></span>
					&nbsp;
	                <span class="badge badge-dark"><a href="?editvoter='.$row["id"].'"><span data-feather="edit-3"></span></a></span>
	                <input type="checkbox" class="checkToDelete" value="'.$row["id"].'" style="display: none;">
				';
			}
			$output .= '
				<tr>
                    <td>'.$i.'</td>
                    <td>'.strtoupper($row["std_id"]).'</td>
                    <td>'.ucwords(strtolower($row["std_fname"].' '.$row["std_lname"])).' <span class="text-'.(($row['status'] == '1')?'success':'danger').'" data-feather="'.(($row['status'] == '1')?'check':'x').'"></span></td>
                    <td>'.$row["std_email"].'</td>
                    <td>
                    	<input type="checkbox" name="single_select" class="single_select" data-email="'.$row["std_email"].'" data-password="'.$row["std_password"].'">&nbsp;&nbsp;&nbsp;
                    	<span name="email_button" class="badge badge-dark text-warning email_button" id="'.$count.'" data-email="'.$row["std_email"].'" data-password="'.$row["std_password"].'" data-action="single" style="cursor: pointer;">Send</span>
                    </td>
                    <td>
                    	'.ucwords($row['election_name']).' ~ '.ucwords($row['election_by']).'
                    </td>
                    <td>
                      '.$option.'
                    </td>
				</tr>
			';
			$i++;
		}
		$output .= '
				<tr>
      				<td colspan="5" align="right">
      					<button type="button" name="bulk_email" class="btn btn-sm btn-warning email_button" id="bulk_email" data-action="bulk">Send bulk</button>
      				</td>
     			</td>';

	} else {
		$output .= '
			<tr class="text-warning">
				<td colspan="7">No data found!</td>
			</tr>
		';
	}
	$output .= '
        		</tbody>
			</table>
		</div>
		<br>';

	if ($total_data > 0) {
		$output .= '<div align="center">
			<ul class="pagination">
		';
		$total_links = ceil($total_data / $limit);

		$previous_link = '';
		$next_link = '';
		$page_link = '';

		if ($total_links > 4) {
			if ($page < 5) {
				for ($count = 1; $count <= 5; $count++) {
					$page_array[] = $count;
				}
				$page_array[] = '...';
				$page_array[] = $total_links;
			} else {
				$end_limit = $total_links - 5;
				if ($page > $end_limit) {
					$page_array[] = 1;
					$page_array[] = '...';

					for ($count = $end_limit; $count <= $total_links; $count++) {
						$page_array[] = $count;
					}
				} else {
					$page_array[] = 1;
					$page_array[] = '...';
					for ($count = $page - 1; $count <= $page + 1; $count++) {
						$page_array[] = $count;
					}
					$page_array[] = '...';
					$page_array[] = $total_links;
				}
			}
		} else {
			for ($count = 1; $count <= $total_links; $count++) {
				$page_array[] = $count;
			}
		}

		for ($count = 0; $count < count($page_array); $count++) {
			if ($page == $page_array[$count]) {
				$page_link .= '
					<li class="page-item active">
						<a class="page-link" href="javascript:;">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
					</li>
				';

				$previous_id = $page_array[$count] - 1;
				if ($previous_id > 0) {
					$previous_link = '
						<li class="page-item">
							<a class="page-link page-link-go" href="javascript:;" data-page_number="'.$previous_id.'">Previous</a>
						</li>
					';
				} else {
					$previous_link = '
						<li class="page-item disabled">
							<a class="page-link page-link-go" href="javascript:;">Previous</a>
						</li>
					';
				}

				$next_id = $page_array[$count] + 1;
				if ($next_id >= $total_links) {
					$next_link = '
						<li class="page-item disabled">
							<a class="page-link page-link-go" href="javascript:;">Next</a>
						</li>
					';
				} else {
					$next_link = '
						<li class="page-item">
							<a class="page-link page-link-go" href="javascript:;" data-page_number="'.$next_id.'">Next</a>
						</li>
					';
				}

			} else {
				
				if ($page_array[$count] == '...') {
					$page_link .= '
						<li class="page-item disabled">
							<a class="page-link" href="javascript:;">...</a>
						</li>
					';
				} else {
					$page_link .= '
						<li class="page-item">
							<a class="page-link page-link-go" href="javascript:;" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a>
						</li>
					';
				}
			}

		}

		$output .= $previous_link. $page_link . $next_link;
	}
	echo $output;




 ?>

    <script type="text/javascript" src="media/files/feather.min.js"></script>
    <script type="text/javascript">
      feather.replace();
    </script>