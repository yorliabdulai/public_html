<?php
  
// CONNECTION TO DATABASE
require_once("../connection/conn.php");

if (!cadminIsLoggedIn()) {
    cadminLoginErrorRedirect();
}

// REQUIREMENT OF EXTERNAL FILES
include ('includes/header.inc.php');
include ('includes/top-nav.inc.php');
include ('includes/left-nav.inc.php');

// OUPUT ERRORS
$message = '';

// DECLARING VARIABLES AS EMPTY VALUE TO PREVENT ERRORS
$cont_gender = '';
$sel_election = '';

$cont_position = ((isset($_POST['cont_position']) && !empty($_POST['cont_position']))? sanitize($_POST['cont_position']) : '');
$cont_gender = ((isset($_POST['cont_gender']) && !empty($_POST['cont_gender'])) ? sanitize($_POST['cont_gender']) : '');
$cont_lname = ((isset($_POST['cont_lname']) && !empty($_POST['cont_lname'])) ? sanitize($_POST['cont_lname']) : '');
$cont_fname = ((isset($_POST['cont_fname']) && !empty($_POST['cont_fname']))? sanitize($_POST['cont_fname']) : '');
$cont_indentification = ((isset($_POST['cont_indentification']) && !empty($_POST['cont_indentification'])) ? sanitize($_POST['cont_indentification']) : '');
$sel_election = ((isset($_POST['sel_election']) && !empty($_POST['sel_election'])) ? sanitize($_POST['sel_election']):'');
$pp_path = '';
$saved_passport = '';

// FETCH ELECTIONS THAT HAS NOT YET BEEN STATED
$query = "SELECT * FROM election WHERE session = ? ORDER BY eid DESC";
$statement = $conn->prepare($query);
$statement->execute([0]);
$election_result = $statement->fetchAll();

// DELETE A CONTESTANT TEMPORARY
if (isset($_GET['deletecontestant']) && !empty($_GET['deletecontestant'])) {
    $deleteid = sanitize((int)$_GET['deletecontestant']);
    $delnoyes = $_GET['del'];

    $findContestant = $conn->query("SELECT * FROM cont_details INNER JOIN election ON election.eid = cont_details.election_name WHERE cont_details.cont_id = '".$deleteid."' AND election.session = 0 AND cont_details.del_cont = 'no'")->rowCount();
    if ($findContestant > 0) {
        if ($conn->query("UPDATE cont_details SET del_cont = '".$delnoyes."' WHERE cont_id = '".$deleteid."'"))
            $_SESSION['flash_success'] = 'Contestant Has Been Temporary <span class="bg-danger">DELETED</span>';
            echo '<script>window.location = "contestants.php"</script>';
    } else {
        $_SESSION['flash_error'] = 'Contestant was not found or cannot be deleted Temporary!';
        echo '<script>window.location = "contestants.php"</script>'; 
    }
}

// DELETE A CONTESTANT PERMANENTLY
if (isset($_GET['permanentdel']) && !empty($_GET['permanentdel'])) {
    $p_deleteid = sanitize((int)$_GET['permanentdel']);

    $findContestant = $conn->query("SELECT * FROM cont_details WHERE cont_details.cont_id = '".$p_deleteid."' AND cont_details.del_cont = 'yes'")->rowCount();
    if ($findContestant > 0) {
        // REMOVE PASSPORT PICTURE FROM uploadedprofile FOLDER
        $uploadedpp_loc = BASEURL.'media/uploadedprofile/'.$_GET['uploadedpp_name'];
        if (unlink($uploadedpp_loc)) {
            if ($conn->query("DELETE FROM cont_details WHERE cont_id = ".$p_deleteid." AND del_cont = 'yes'")) {
                $_SESSION['flash_success'] = 'Contestant Has Been Permanently <span class="bg-danger">DELETED</span>';
                echo '<script>window.location = "contestants.php?achived_contestants"</script>';
            } else {
                $_SESSION['flash_error'] = 'Something went wrong, please try again or contact System Administrator!';
                echo '<script>window.location = "contestants.php?achived_contestants"</script>';
            }
        } else {
            $_SESSION['flash_error'] = 'Could not find contestant profile picture to delete, please try again or contact System Administrator!';
            echo '<script>window.location = "contestants.php?achived_contestants"</script>';
        }
    } else {
        $_SESSION['flash_error'] = 'Contestant was not found or cannot be deleted Permanently!';
        echo '<script>window.location = "contestants.php"</script>'; 
    }
}

