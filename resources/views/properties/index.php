<!-- container -->
<div class="container">

    <div class="page-header">
        <h1>Read Properties</h1>
    </div>

    <?php

    $action = $_GET['action'] ?? "";

    // if it was redirected from delete.php
    if ($action == 'deleted') {
        echo "<div class='alert alert-success'>Record was deleted.</div>";
    }

    $properties = $connection->query('SELECT * FROM properties')->fetchAll();

//    //check if more than 0 record found
    if (count($properties) <= 0) {
        echo "<div class='alert alert-danger'>No records found.</div>";
        echo "<a href='index.php?section=properties&action=create' class='btn btn-primary m-b-1em'>Add New Property</a>";

        exit();
    }
    ?>

    <!-- link to create record form -->
    <a href='index.php?section=properties&action=create' class='btn btn-primary m-b-1em'>Add New Property</a>

    <!--start table -->
    <table class='table table-hover table-responsive table-bordered'>

        <!-- creating our table heading -->
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Address</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($properties as $property):?>
            <tr>
                <td><img src="<?php echo $property['image_thumbnail']; ?>" /></td>
                <td><?php echo $property['address']; ?></td>
                <td><?php echo $property['description']; ?></td>
                <td><?php echo '$' . $property['price'] ?></td>
                <td>
                    <!--read one record -->
                    <a href='index.php?section=properties&action=show&uuid=<?php echo $property['uuid']; ?>'
                       class='btn btn-info m-r-1em'>Read</a>
                    <!-- update one record -->
                    <a href='index.php?section=properties&action=update&uuid=<?php echo $property['uuid']; ?>'
                       class='btn btn-primary m-r-1em'>Update</a>
                    <!-- delete one record -->
                    <a href='#' onclick='delete_property(<?php echo json_encode($property['uuid']); ?>);'
                       class='btn btn-danger'>Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div> <!-- end .container -->

<script type='text/javascript'>
    // confirm record deletion
    function delete_property(uuid) {
        var answer = confirm('Are you sure?');
        if (answer) {
            // if user clicked ok,
            // pass the id to delete.php and execute the delete query
            window.location = 'index.php?section=properties&action=delete&uuid=' + uuid;
        }
    }
</script>