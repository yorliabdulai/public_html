<?php

include ("../connection/conn.php");
include ("inc/header.inc.php");



$title = ((isset($_POST['title']) && !empty($_POST['title'])) ? sanitize($_POST['title']) : '');
$city = ((isset($_POST['city']) && !empty($_POST['city'])) ? sanitize($_POST['city']) : '');
$country = ((isset($_POST['country']) && !empty($_POST['country'])) ? $_POST['country'] : '');
$from = ((isset($_POST['from']) && !empty($_POST['from'])) ? $_POST['from'] : '');
$to = ((isset($_POST['to']) && !empty($_POST['to'])) ? $_POST['to'] : '');
$month = ((isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : '');
$year = ((isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : '');
$address = ((isset($_POST['address']) && !empty($_POST['address'])) ? $_POST['address'] : '');


$get_conference = $conn->query("SELECT * FROM bfc_conference WHERE id = 1 LIMIT 1")->fetchAll();
foreach ($get_conference as $row) {
    $title = ((isset($_POST['title']) && !empty($_POST['title'])) ? sanitize($_POST['title']) : $row['conference_title']);
    $city = ((isset($_POST['city']) && !empty($_POST['city'])) ? sanitize($_POST['city']) : $row['conference_city']);
    $country = ((isset($_POST['country']) && !empty($_POST['country'])) ? $_POST['country'] : $row['conference_country']);
    $from = ((isset($_POST['from']) && !empty($_POST['from'])) ? $_POST['from'] : $row['conference_from']);
    $to = ((isset($_POST['to']) && !empty($_POST['to'])) ? $_POST['to'] : $row['conference_to']);
    $month = ((isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : $row['conference_month']);
    $year = ((isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : $row['conference_year']);
    $address = ((isset($_POST['address']) && !empty($_POST['address'])) ? $_POST['address'] : $row['conference_address']);
}
 

// UPDATE CONFERENCE
if (isset($_POST['submit'])) {
    if (!empty($title) || $title != '') {
        if (!empty($city) || $city != '') {
            if (!empty($country) || $country != '') {
                if (!empty($from) || $from != '') {
                    if (!empty($to) || $to != '') {
                        if (!empty($month) || $month != '') {
                            if (!empty($year) || $year != '') {
                                $query = "
                                    UPDATE bfc_conference 
                                    SET `conference_title` = ? , `conference_city` = ?, `conference_country` = ?, `conference_from` = ?, `conference_to` = ?, `conference_month` = ?, `conference_year` = ?, `conference_address` = ? 
                                    WHERE id = ?
                                ";
                                $statement = $conn->prepare($query);
                                $result = $statement->execute([$title, $city, $country, $from, $to, $month, $year, $address,  1]);
                            
                                if (isset($result)) {
                                    $_SESSION['flash_success'] = 'Conference Updated!';
                                    redirect(PROOT . 'bfca@min/index');
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


?>


    <div class="container">
        <h2>Conference</h2>
        <form method="POST" action="index.php">
            <?= $flash; ?>
            <div class="mb-2">
                <label for="title">Title</label>
                <input type="text" class="form-control form-control-sm" name="title" autofocus value="<?= $title; ?>" required>
            </div>
            <div class="mb-2">
                <label for="month">Month</label>
                <select name="month" id="month" class="form-control form-control-sm" required>
                    <option value="">..</option>
                    <?php for($m=1; $m<=12; ++$m): ?>
                    <option <?= ($month == $m) ? 'selected' : ''; ?>><?= date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="from">From</label>
                <select name="from" id="from" class="form-control form-control-sm" required>
                    <option value="">..</option>
                    <?php for ($i=1; $i < 32; $i++): ?>
                    <option <?= ($from == $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="to">To</label>
                <select name="to" id="to" class="form-control form-control-sm" required>
                    <option value="">..</option>
                    <?php for ($i=1; $i < 32; $i++): ?>
                    <option <?= ($to == $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="year">Year</label>
                <input type="number" class="form-control form-control-sm" id="year" name="year" min="<?= date('Y'); ?>" max="2099" step="1" value="<?= $year; ?>" required>
            </div>
            <div class="mb-2">
                <label for="city">City</label>
                <input type="text" class="form-control form-control-sm" name="city" value="<?= $city; ?>" required>
            </div>
            <div class="mb-2">
                <label for="country">Country</label>
                <input type="text" class="form-control form-control-sm" name="country" value="<?= $country; ?>" required>
            </div>
            <div class="mb-2">
                <label for="country">Address</label>
                <textarea type="text" class="form-control form-control-sm" name="address" required><?= $address; ?></textarea>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-dark btn-sm">Update</button>
        </form>
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