// RESTORE A TEMPORARY DELETED CONTESTANT
if (isset($_GET['restorecontestant']) && !empty($_GET['restorecontestant'])) {
    $restoreid = sanitize((int)$_GET['restorecontestant']);
    $restorenoyes = $_GET['restore'];

    $findContestant = $conn->query("SELECT * FROM cont_details INNER JOIN election ON election.eid = cont_details.election_name WHERE cont_details.cont_id = '".$restoreid."' AND election.session = 0 AND cont_details.del_cont = 'yes'")->rowCount();
    if ($findContestant > 0) {
        if ($conn->query("UPDATE cont_details SET del_cont = '".$restorenoyes."' WHERE cont_id = '".$restoreid."'")) {
            $_SESSION['flash_success'] = 'Contestant Has Been Successfully <span class="bg-danger">Restored</span>';
            echo '<script>window.location = "contestants.php"</script>';
        } else {
            $_SESSION['flash_success'] = 'Contestant Has Been Successfully <span class="bg-danger">Restored</span>';
            echo '<script>window.location = "contestants.php"</script>';
        }
    } else {
        $_SESSION['flash_error'] = 'Contestant was not found to be restored, either the election he/she is under is already going on or ended!';
        echo '<script>window.location = "contestants.php"</script>'; 
    }
}


// FETCH DELETED CONTESTANTS
$query = "
    SELECT * FROM cont_details 
    INNER JOIN positions 
    ON positions.position_id = cont_details.cont_position 
    LEFT JOIN election 
    ON election.eid = cont_details.election_name 
    WHERE cont_details.del_cont = ? 
    ORDER BY cont_details.cont_id DESC
";
$statement = $conn->prepare($query);
$statement->execute(['yes']);
$result = $statement->fetchAll();
$achive_contList = '';
$i = 1;
if ($statement->rowCount() > 0) {

    foreach ($result as $row) {
        $achive_contList .= '
            <tr class="text-center">
                <td>'.$i.'</td>
                <td>'.$row["cont_indentification"].'</td>
                <td>'.ucwords($row["cont_fname"].' '.$row["cont_lname"]).'</td>
                <td>'.$row["cont_gender"].'</td>
                <td>'.ucwords($row["position_name"]).'</td>
                <td>'.ucwords($row["election_name"]).' / '.ucwords($row["election_by"]).'</td>
                <td><img src="../media/uploadedprofile/'.$row["cont_profile"].'" class="img-thumbnail img-fluid" style="width: 80px; height: 80px; object-fit: cover;" alt="'.ucwords($row["cont_fname"].' '.$row["cont_lname"]).'"></td>
                <td>
                    <span class="badge badge-dark" title="Permanently Delete Contestant"><a href="contestants.php?permanentdel='.$row["cont_id"].'&uploadedpp_name='.$row["cont_profile"].'" class="text-danger"><span data-feather="trash"></span></a></span>&nbsp;
                    <span class="badge badge-dark" title="Restore Contestant"><a href="contestants.php?restorecontestant='.$row["cont_id"].'&restore='.(($row["del_cont"] == 'yes')?'no':'yes').'" class="text-success"><span data-feather="refresh-cw"></span></a></span>
                </td>
            </tr>
        ';
        $i++;
    }
} else {
    $achive_contList .= '
        <tr>
            <td colspan="8"><span class="text-muted">No Data Found!</span></td>
        </tr>
    ';
}


