<?php

include ("../connection/conn.php");
include ("inc/header.inc.php");

$title = ((isset($_POST['title']) && !empty($_POST['title'])) ? sanitize($_POST['title']) : '');
$price = ((isset($_POST['price']) && !empty($_POST['price'])) ? sanitize($_POST['price']) : '');
$list = ((isset($_POST['list']) && !empty($_POST['list'])) ? $_POST['list'] : '');

// EDIT
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = sanitize((int)$_GET['edit']);

    $find_ticket = $conn->query("SELECT * FROM bfc_ticket WHERE id = '".$edit_id."' LIMIT 1")->rowCount();
    if ($find_ticket > 0) {
        $get_ticket = $conn->query("SELECT * FROM bfc_ticket WHERE id = '".$edit_id."' LIMIT 1")->fetchAll();
        foreach ($get_ticket as $row) {
            $title = ((isset($_POST['title']) && !empty($_POST['title'])) ? sanitize($_POST['title']) : $row['ticket_title']);
            $price = ((isset($_POST['price']) && !empty($_POST['price'])) ? sanitize($_POST['price']) : $row['ticket_price']);
            $list = ((isset($_POST['list']) && !empty($_POST['list'])) ? $_POST['list'] : $row['ticket_list']);
        }
    } else {
        echo js_alert("Ticket was not Found!");
    }
}

// ADD SPEAKER
if (isset($_POST['submit'])) {
    if (!empty($title) || $title != '') {
        if (!empty($list) || $list != '') {

            $added_date = date("Y-m-d H:i:s");
            
            if (isset($_GET['edit']) && !empty($_GET['edit'])) {
                $query = "
                    UPDATE `bfc_ticket` SET `ticket_title` = ? , `ticket_price` = ?, `ticket_list` = ? WHERE id = ?
                ";
                $statement = $conn->prepare($query);
                $result = $statement->execute([$title, $price, $list, $edit_id]);
            } else {
                $query = "
                    INSERT INTO `bfc_ticket`(`ticket_title`, `ticket_price`, `ticket_list`, `ticket_date_added`) VALUES (?, ?, ?, ?)
                ";
                $statement = $conn->prepare($query);
                $result = $statement->execute([$title, $price, $list, $added_date]);
            }
            if (isset($result)) {
                $_SESSION['flash_success'] = 'Ticket ' . (isset($_GET['edit']) ? 'Updated' : 'Added') . '!';
                redirect(PROOT . 'absummit@admin/tickets');
            }
        }
    }
}

// FETCH ALL SPEAKERS
$query = "
    SELECT * FROM bfc_ticket 
    ORDER BY bfc_ticket.ticket_price ASC";
$statement = $conn->prepare($query);
$statement->execute();
$ticket_count = $statement->rowCount();
$ticket_result = $statement->fetchAll();

// DELETE TICKET
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = sanitize((int)$_GET['delete']);
    
    $find_ticket = $conn->query("SELECT * FROM bfc_ticket WHERE id = '".$id."' LIMIT 1")->rowCount();
    if ($find_ticket > 0) {
        $query = "
            DELETE FROM bfc_ticket WHERE id = ? 
        ";
        $statement = $conn->prepare($query);
        $result = $statement->execute([$id]);
        if (isset($result)) {
            $_SESSION['flash_success'] = 'TIcket deleted!';
            redirect(PROOT . 'absummit@admin/tickets');
        }
    } else {
        echo js_alert('Invalid Ticket');
    }
}

?>

    <div class="container mt-4">
        <h2><?= (isset($_GET['edit']) && !empty($_GET['edit']) ? 'Edit' : 'Add'); ?> Ticket</h2>
        <form method="POST" action="tickets.php<?= ((isset($_GET['edit']) && !empty($_GET['edit'])) ? '?edit='.$edit_id : ''); ?>">
            <?= $flash; ?>
            <div class="mb-2">
                <label for="name">Title</label>
                <input type="text" class="form-control form-control-sm" name="title" autofocus value="<?= $title; ?>" required>
            </div>
            <div class="mb-2">
                <label for="price">Price</label>
                <input type="number" min="0" step="0.01" class="form-control form-control-sm" name="price" value="<?= $price; ?>" required>
            </div>
            <div class="mb-2">
                <label for="list">List</label>
                <textarea type="text" class="form-control" rows="6" name="list" required><?= $list; ?></textarea>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-dark btn-sm"><?= (isset($_GET['edit']) && !empty($_GET['edit']) ? 'Edit' : 'Add'); ?></button>
            <?php if (isset($_GET['edit']) && !empty($_GET['edit'])): ?>
                <a href="<?= PROOT; ?>absummit@admin/tickets" class="btn btn-outline-dark btn-sm"><< go back</a>
            <?php endif ?>
        </form>
        <hr>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>TITLE</th>
                    <th>PRICE</th>
                    <th>LIST</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ticket_count > 0): ?>
                    <?php $i = 1; foreach ($ticket_result as $ticket): ?>
                    <tr>
                        <td>
                            <a href="<?= PROOT; ?>absummit@admin/tickets?edit=<?= $ticket["id"]; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                        </td>
                        <td><?= ucwords($ticket['ticket_title']); ?></td>
                        <td><?= money_symbol('$ ', $ticket['ticket_price']); ?></td>
                        <td><?= nl2br($ticket['ticket_list']); ?></td>
                        <td>
                            <button type="button" onclick="confirm('Ticket will be deleted.') ? window.location = '<?= PROOT; ?>absummit@admin/tickets?delete=<?= $ticket["id"]; ?>' : 'return false';"; class="btn btn-secondary btn-sm">delete</button>
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
