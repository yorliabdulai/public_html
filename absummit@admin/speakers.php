<?php

include ("../connection/conn.php");
include ("inc/header.inc.php");

// FETCH ALL SPEAKERS
$query = "SELECT * FROM bsa_speaker ORDER BY speaker_name ASC";
$statement = $conn->prepare($query);
$statement->execute();
$speaker_count = $statement->rowCount();
$speaker_result = $statement->fetchAll();

// DELETE SPEAKER
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = sanitize((int)$_GET['delete']);
    
    $find_speaker = $conn->query("SELECT * FROM bsa_speaker WHERE id = '".$id."' LIMIT 1")->rowCount();
    if ($find_speaker > 0) {
        $get_speaker = $conn->query("SELECT * FROM bsa_speaker WHERE id = '".$id."' LIMIT 1")->fetchAll();
        foreach ($get_speaker as $row) {
            if ($row['speaker_img'] != '') {
                $filename = BASEURL . $row['speaker_img'];
                unlink($filename);
            }
            $query = "
                DELETE FROM bsa_speaker WHERE id = ? 
            ";
            $statement = $conn->prepare($query);
            $result = $statement->execute([$id]);
            if (isset($result)) {
                $_SESSION['flash_success'] = 'Speaker deleted!';
                redirect(PROOT . 'absummit@admin/speakers');
            }
        }
    } else {
        echo js_alert('Invalid Email');
    }
}

// Add/Remove Speaker
if (isset($_GET['ar']) && ($_GET['status'] == 0 || $_GET['status'] == 1)) {
    $id = sanitize((int)$_GET['ar']);
    $status = sanitize((int)$_GET['status']);
    if ($conn->query("SELECT * FROM bsa_speaker WHERE id = $id")->rowCount() > 0 ) {
        $update = "
            UPDATE bsa_speaker 
            SET be_a_speaker = ?
            WHERE id = ?
        ";
        $statement = $conn->prepare($update);
        $result = $statement->execute([$status, $id]);
        if ($result) {
            $_SESSION['flash_success'] = (($status == 0) ? 'Removed' : 'Added') . ' Speaker!';
            redirect(PROOT . 'absummit@admin/speakers');
        } else {
            js_alert('Something went wrong!');
            redirect(PROOT . 'absummit@admin/speakers?id=' . $id);
        }
    } else {
        $_SESSION['flash_error'] = 'Speaker not Found!';
        redirect(PROOT . 'absummit@admin/speakers?id=' . $id);
    }
}


?>
    <div class="container mt-4">
        <h2><?= ((isset($_GET['id']) && !empty($_GET['id'])) ? 'Speaker' : 'Speaker(s)') ?></h2>
        <a href="<?= PROOT; ?>be-a-speaker" style="float: right; color: #000;">Add Speaker</a>
        <?= $flash; ?>

        <?php 
            if (isset($_GET['id']) && !empty($_GET['id'])): 
                $id = sanitize((int)$_GET['id']);
                $sql = "
                    SELECT * FROM bsa_speaker 
                    WHERE id = ? 
                    LIMIT 1
                ";
                $statement = $conn->prepare($sql);
                $statement->execute([$id]);
                $row_count = $statement->rowCount();
                $row = $statement->fetchAll();

                if ($row_count > 0) {
        ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="">
                    <div class="card-body">
                        <img src="<?= PROOT . $row[0]["speaker_img"]; ?>" alt="<?= $speaker['speaker_name']; ?> image" class="img-thumbnail">
                        <p class="lead">
                            <small>Name: </small>
                            <b style="float: right;"><?= ucwords($row[0]['speaker_name']); ?></b>
                            <br>
                            <small>Email: </small>
                            <b style="float: right;"><?= $row[0]['speaker_email']; ?></b>
                            <br>
                            <small>Phone: </small>
                            <b style="float: right;"><?= $row[0]['speaker_phone']; ?></b>
                            <br>
                            <small>Company: </small>
                            <b style="float: right;"><?= ucwords($row[0]['speaker_company']); ?></b>
                            <br>
                            <small>Role: </small>
                            <b style="float: right;"><?= ucwords($row[0]['speaker_role']); ?></b>
                            <br>
                            <small>Twitter: </small>
                            <b style="float: right;"><?= $row[0]['speaker_twitter']; ?></b>
                            <br>
                            <small>LinkedIn: </small>
                            <b style="float: right;"><?= $row[0]['speaker_linkedin']; ?></b>
                            <br>
                            <small>Facebook: </small>
                            <b style="float: right;"><?= $row[0]['speaker_facebook']; ?></b>
                            <hr>
                            <small>BIO: </small>
                            <br><b><?= nl2br($row[0]['speaker_bio']); ?></b>
                            <hr>
                            <small>Message: </small>
                            <br><b><?= nl2br($row[0]['speaker_message']); ?></b>
                            <hr>
                            
                            <small>Date: </small>
                            <b style="float: right;"><?= pretty_date_only($row[0]['speaker_added_date']); ?></b>
                            <br>
                            <hr>
                            <!-- ar = add or remove -->
                            <a href="speakers?ar=<?= $row[0]['id']; ?>&status=<?= (($row[0]['be_a_speaker'] == 1) ? 0 : 1); ?>" class="btn btn-sm btn-outline-<?= (($row[0]['be_a_speaker'] == 1) ? 'danger' : 'dark'); ?>"><?= (($row[0]['be_a_speaker'] == 1) ? 'Remove Speaker' : 'Add Speaker'); ?></a>
                            <a href="speakers" style="float: right; text-decoration: none;" class="text-secondary"><< Go back</a>
                        </p>
                </div>
            </div>
        </div>
        <?php
                } else {
                    $_SESSION['flash_error'] = 'Speaker not Found!';
                    redirect(PROOT . 'absummit@admin/speakers');
                }
        ?>
        <?php else: ?>
        <table class="table table-xs table-warning">
            <thead>
                <tr>
                    <th></th>
                    <th>PROFILE</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>DATE</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($speaker_count > 0): ?>
                    <?php $i = 1; foreach ($speaker_result as $speaker): ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><img src="<?= PROOT . $speaker['speaker_img']; ?>" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;"></td>
                        <td><?= ucwords($speaker['speaker_name']); ?></td>
                        <td><?= $speaker['speaker_email']; ?></td>
                        <td><?= pretty_date_only($speaker['speaker_added_date']); ?></td>
                        <td>
                            <span class="badge bg-<?= ($speaker['be_a_speaker'] == 1) ? 'success' : ''; ?>">
                                <?= ($speaker['be_a_speaker'] == 1) ? 'confirmed' : ''; ?>
                            </span>
                        </td>
                        <td>
                            <a href="?id=<?= $speaker['id']; ?>" class="btn btn-light btn-sm">View</a>
                            <button type="button" onclick="confirm('Speaker will be deleted.') ? window.location = '<?= PROOT; ?>absummit@admin/speakers?delete=<?= $speaker["id"]; ?>' : 'return false';"; class="btn btn-secondary btn-sm">delete</button>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No data found.</td>
                    </tr>
                <?php endif ?>
                
            </tbody>
        </table>
        <?php endif; ?>
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