// FETCH CONTESTANT DETAILS FOR EDITING OR UPDATE
if (isset($_GET['editcontestant']) && !empty($_GET['editcontestant'])) {
    $editid = sanitize((int)$_GET['editcontestant']);

    $findContestant = $conn->query("SELECT * FROM cont_details INNER JOIN election ON election.eid = cont_details.election_name WHERE cont_details.cont_id = '".$editid."' AND election.session = 0 AND cont_details.del_cont = 'no'")->rowCount();
    if ($findContestant > 0) {
        $editQuery = $conn->query("SELECT * FROM cont_details WHERE cont_id = '".$editid."' LIMIT 1")->fetchAll();
        foreach ($editQuery as $sub_row) {
            $cont_indentification = ((isset($_POST['cont_indentification']) && $_POST['cont_indentification'] != '') ? sanitize($_POST['cont_indentification']):$sub_row['cont_indentification']);
            $cont_fname = ((isset($_POST['cont_fname']) && $_POST['cont_fname'] != '') ? sanitize($_POST['cont_fname']) : $sub_row['cont_fname']);
            $cont_lname = ((isset($_POST['cont_lname']) && $_POST['cont_lname'] != '') ? sanitize($_POST['cont_lname']) : $sub_row['cont_lname']);
            $cont_position = ((isset($_POST['cont_position']) && $_POST['cont_position'] != '') ? sanitize($_POST['cont_position']) : $sub_row['cont_position']);
            $cont_gender = ((isset($_POST['cont_gender']) && $_POST['cont_gender'] != '') ? sanitize($_POST['cont_gender']) : $sub_row['cont_gender']);
            $sel_election = ((isset($_POST['sel_election']) && $_POST['sel_election'] != '') ? sanitize($_POST['sel_election']) : $sub_row['election_name']);
            $saved_passport = (($sub_row['cont_profile'] != '') ? $sub_row['cont_profile'] : '');
            $pp_path = $saved_passport;
        }

        // DELETE CONTESTANT UPLOADED IMAGE ON EDITING PAGE
        if (isset($_GET['del_pp']) && !empty($_GET['contpp'])) {
            $contpp = $_GET['contpp'];
            $contpp_loc = $_SERVER['DOCUMENT_ROOT'].'/puubu/media/uploadedprofile/'.$contpp;
            if (unlink($contpp_loc)) {
                unset($contpp);
                if ($conn->query("UPDATE cont_details SET cont_profile = '' WHERE cont_id = '".$editid."'")) {
                    echo '<script>window.location = "contestants.php?editcontestant='.$editid.'"</script>';
                }
            }
        }

        // GET LIST POSITIONS FOR EDIT CONTESTANT
        $positionQuery = $conn->query("SELECT * FROM positions WHERE election_id = ".$sub_row['election_name']." ORDER BY position_name ASC")->fetchAll();
    } else {
        $_SESSION['flash_error'] = 'Contestant was not found or cannot be deleted Permanently!';
        echo '<script>window.location = "contestants.php"</script>'; 
    }
}


