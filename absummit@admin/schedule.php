<?php

include ("../connection/conn.php");
include ("inc/header.inc.php");

// add schedule day
$day = ((isset($_POST['schedule_day']) && !empty($_POST['schedule_day'])) ? sanitize($_POST['schedule_day']) : '');
if (isset($_POST['submit_schedule_day'])) {
    $query = "
        INSERT INTO abs_schedule_days (schedule_day) 
        VALUES (?)
    ";
    if (isset($_GET['edit_day']) && !empty($_GET['edit_day'])) {
        // code...
        $query = "
            UPDATE abs_schedule_days 
            SET schedule_day = ? 
            WHERE id = '" . (int)$_GET['edit_day'] . "'
        ";
    }
    $statement = $conn->prepare($query);
    $result = $statement->execute([$day]);
    if ($result) {
        $_SESSION['flash_success'] = 'Day '. (isset($_GET['edit_day']) ? 'edited' : 'added').' to Schedule successfully';
        redirect(PROOT . 'absummit@admin/schedule');
    }
}

// edit days
if (isset($_GET['edit_day']) && !empty($_GET['edit_day'])) {
    $edit_id = sanitize((int)$_GET['edit_day']);

    $find_ticket = $conn->query("SELECT * FROM abs_schedule_days WHERE id = '".$edit_id."' LIMIT 1")->rowCount();
    if ($find_ticket > 0) {
        $get_day = $conn->query("SELECT * FROM abs_schedule_days WHERE id = '".$edit_id."' LIMIT 1")->fetchAll();
        foreach ($get_day as $row) {
            $day = ((isset($_POST['schedule_day']) && !empty($_POST['schedule_day'])) ? sanitize($_POST['schedule_day']) : $row['schedule_day']);        }
    } else {
        echo js_alert("Day was not Found!");
    }
}

// delete day
if (isset($_GET['delete_day']) && !empty($_GET['delete_day'])) {
    $id = (int)$_GET['delete_day'];

    $deleteQuery = "
        DELETE FROM abs_schedule_days 
        WHERE id = ?
    ";
    $statement = $conn->prepare($deleteQuery);
    $result = $statement->execute([$id]);

    if ($result) {
         $deleteQuery = "
            DELETE FROM abs_schedule 
            WHERE schedule_day = ?
        ";
        $statement = $conn->prepare($deleteQuery);
        $statement->execute([$id]);

        $_SESSION['flash_success'] = 'Schedule day deleted!';
        redirect(PROOT . 'absummit@admin/schedule');
    } else {
        $_SESSION['flash_error'] = 'Something went wrong, please try again!';
        redirect(PROOT . 'absummit@admin/schedule');
    }

}

// add schedule lead
$lead_day = ((isset($_POST['lead_day']) && !empty($_POST['lead_day'])) ? sanitize($_POST['lead_day']) : '');
$schedule_time = ((isset($_POST['schedule_time']) && !empty($_POST['schedule_time'])) ? sanitize($_POST['schedule_time']) : '');
$schedule_title = ((isset($_POST['schedule_title']) && !empty($_POST['schedule_title'])) ? sanitize($_POST['schedule_title']) : '');
$schedule_lead = ((isset($_POST['schedule_lead']) && !empty($_POST['schedule_lead'])) ? sanitize($_POST['schedule_lead']) : '');
if (isset($_POST['submit_schedule_lead'])) {
    $day = date($day);
    
    $parentSql = "
        SELECT * FROM abs_schedule WHERE schedule_title = ? 
        LIMIT 1
    ";
    $statement = $conn->prepare($parentSql);
    $statement->execute([$schedule_title]);
    $parent_row = $statement->fetchAll();
    $parent = 0;
    if ($statement->rowCount() > 0) {
        $parent = $parent_row[0]['id'];
    }
    if (isset($_GET['edit_lead']) && !empty($_GET['edit_lead'])) {
        $query = "
            UPDATE abs_schedule SET schedule_day = ?, schedule_time = ?, schedule_title = ?, lead = ?, parent = ?  
            WHERE id = '" . (int)$_GET['edit_lead'] . "' 
        ";
    } else {
        $query = "
            INSERT INTO `abs_schedule`(`schedule_day`, `schedule_time`, `schedule_title`, `lead`, `parent`)  
            VALUES (?, ?, ?, ?, ?)
        ";
    }
    $statement = $conn->prepare($query);
    $result = $statement->execute([$lead_day, $schedule_time, $schedule_title, $schedule_lead, $parent]);
    if ($result) {
        $_SESSION['flash_success'] = 'Lead '. ((isset($_GET['edit_lead'])) ? 'edited' : 'added') .' to Schedule successfully';
        redirect(PROOT . 'absummit@admin/schedule?lead=1');
    }
}

