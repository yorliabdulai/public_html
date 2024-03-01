<?php 
    
    // SUBSCRIPTIONS

    include ("../connection/conn.php");
    include ("inc/header.inc.php");

    // if (!admin_is_logged_in()) {
    //     admn_login_redirect();
    // }

?>

	<div class="container mt-4">
        <h2>Suscribers</h2>
        <?= $flash; ?>

        <table class="table table-success table-sm table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Email</th>
                    <th>Joined Date</th>
                </tr>
            </thead>
            <tbody>
                <?= subscriped_emails(); ?>
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