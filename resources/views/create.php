<?php
if ($_POST) {
    $crudController->create();
}
?>

<!-- container -->
<div class='container'>

    <div class='page-header text-center mt-5'>
        <h3>Create Application</h3>
    </div>

    <form id="applicationForm" class="d-flex flex-column align-items-center" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="mb-3">
            <input name="money_amount" type="number" class="form-control" id="money_amount" placeholder="Enter amount of money">
        </div>
        <button type="submit" class="btn btn-success">Send</button>
<!--        <a href='index.php?action=index' class='btn btn-info m-r-1em'>Dashboard</a>-->
    </form>
</div> <!-- end .container -->