// edit lead
if (isset($_GET['edit_lead']) && !empty($_GET['edit_lead'])) {
    $edit_id = sanitize((int)$_GET['edit_lead']);

    $find_ticket = $conn->query("SELECT * FROM abs_schedule WHERE id = '".$edit_id."' LIMIT 1")->rowCount();
    if ($find_ticket > 0) {
        $get_day = $conn->query("SELECT *, abs_schedule.id AS schedule_id, bsa_speaker.id AS speaker_id, abs_schedule_days.id AS day_id FROM abs_schedule INNER JOIN abs_schedule_days ON abs_schedule_days.id = abs_schedule.schedule_day INNER JOIN bsa_speaker ON bsa_speaker.id = abs_schedule.lead WHERE abs_schedule.id = '".$edit_id."' LIMIT 1")->fetchAll();
        foreach ($get_day as $edit_lead_row) {
            $lead_day = ((isset($_POST['lead_day']) && !empty($_POST['lead_day'])) ? sanitize($_POST['lead_day']) : $edit_lead_row['schedule_day']);        
            $schedule_time = ((isset($_POST['schedule_time']) && !empty($_POST['schedule_time'])) ? sanitize($_POST['schedule_time']) : $edit_lead_row['schedule_time']);        
            $schedule_title = ((isset($_POST['schedule_title']) && !empty($_POST['schedule_title'])) ? sanitize($_POST['schedule_title']) : $edit_lead_row['schedule_title']);
            $schedule_lead = ((isset($_POST['schedule_lead']) && !empty($_POST['schedule_lead'])) ? sanitize($_POST['schedule_lead']) : $edit_lead_row['lead']);
        }
    } else {
        echo js_alert("Lead was not Found!");
    }
}

// fetch all lead
$speakerSql = "
    SELECT * FROM bsa_speaker 
    ORDER BY speaker_name ASC
";
$statement = $conn->prepare($speakerSql);
$statement->execute();
$speaker_rows = $statement->fetchAll();

// fetch all schedule lead
$leadQuery = "
    SELECT *, abs_schedule.id AS schedule_id 
    FROM abs_schedule 
    INNER JOIN abs_schedule_days 
    ON abs_schedule_days.id = abs_schedule.schedule_day 
    INNER JOIN bsa_speaker
    ON bsa_speaker.id = abs_schedule.lead
    ORDER BY abs_schedule.schedule_time
";
$statement = $conn->prepare($leadQuery);
$statement->execute();
$lead_count = $statement->rowCount();
$lead_result = $statement->fetchAll();

// fetch all schedule days
$sql = "
    SELECT * FROM abs_schedule_days 
    ORDER BY schedule_day ASC
";
$statement = $conn->prepare($sql);
$statement->execute();
$schedule_day_row = $statement->fetchAll();
$schedule_day_count = $statement->rowCount();



