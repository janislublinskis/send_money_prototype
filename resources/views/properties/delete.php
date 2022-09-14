<?php
$uuid = $_GET['uuid'] ?? 0;
$stmt = $connection->query("DELETE FROM properties WHERE uuid = '$uuid'")->fetch(PDO::FETCH_ASSOC);

if (!$stmt) {
    // redirect to read records page and
    // tell the user record was deleted
    echo "<div class='alert alert-success'>Record was deleted.</div>";
} else {
    die('Unable to delete record.');
}
?>
<a href='index.php?section=properties&action=index' class='btn btn-danger'>Back to read properties</a>

