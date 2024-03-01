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

// OUTPUT ERRORS
$message = '';

$sel_election = '';
$position_name = ((isset($_POST['position_name'])?$_POST["position_name"]:''));
$sel_election = ((isset($_POST['sel_election']) && !empty($_POST['sel_election']))?sanitize($_POST['sel_election']):'');

// GET ELECTION
$electionQuery = $conn->query("SELECT * FROM election WHERE election.session = 0 ORDER BY election.election_name ASC")->fetchAll();$statement->fetchAll();

// DELETE A POSITION NAME FROM DATABASE
if (isset($_GET['deleteposition']) && !empty($_GET['deleteposition'])) {
    $delete_id = sanitize((int)$_GET['deleteposition']);

    $findPosition = $conn->query("SELECT * FROM positions INNER JOIN election ON election.eid = positions.election_id WHERE position_id = '".$delete_id."' AND election.session = 0")->fetchAll();
    if ($findPosition > 0) {
        if ($conn->query("DELETE FROM positions WHERE position_id = '".$delete_id."'")) {
            $_SESSION['flash_success'] = 'Position Name Has Been Successfully Deleted';
            echo "<script>window.location = 'positions';</script>";
        }
    } else {
        $_SESSION['flash_error'] = 'Position was not found to be deleted!';
        echo '<script>window.location = "positions";</script>';
    }
}

// EDIT POSITION
if (isset($_GET['editposition'])) {
    $edit_id = sanitize((int)$_GET['editposition']);

    $findPosition = $conn->query("SELECT * FROM positions INNER JOIN election ON election.eid = positions.election_id WHERE position_id = '".$edit_id."' AND election.session = 0")->rowCount();
    if ($findPosition > 0) {
        foreach ($conn->query("SELECT * FROM positions WHERE position_id = '".$edit_id."'")->fetchAll() as $_row) {
          $position_name = ((isset($_row['position_name']) ? $_row['position_name'] : $_POST["position_name"]));
          $sel_election = ((isset($_POST['sel_election']) && $_POST['sel_election'] != '') ? sanitize($_POST['sel_election']) : $_row['election_id']);
        }
    } else {
        $_SESSION['flash_error'] = 'Position was not found to be edited!';
        echo '<script>window.location = "positions";</script>';
    }
}

// LIST POSITIONS
$positionsList = '';
foreach ($conn->query("SELECT * FROM positions INNER JOIN election WHERE positions.election_id = election.eid ORDER BY position_id DESC")->fetchAll() as $row) {
    $editOption = '';
    $deleteOption = '';
    if ($row["session"] == 0) {
        $editOption = '
            <span class="badge badge-secondary"><a href="?editposition='.$row["position_id"].'" class="text-primary"><i data-feather="edit"></i></a></span>
        ';
        $deleteOption = '
            <span class="badge badge-secondary"><a href="?deleteposition='.$row["position_id"].'&election='.$row["election_id"].'" class="text-warning"><i data-feather="trash"></i></a></span>&nbsp; 
        ';
    } else if ($row["session"] == 1) {
        $editOption = ' <span class="badge badge-danger">running ...</span>';
    } else if ($row["session"] == 2) {
        $editOption = ' <span class="badge badge-danger">ended</span>';
    }
    $positionsList .= '
        <tr class="text-center">
            <td>
                ' .$editOption. '
            </td>
            <td>'.ucwords($row["position_name"]).'</td>
            <td>'.ucwords($row["election_name"]).' ~ '.ucwords($row["election_by"]).'</td>
            <td>
                ' .$deleteOption. '
            </td>
        </tr>';
  }


// INSERT IN POSITION TO DATABASE
if (isset($_POST['addposition'])) {
    if (empty($_POST['position_name']) || empty($_POST['sel_election'])) {
        $message = '<div class="alert alert-danger" id="temporary">Empty Fields are Required</div>';
    } else {

        $query = "SELECT * FROM positions WHERE position_name = '".$_POST['position_name']."' AND election_id = '".$_POST['sel_election']."'";
        if (isset($_GET['editposition']) && !empty($_GET['editposition'])) {
            $query = "SELECT * FROM positions WHERE position_id = '".$_GET['editposition']."' AND position_id != '".(int)$_GET['editposition']."'";
        }
        $statement = $conn->prepare($query);
        $statement->execute();

        if($statement->rowCount() > 0) {
            $message = '<div class="alert alert-danger" id="temporary">This Position Name Already Exists</div>';
        } else {
            if ($message == '') {

                if (isset($_GET['editposition']) && !empty($_GET['editposition'])) {
                    $update = "UPDATE positions SET position_name = '".$_POST['position_name']."', election_id = '".$_POST['sel_election']."' WHERE position_id = '".(int)$_GET['editposition']."'";
                    $statement = $conn->prepare($update);
                    $resultu = $statement->execute();

                    if (isset($resultu)) {
                        $_SESSION['flash_success'] = 'Position Name Successfully Updated';
                        echo "<script>window.location = 'positions';</script>";
                    }
                } else {
                    $query = "INSERT INTO positions (position_name, election_id) VALUES ('".$_POST['position_name']."', '".$_POST['sel_election']."')";
                    $statement = $conn->prepare($query);
                    $result = $statement->execute();
                    if (isset($result)) {
                        $_SESSION['flash_success'] = 'Position Name Successfully Added';
                        echo "<script>window.location = 'positions';</script>";
                    }
                }
            }

        }
    }
}

?>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="text-white" style="font-size: 18px;">Dashboard</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="index" class="btn btn-sm btn-outline-secondary">Go Back</a>
            </div>
            <a href="contestants" class="btn btn-sm btn-dark">Contestants</a>
        </div>
    </div>


    <div class="card">
        
        <div class="card-body">
            <a href="javascript:;" class="btn btn-sm btn-link float-right mb-3">Export <span data-feather="download-cloud" class="ml-1"></span></a>
            <h4 class="header-title mt-2" style="color: rgb(170, 184, 197);"><?= ((isset($_GET['editposition'])?'Edit':'Add')); ?> Position Name</h4>
            <form action="positions?<?= ((isset($_GET['editposition']))?'editposition='.$edit_id:'addnewposition=1'); ?>" method="post">
                <div class="container">
                    <span><?= $message; ?></span>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md">
                                    <select class="form-control form-control-sm form-control-dark" name="sel_election" id="sel_election">
                                        <option value=""<?=(($sel_election == '')?' selected':'');?>>Select Election Name</option>
                                        <?php foreach ($electionQuery as $election_row): ?>
                                            <option value="<?=$election_row['eid'];?>"<?= (($sel_election == $election_row['eid']) ? ' selected' : ''); ?>><?= ucwords($election_row['election_name']); ?> ~ <?= ucwords($election_row['election_by']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <input type="text" name="position_name" value="<?= $position_name; ?>" placeholder="<?= ((isset($_GET["editposition"]))?'Edit':'Add'); ?> Position Name" class="form-control form-control-sm form-control-dark">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-dark btn-sm" name="addposition"><?= ((isset($_GET["editposition"]))?'Edit':'Add'); ?> Position</button>
                            <?php if(isset($_GET['editposition'])): ?>
                                <a href="positions" class="btn btn-danger btn-sm">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="container">
                <table class="table table-hover table-dark table-bordered table-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Election</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $positionsList; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


     <!-- FOOTER -->
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/popper-1.14.6.min.js"></script>
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= PROOT; ?>172.06.84.0/media/files/feather.min.js"></script>
    <script>
        feather.replace();

        $(document).ready(function() {
            $("#temporary").fadeOut(3000);
        });
    </script>
</body>
</html>