?>

    <div class="container-fluid mt-4">
        <?= $flash; ?>
        <h2>Schedule<?= (isset($_GET['lead']) && !empty($_GET['lead']) ? ', Add Lead' : ''); ?></h2>
        <div class="row">
            <div class="col-md-4">
            <?php if (isset($_GET['lead'])): ?>
                <form action="schedule.php?lead=1<?= ((isset($_GET['edit_lead']) && !empty($_GET['edit_lead'])) ? '&edit_lead='. (int)$_GET['edit_lead'] : ''); ?>" method="POST">
                    <div class="mb-4">
                        <select name="lead_day" id="" class="form-control" required>
                           <?= ((isset($_GET['edit_lead']) && !empty($_GET['edit_lead'])) ? '<option value="'.$edit_lead_row["day_id"].'">' . pretty_date_week_name_dm($edit_lead_row['schedule_day']) . '</option>' . $schedule_lead : ''); ?>
                           <option value="">Day</option> 
                            <?php foreach ($schedule_day_row as $day_row): ?>
                                <option value="<?= $day_row['id']; ?>"><?= pretty_date_week_name_dm($day_row['schedule_day']); ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="name">Time</label>
                        <input type="time" class="form-control form-control-sm" name="schedule_time" value="<?= $schedule_time; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="name">Title</label>
                        <input type="text" class="form-control form-control-sm" name="schedule_title" value="<?= $schedule_title; ?>" required>
                    </div>

                    <div class="mb-4">
                        <select name="schedule_lead" id="" class="form-control">
                            <?= ((isset($_GET['edit_lead']) && !empty($_GET['edit_lead'])) ? '<option value="'.$edit_lead_row["speaker_id"].'">' . ucwords($edit_lead_row['speaker_name'] . ' / ' . $edit_lead_row['speaker_company']) . '</option>' . $schedule_lead : ''); ?>
                            <option>Lead</option>
                            <?php foreach ($speaker_rows as $speaker_row): ?>
                                <option value="<?= $speaker_row['id']; ?>"><?= $speaker_row['speaker_name'] . ' / ' . $speaker_row['speaker_company']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-dark" name="submit_schedule_lead"><?= (isset($_GET['edit_lead']) && !empty($_GET['edit_lead']) ? 'Edit' : 'Add'); ?> Lead</button>
                    <?php if (isset($_GET['edit_lead']) && !empty($_GET['edit_lead'])): ?>
                        <a href="<?= PROOT; ?>absummit@admin/schedule?lead=1" class="btn btn-outline-dark"><< Cancel</a>
                    <?php endif ?>
                </form>
            <?php else: ?>
                <form method="POST" action="schedule.php<?= ((isset($_GET['edit_day']) && !empty($_GET['edit_day'])) ? '?edit_day=' . (int)$_GET['edit_day'] : ''); ?>">
                    <div class="mb-4">
                        <label for="name">Date</label> <span class="text-primary"><?= (isset($_GET['edit_day']) ? 'Was: ' . pretty_date_week_name_dm($day) : ''); ?></span>
                        <input type="date" class="form-control" name="schedule_day" required>
                    </div>
                    <button class="btn btn-dark" name="submit_schedule_day"><?= (isset($_GET['edit_day']) && !empty($_GET['edit_day']) ? 'Edit' : 'Add'); ?> Day</button>
                    <?php if (isset($_GET['edit_day']) && !empty($_GET['edit_day'])): ?>
                        <a href="<?= PROOT; ?>absummit@admin/schedule" class="btn btn-outline-dark btn-sm"><< Cancel</a>
                    <?php endif ?>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($schedule_day_count > 0): ?>
                                <?php foreach ($schedule_day_row as $row_day): ?>
                                    <tr>
                                        <td>
                                            <a href="?edit_day=<?= $row_day['id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
                                        </td>
                                        <td><?= pretty_date_week_name_dm($row_day['schedule_day']); ?></td>
                                        <td>
                                            <a href="?delete_day=<?= $row_day['id']; ?>" class="btn btn-sm btn-dark">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </form>
            <?php endif ?>
            </div>
            <div class="col-md-8">
                <div class="mb-4">
                    <a href="?lead=1" class="btn btn-secondary">Add lead</a>
                    <?php if (isset($_GET['lead'])): ?>
                        <a href="<?= PROOT; ?>absummit@admin/schedule" class="btn btn-light"><< Cancel</a>
                    <?php endif ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Title</th>
                            <th>Lead(s)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lead_count > 0): ?>
                            <?php $i = 1; foreach ($lead_result as $lead_row): ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= pretty_date_week_name_dm($lead_row['schedule_day']); ?></td>
                                    <td><?= $lead_row['schedule_time']; ?></td>
                                    <td><?= $lead_row['schedule_title'] ?></td>
                                    <td><?= ucwords($lead_row['speaker_name'] . ' / ' . $lead_row['speaker_company']); ?></td>
                                    <td>
                                        <a href="<?= PROOT; ?>absummit@admin/schedule?lead=1&edit_lead=<?= $lead_row['schedule_id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
                                        <a href="<?= PROOT; ?>absummit@admin/schedule?lead=1&delete_lead=<?= $lead_row['schedule_id']; ?>" class="btn btn-sm btn-dark">Delete</a>
                                    </td>
                                </tr>
                            <?php $i++; endforeach ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
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
