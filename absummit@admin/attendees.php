<?php 
    
    // SUBSCRIPTIONS

    include ("../connection/conn.php");
    include ("inc/header.inc.php");

    // if (!admin_is_logged_in()) {
    //     admn_login_redirect();
    // }

?>

	<div class="container mt-4">
        <h2>Attendees</h2> <hr>

        <!-- Example single danger button -->
        <form action="export" method="POST">
            <div class="row">
                <input type="hidden" name="from" value="attendee">
                <div class="col">
                    <select name="data" id="" class="form-control" required>
                        <option value=""></option>
                        <option value="All">All</option>
                        <option value="From a friend">From a friend</option>
                        <option value="Noones">Noones</option>
                        <option value="Metis Africa">Metis Africa</option>
                        <option value="Fedi">Fedi</option>
                        <option value="School of Pharmacy (UG)">School of Pharmacy (UG)</option>
                        <option value="SRC (UG)">SRC (UG)</option>
                        <option value="Organizer">Organizer</option>
                        <option value="Online search">Online search</option>
                        <option value="Social media">Social media</option>
                        <option value="Advertising">Advertising</option>
                    </select>
                </div>
                <div class="col">
                    <select name="type" id="" class="form-control" required>
                        <option value=""></option>
                        <option value="xlsx">XLSX</option>
                        <option value="xls">XLS</option>
                        <option value="csv">CSV</option>>
                    </select>
                </div>
                <div class="col">
                    <button class="btn btn-dark" name="attendee_submit">Export</button>
                </div>
            </div>
        </form>
        <hr>
        <?= $flash; ?>

        <table class="table table-primary table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Reference</th>
                    <th>Registered Date</th>
                </tr>
            </thead>
            <tbody>
                <?= list_attendees(); ?>
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