// CREATE NEW CONTESTANT
if (isset($_POST['createcont'])) {

    // CHECK FOR EMPTY FIELDS
    if (empty($_POST['cont_indentification']) || empty($_POST['cont_fname']) || empty($_POST['cont_lname']) || empty($_POST['cont_position']) || empty($_POST['cont_gender'])) {
        if ($_POST['uploadedPassport'] != '') {
            unlink($_POST['uploadedPassport']);
        }
        $message = '<div class="alert alert-danger">Empty Fields are Required</div>';
    } else {
        $findContestant = $conn->query("SELECT * FROM cont_details INNER JOIN election ON election.eid = cont_details.election_name WHERE cont_indentification = '".$_POST['cont_indentification']."' AND election.eid = '".$_POST['sel_election']."' AND cont_position = '".$_POST['cont_position']."'")->rowCount();
        if (isset($_GET['editcontestant']) && !empty($_GET['editcontestant'])) {
            $findContestant = $conn->query("SELECT * FROM cont_details INNER JOIN election ON election.eid = cont_details.election_name WHERE election.eid = '".(int)$_POST['sel_election']."' AND cont_indentification = '".$_POST['cont_indentification']."' AND cont_id != '".(int)$_GET['editcontestant']."'")->rowCount();
        }
        if ($findContestant > 0) {
            if (isset($_POST['uploadedPassport']) != '') {
                unlink($_POST['uploadedPassport']);
            }
            $message = '<div class="alert alert-danger">Contestant Identity No Already Exists.</div>';
        } else {
    
            // UPLOAD PASSPORT PICTURE TO uploadedprofile IF FIELD IS NOT EMPTY
            if ($_POST['cont_up_profile'] == '') {
                if ($_FILES["cont_profile"]["name"] != '') {

                    // CONTESTANT PROFILE PICTURE UPLOAD DETAILS
                    $image_test = explode(".", $_FILES["cont_profile"]["name"]);
                    $image_extension = end($image_test);
                    $image_name = uniqid('', true).".".$image_extension;

                    $location = BASEURL.'media/uploadedprofile/'.$image_name;
                    if (!move_uploaded_file($_FILES["cont_profile"]["tmp_name"], $location)) {
                        $message = 'Something went wrong uploading contestant passport picture, please refresh and try again!';
                    }
                
                    if ($_POST['uploadedPassport'] != '') {
                        unlink($_POST['uploadedPassport']);
                    }
                } else {
                    if ($_POST['uploadedPassport'] != '') {
                        unlink($_POST['uploadedPassport']);
                    }
                    $message = '<div class="alert alert-danger">Passport Picture Can not be Empty</div>';
                }
            } else {
                $image_name = $_POST['cont_up_profile'];
            }

            // INSERT DATA TO DATABASE IF ERRORS OR MESSAGES ARE EMPTY
            if ($message == '') {
                if (isset($_GET['editcontestant']) && !empty($_GET['editcontestant'])) {
                    $updateQ = "UPDATE cont_details SET cont_indentification = '".$cont_indentification."', cont_fname = '".$cont_fname."', cont_lname = '".$cont_lname."', cont_gender = '".$cont_gender."', cont_position = '".$cont_position."',  election_name = '".$sel_election."', cont_profile = '".$image_name."'  WHERE cont_id = '".(int)$_GET["editcontestant"]."'";
                    $statement = $conn->prepare($updateQ);
                    $resultQ = $statement->execute();
                    if (isset($resultQ)) {
                        $_SESSION['flash_success'] = ucwords($sub_row["cont_fname"] .' '. $sub_row["cont_lname"]) .' Contestant Successfully <span class="bg-danger">Updated</span>';
                        echo '<script>window.location = "contestants"</script>';
                    }
                } else {
                    $query = "INSERT INTO cont_details (cont_indentification, cont_fname, cont_lname, cont_gender, cont_position, election_name, cont_profile) VALUES ('".$cont_indentification."', '".$cont_fname."', '".$cont_lname."', '".$cont_gender."', '".$cont_position."',  '".$sel_election."', '".$image_name."')";
                    $statement = $conn->prepare($query);
                    $result = $statement->execute();
                    $lastinsetedID = $conn->lastinsertId();
                    if (isset($result)) {
                        $queryVoteCounts = "INSERT INTO vote_counts (results, cont_id, position_id, election_id) VALUE (:results, :cont_id, :position_id, :election_id)";
                        $statement = $conn->prepare($queryVoteCounts);
                        $statement->execute(
                            array(
                                ':results' => 0,
                                ':cont_id' => $lastinsetedID,
                                ':position_id' => $cont_position,
                                ':election_id' => $sel_election
                            )
                        );
                        $_SESSION['flash_success'] = 'A Contestant Successfully <span class="bg-danger">Created</span>';
                        echo '<script>window.location = "contestants"</script>';
                    }
                }
            } else {
                if ($_POST['uploadedPassport'] != '') {
                    unlink($_POST['uploadedPassport']);
                }
                $message;
            }
        } 
    }
}


