<?php

include ("../connection/conn.php");
include ("inc/header.inc.php");

$title = ((isset($_POST['title']) && !empty($_POST['title'])) ? sanitize($_POST['title']) : '');
$price = ((isset($_POST['price']) && !empty($_POST['price'])) ? sanitize($_POST['price']) : '');
$list = ((isset($_POST['list']) && !empty($_POST['list'])) ? $_POST['list'] : '');

// FETCH ALL PURCHASES
$query = "
    SELECT * FROM bfc_fiat_purchase 
    ORDER BY bfc_fiat_purchase.purchase_datetime DESC";
$statement = $conn->prepare($query);
$statement->execute();
$purchase_count = $statement->rowCount();
$purchase_result = $statement->fetchAll();

if (isset($_GET['q'])) {
	// code...
	$query = sanitize($_GET['s']);

	$sql = "
		SELECT * FROM bfc_fiat_purchase 
		WHERE purchase_reference = ? 
		OR purchase_reference = ?
		OR purchase_reference = ?
		OR purchase_reference = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([]);
	$statement->fetchAll();
	$statement->rowCount();

}

?>

    <div class="container mt-4">
    	<a href="purchases" class="btn-sm btn btn-outline-secondary">All</a>
    	<a href="with-fiat" class="btn-sm btn btn-outline-dark">FIAT</a>
    	<a href="with-crypto" class="btn-sm btn btn-outline-dark">CRYPTO</a>
    	<div class="mb-5"></div>
    	<form action="">
    		<input type="search" name="q" class="form-control" placeholder="Search">
    	</form>
    	<div class="mb-5"></div>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>Reference</th>
                    <th>Email</th>
                    <th>Ticket Type</th>
                    <th>Number of Tickets</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($purchase_count > 0): ?>
                    <?php $i = 1; foreach ($purchase_result as $purchase): ?>
                    <tr>
                        <td>
                            <a href="<?= PROOT; ?>bfca@min/tickets?edit=<?= $purchase["id"]; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                        </td>
                        <td><?= $purchase['purchase_reference']; ?></td>
                        <td><?= $purchase['purchase_email']; ?></td>
                        <td><?= ucwords($purchase['purchase_ticket_type']); ?></td>
                        <td><?= $purchase['purchase_number_of_tickets']; ?></td>
                        <td><?= money_symbol('$ ', $purchase['purchase_total_amt']); ?></td>
                        <td><?= pretty_date($purchase['purchase_datetime']); ?></td>
                        <td>
                            <button type="button" onclick="confirm('Ticket will be deleted.') ? window.location = '<?= PROOT; ?>bfca@min/tickets?delete=<?= $purchase["id"]; ?>' : 'return false';"; class="btn btn-secondary btn-sm">delete</button>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No data found.</td>
                    </tr>
                <?php endif; ?>
                
            </tbody>
        </table>
    </div>
    <script src="<?= PROOT; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/vendor.bundle.js"></script>
    <script src="<?= PROOT; ?>assets/js/index.bundle.js"></script>

    <script>
        $(document).ready(function() {
            $("#temporary").fadeOut(3000)
        });
    </script>
</body>
</html>
