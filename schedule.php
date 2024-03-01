<?php

require_once ('connection/conn.php');

$title = 'Schedule';
$nav_color = 'navbar-light';
$btn_outline_light = 'light';
include ('inc/head.php');

// fetch all schedule days
$sql = "
    SELECT * FROM abs_schedule_days 
    ORDER BY schedule_day ASC
";
$statement = $conn->prepare($sql);
$statement->execute();
$schedule_day_rows = $statement->fetchAll();
$schedule_day_count = $statement->rowCount();

// fetch all schedule lead
// $leadQuery = "
//     SELECT *, abs_schedule.id AS schedule_id 
//     FROM abs_schedule 
//     INNER JOIN abs_schedule_days 
//     ON abs_schedule_days.id = abs_schedule.schedule_day 
//     INNER JOIN bsa_speaker
//     ON bsa_speaker.id = abs_schedule.lead
//     ORDER BY abs_schedule.schedule_time
// ";
// $statement = $conn->prepare($leadQuery);
// $statement->execute();
// $count_row = $statement->rowCount();
// $rows = $statement->fetchAll();


?>
    
    <section class="py-20 bg-light">
        <div class="container foreground">
            <div class="row mb-5 justify-content-between align-items-end">
                <div class="col mb-2 mb-md-0">
                    <h2 class="lh-1 text-color">Schedule</h2>
                </div>
                <div class="col-auto">
                    <ul class="nav nav-pills" id="myTab" role="tablist">
                        <?php if ($schedule_day_count > 0): ?>
                            <?php foreach ($schedule_day_rows as $schedule_day_row): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?= (($schedule_day_row["id"] == 1 ) ? 'active' : ''); ?>" id="schedule_<?= $schedule_day_row["id"]; ?>-tab" data-bs-toggle="tab" data-bs-target="#schedule_<?= $schedule_day_row["id"]; ?>" type="button" role="tab" aria-controls="schedule_<?= $schedule_day_row["id"]; ?>" aria-selected="true"><?= pretty_date_week_name_dm($schedule_day_row["schedule_day"]); ?></button>
                                </li>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <?php 
                            foreach ($schedule_day_rows as $schedule_day_row):
                                $leadQuery = "
                                    SELECT *, abs_schedule.id AS schedule_id, abs_schedule_days.id AS day  
                                    FROM abs_schedule 
                                    INNER JOIN abs_schedule_days 
                                    ON abs_schedule_days.id = abs_schedule.schedule_day 
                                    WHERE abs_schedule.schedule_day = ? 
                                    AND abs_schedule.parent = ?
                                    ORDER BY abs_schedule.schedule_time
                                ";
                                $statement = $conn->prepare($leadQuery);
                                $statement->execute([$schedule_day_row['id'], 0]);
                                $count_row = $statement->rowCount();
                                $rows = $statement->fetchAll();
                        ?>
                        <div class="tab-pane fade <?= (($schedule_day_row["id"] == 1 ) ? 'active show' : ''); ?>" id="schedule_<?= $schedule_day_row["id"]; ?>" role="tabpanel" aria-labelledby="schedule_<?= $schedule_day_row["id"]; ?>-tab">
                            <div class="card bg-white">
                                <div class="accordion accordion-classic" id="accordion-1">

                                    <?php foreach ($rows as $row): ?>
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="heading-1-<?= $row["schedule_id"]; ?>">
                                                <div class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapse-1-<?= $row["schedule_id"]; ?>" aria-expanded="false" aria-controls="collapse-1-<?= $row["schedule_id"]; ?>">
                                                    <div class="d-flex flex-wrap align-items-center w-100">
                                                        <div class="col-3 col-md-2 text-secondary fs-lg"><?= date("H:i", strtotime($row['schedule_time'])); ?></div>
                                                        <div class="col-9 col-md-7 fs-lg"><?= ucwords($row['schedule_title']); ?></div>
                                                        <!-- <div class="d-none d-md-block col-md-3 text-md-end pt-1 pt-md-0"> -->
                                                        <div class="col-md-3 text-md-end pt-1 pt-md-0">
                                                            <ul class="avatar-list">
                                                                <?php foreach($conn->query("SELECT *, abs_schedule.id AS schedule_id FROM abs_schedule INNER JOIN bsa_speaker ON bsa_speaker.id = abs_schedule.lead WHERE abs_schedule.schedule_day = '".$row['day']."' AND abs_schedule.schedule_title = '".$row['schedule_title']."'")->fetchAll() as $speaker_row): ?>
                                                                <li>
                                                                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="<?= ucwords($speaker_row['speaker_name'] . ' / ' . $speaker_row['speaker_company']); ?>">
                                                                        <img src="<?= PROOT . $speaker_row['speaker_img']; ?>" class="rounded-circle" alt="Avatar" style="width: 100%; height: 100%;">
                                                                    </span>
                                                                </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse-1-<?= $row["schedule_id"]; ?>" class="accordion-collapse collapse" aria-labelledby="heading-1-<?= $row["schedule_id"]; ?>" data-bs-parent="#accordion-1">
                                                <div class="accordion-body">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="col-md-10">
                                                            <p class="text-secondary"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include ('inc/foot.php'); ?>