<?php

include ("connection/conn.php");

$title = 'Speakers';
$nav_color = 'navbar-dark';
$btn_outline_light = 'white';
include ('inc/head.php');

// SPEAKERS
$speakerQuery = "
    SELECT * FROM bsa_speaker 
    WHERE be_a_speaker = ?
    ORDER BY bsa_speaker.speaker_name ASC";
$statement = $conn->prepare($speakerQuery);
$statement->execute([1]);
$count_speaker = $statement->rowCount();
$speaker_result = $statement->fetchAll();

?>

  
    <!-- speakers -->
    <section class="py-15 py-xl-20 bg-primary inverted">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold text-color">Meet the speakers.</h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a href="be-a-speaker" class="action underline text-white">Want to be a SPEAKER?<i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="row g-2 g-lg-5">
                <?php if ($count_speaker > 0): ?>
                    <?php foreach ($speaker_result as $speaker): ?>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                            <a href="javascript:;" title="<?= $speaker["speaker_url"]; ?>" class="card card-hover-gradient inverted equal-1-1 equal-lg-3-4">
                                <div class="card-wrap">
                                    <div class="card-footer text-shadow mt-auto">
                                        <h5 class="mb-0"><?= ucwords($speaker['speaker_name']); ?></h5>
                                        <span class="text-muted"><?= ucwords($speaker['speaker_company']); ?> <br> <?= ucwords($speaker['speaker_role']); ?></span>
                                    </div>
                                </div>
                                <figure class="background" style="background-image: url('<?= PROOT . $speaker['speaker_img']; ?>')"></figure>
                            </a>
                            <br>
                            <?= (($speaker["speaker_twitter"] != '') ? '<a href="'.$speaker["speaker_twitter"].'" target="_blank"><i class="bi bi-twitter fs-5"></i></a>': ''); ?>&nbsp;
                            <?= (($speaker["speaker_linkedin"] != '') ? '<a href="'.$speaker["speaker_linkedin"].'" target="_blank"><i class="bi bi-linkedin fs-5"></i></a>': ''); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php include ('inc/foot.php'); ?>