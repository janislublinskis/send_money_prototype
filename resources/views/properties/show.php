<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
//$id = $_GET['id'] ?? die('ERROR: Record ID not found.');
$uuid = $_GET['uuid'] ?? 0;
$property = $connection->query("SELECT * FROM properties WHERE uuid = '$uuid'")
    ->fetch(PDO::FETCH_ASSOC);
$propertyTypeId = $property['property_type_id'];
$propertyType = $connection->query("SELECT * FROM property_types WHERE id = '$propertyTypeId'")
    ->fetch(PDO::FETCH_ASSOC);

if ($property == null) {
    header("Location: index.php?section=properties&action=index");
    exit();
}
?>

<!-- container -->
<div class="container">

    <div class="page-header">
        <h1>Read Property</h1>

        <table class="table">
            <tbody>
                <tr>
                    <td>County</td>
                    <td><?php echo htmlspecialchars($property["county"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo htmlspecialchars($property["country"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Town</td>
                    <td><?php echo htmlspecialchars($property["town"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo htmlspecialchars($property["description"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo htmlspecialchars($property["address"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><img src="<?php echo htmlspecialchars($property["image_full"], ENT_QUOTES); ?>" /></td>
                </tr>
                <tr>
                    <td>Thumbnail</td>
                    <td><img src="<?php echo htmlspecialchars($property["image_thumbnail"], ENT_QUOTES); ?>" /></td>
                </tr>
                <tr>
                    <td>Latitude</td>
                    <td><?php echo htmlspecialchars($property["latitude"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Longitude</td>
                    <td><?php echo htmlspecialchars($property["longitude"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Number of bedrooms</td>
                    <td><?php echo htmlspecialchars($property["num_bedrooms"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Number of bathrooms</td>
                    <td><?php echo htmlspecialchars($property["num_bathrooms"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo '$ ' . htmlspecialchars($property["price"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Property Type & description</td>
                    <td>
                        <p><?php echo htmlspecialchars($propertyType['title'], ENT_QUOTES)?></p>
                        <p><?php echo htmlspecialchars($propertyType['description'], ENT_QUOTES);?></p>
                    </td>
                </tr>
                <tr>
                    <td>For Sale / For Rent</td>
                    <td><?php echo htmlspecialchars($property["type"], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href='index.php?section=properties&action=index' class='btn btn-danger'>Back to read properties</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>