if (isset($_GET['createcontestant']) || isset($_GET['editcontestant']) && !empty($_GET['editcontestant'])):
?>

    <!-- MAIN -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="text-white" style="font-size: 18px;">Dashboard</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="contestants.php?achived_contestants=1" class="btn btn-sm btn-info">Achive Contestants</a>
                <a href="contestants.php" class="btn btn-sm btn-outline-warning">Go Back</a>
            </div>
        </div>
    </div>

    <!-- ADD OR UPDATE CONTESTANT -->
    <div class="card">
        <div class="card-body">
            <a href="?createcontestant=1" class="text-primary float-right mb-3">
                Refresh <span data-feather="refresh-ccw" class="ml-1"></span>
            </a>
            <h4 class="header-title mt-2" style="color: rgb(170, 184, 197);"><?= ((isset($_GET['editcontestant']))?'Edit':'Add New') ?> Contestant</h4>

            <form class="" action="contestants.php?<?= ((isset($_GET['editcontestant']))?'editcontestant='.$editid:'createcontestant=1'); ?>" method="post" id="submitcontestant" enctype="multipart/form-data">
                <h1 class="text-center text-dark"></h1><hr>
                <br><br>
                <div class="container">
                    <span><?= $message; ?></span>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="cont_indentification" value="<?= $cont_indentification; ?>" placeholder="Contestant ID or Ballot No" class="form-control form-control-sm form-control-dark">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select class="form-control form-control-sm form-control-dark" name="cont_gender" id="cont_gender">
                                    <option value=""<?=(($cont_gender == '')?' selected':'');?>>Select Gender</option>
                                    <option value="male"<?=(($cont_gender == 'male')?' selected':'');?>>Male</option>
                                    <option value="female"<?=(($cont_gender == 'female')?' selected':'');?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" name="cont_fname" value="<?= $cont_fname; ?>" placeholder="Contestant First Name" class="form-control form-control-sm form-control-dark">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" name="cont_lname" value="<?= $cont_lname; ?>" placeholder="Contestant Last Name" class="form-control form-control-sm form-control-dark">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control form-control-sm form-control-dark select2getpositions" name="sel_election" id="sel_election">
                                    <option value=""<?= (($sel_election == '') ? ' selected ': ''); ?>>Select an Election</option>
                                    <?php foreach ($election_result as $election_row): ?>
                                    <option value="<?= $election_row['eid']; ?>"<?= (($sel_election == $election_row['eid']) ? ' selected': ''); ?>><?= ucwords($election_row['election_name']); ?> ~ <?= ucwords($election_row['election_by']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control form-control-sm form-control-dark" name="cont_position" id="cont_position">
                                    <?php if (isset($_GET['editcontestant'])): ?>
                                        <?php foreach($positionQuery as $prow): ?>
                                            <option value="<?= $prow['position_id']; ?>"<?= (($cont_position == $prow['position_id']) ? ' selected': ''); ?>><?= ucwords($prow['position_name']); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <?php if($saved_passport != ''): ?>
                        <label>Saved Image</label><br>
                        <img src="../media/uploadedprofile/<?= $saved_passport; ?>" class="img-fluid img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                        <a href="contestants.php?del_pp=1&editcontestant=<?=$editid;?>&contpp=<?=$saved_passport?>" class="badge badge-danger">Change Image</a><br>
                    <?php else: ?>
                        <div class="form-group">
                            <input type="file" name="cont_profile" id="cont_profile"  class="form-control form-control-sm form-control-dark">
                        </div>
                        <span id="upload_file"></span>
                    <?php endif; ?>
                    <input type="hidden" name="cont_up_profile" id="cont_up_profile" value="<?= $saved_passport; ?>">
                    <br>
                    <button type="submit" class="btn btn-dark btn-sm" id="createcont" name="createcont"><?= (isset($_GET['editcontestant']))? 'Update Contestant': 'Add Contestant'; ?></button>
                    <a href="contestants.php" class="btn btn-secondary btn-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- ACHIVE CONTESTANTS -->
    <?php elseif(isset($_GET['achived_contestants'])): ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="text-white" style="font-size: 18px;">Dashboard</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="contestants.php?createcontestant=1" class="btn btn-sm btn-outline-info">Add New Contestant</a>
                <a href="contestants.php" class="btn btn-sm btn-outline-warning">Go Back</a>
            </div>
        </div>
    </div>
    <div class="card" style="background-color: #37404a;">
        <div class="card-body">
            <a href="?achived_contestants=1" class="text-primary float-right mb-3">
                Refresh <span data-feather="refresh-ccw" class="ml-1"></span>
            </a>
            <h4 class="header-title mt-2" style="color: rgb(170, 184, 197);">Achived Contestants</h4>
            <div class="table-responsive">
                <table class="table table-sm table-nowrap table-centered table-hover mb-0" style="color: #aab8c5;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Identity Number</th>
                            <th><span data-feather="user"></span>&nbsp;|&nbsp;Full Name</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Election</th>
                            <th>Passport Pic.</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $achive_contList; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php else: ?>
    <!-- CONTESTANTS -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="text-white" style="font-size: 18px;">Dashboard</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="contestants.php?createcontestant=1" class="btn btn-sm btn-outline-info">Add New Contestant</a>
                <a href="contestants.php?achived_contestants=1" class="btn btn-sm btn-warning">Achive Contestant</a>
            </div>
        </div>
    </div>
      
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <input type="text" name="searchC" id="searchC" class="form-control-dark form-control form-control-sm" placeholder="Search for contestants here ...">
            </div>
            <a href="contestants" class="text-primary float-right mb-3">
                Refresh <span data-feather="refresh-ccw" class="ml-1"></span>
            </a>
            <div id="dynamic_content_onC"></div>
        </div>
    </div>
<?php 
    endif;
    include ('includes/main-footer.inc.php');
?>

    <!-- FOOTER -->
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/popper-1.14.6.min.js"></script>
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace()
        
        $(document).ready(function() {
            $("#temporary").fadeOut(3000);

            $('.select2getpositions').change(function() {
                if ($(this).val() != '') {
                    var action = $(this).attr("id");
                    var query = $(this).val();
                    var result = '';
                    if (action == 'sel_election') {
                      result = 'election';
                    }
                    $.ajax ({
                      url : "controller/control.select2getpositions.contenstants.php",
                        method : "POST",
                        data : {action : action, query : query},
                        success : function(data) {
                          $('#cont_position').html(data);
                        }
                    });
                  }
            });

            // Upload IMAGE Temporary Without Clicking On A Post Button On Post A Post Section
            $(document).on('change','#cont_profile', function() {
                var property = document.getElementById("cont_profile").files[0];
                var image_name = property.name;
                var image_extension = image_name.split(".").pop().toLowerCase();
                if (jQuery.inArray(image_extension, ['jpeg', 'png', 'gif', 'svg', 'jpg']) == -1) {
                    alert("Invalid Image File");
                    $('#cont_profile').val('');
                    return false;
                }
                var image_size = property.size;
                if (image_size > 22000000) {
                    alert('Image Size Is Too Big');
                    $('#cont_profile').val('');
                    return false;
                } else {
                    var form_data = new FormData();
                    form_data.append("cont_profile", property);
                    $.ajax({
                        url : "controller/tempuploadedprofile.php",
                        method : "POST",
                        data : form_data,
                        contentType : false,
                        cache: false,
                        processData : false,
                        beforeSend : function() {
                            $("#upload_file").html("<div class='text-primary font-weight-bolder'>Uploading contestant picture ...</div>");
                        },
                        success: function(data) {
                            $("#upload_file").html(data);
                            $("#cont_profile").css('display', 'none');
                        }
                    });
                }
            });

            // DELETE TEMPORARY UPLOADED IMAGES
            $(document).on('click', '.removeImg', function() {
                var tempuploded_file_id = $(this).attr('id');
              
                $.ajax ({
                    url : "controller/deltempimguploaded.php",
                    method : "POST",
                    data : {
                        tempuploded_file_id : tempuploded_file_id
                    },
                    success: function(data) {
                        $('#removeTempuploadedFile').remove();
                        $('#cont_profile').val('');
                        $("#cont_profile").css('display', 'block');
                    }
                });
            });

            // SEARCH AND PAGINATION FOR CONTESTANTS
            function load_data(page, query = '') {
                $.ajax({
                    url : "controller/contol.search.contestants.php",
                    method : "POST",
                    data : {
                        page : page, 
                        query : query
                    },
                    success : function(data) {
                        $("#dynamic_content_onC").html(data);
                    }
                });
            }

            load_data(1);
            $('#searchC').keyup(function() {
                var query = $('#searchC').val();
                load_data(1, query);
            });

            $(document).on('click', '.page-link-go', function() {
                var page = $(this).data('page_number');
                var query = $('#searchC').val();
                load_data(page, query);
            });

            
        });
    </script>
</body>
</html>
