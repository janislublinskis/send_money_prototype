<?php
if (isset($_GET['id'])) {
    $dealController->updateDealStatus();
}
?>

<!-- container -->
<div class="container">

    <div class="page-header">
        <h1>Applications & Deals Dashboard</h1>
    </div>

    <?php

    $action = $_GET['action'] ?? "";

    // if it was redirected from delete.php
    if ($action == 'deleted') {
        echo "<div class='alert alert-success'>Record was deleted.</div>";
    }

    $applications = $connection->query('SELECT * FROM applications')->fetchAll();

    $deals = $connection->query('SELECT * FROM deals')->fetchAll();

    //check if more than 0 record found
    if (count($applications) <= 0) {
        echo "<div class='alert alert-danger'>No records found.</div>";
//        exit();
    }
    ?>

    <!--start table -->
    <table class='table table-hover table-responsive table-bordered'>

        <!-- creating our table heading -->
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Amount of Money</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($applications as $application):?>
            <tr>
                <td><?php echo $application['id']; ?></td>
                <td><?php echo $application['email']; ?></td>
                <td><?php echo '$' . $application['money_amount'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--start table -->
    <table class='table table-hover table-responsive table-bordered'>

        <!-- creating our table heading -->
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ApplicationID</th>
            <th scope="col">Partner</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($deals as $deal):?>
            <tr>
                <td><?php echo $deal['id']; ?></td>
                <td><?php echo $deal['application_id']; ?></td>
                <td><?php echo $deal['partner']; ?></td>
                <td><?php echo $deal['status']; ?></td>
                <td>
                    <a href='#' onclick='setOfferStatus(<?php echo json_encode($deal['id']); ?>);' class='btn btn-danger'>Offer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div> <!-- end .container -->

<script type='text/javascript'>
    // confirm record update
    function setOfferStatus(id) {
        var answer = confirm('Are you sure?');
        if (answer) {
            // if user clicked ok execute the update deal status query
            window.location = 'index.php?action=index&id=' + id;
        }
    }
</script>
<style>
    table {
        border: none !important;
    }
</style>
