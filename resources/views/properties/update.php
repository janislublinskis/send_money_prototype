<?php

$uuid = $_GET['uuid'] ?? 0;
$property = $connection->query("SELECT * FROM properties WHERE uuid = '$uuid'")
    ->fetch(PDO::FETCH_ASSOC);
$propertyTypeId = $property['property_type_id'];
$thisPropertyType = $connection->query("SELECT * FROM property_types WHERE id = '$propertyTypeId'")
    ->fetch(PDO::FETCH_ASSOC);

if ($property == null) {
    header("Location: index.php?section=properties&action=index");
    exit();
}

$propertyTypes = $connection->query("SELECT * FROM property_types")->fetchAll();

if ($_POST) {
    $crudController->update($property);
}
?>

<!-- container -->
<div class='container'>

    <div class='page-header'>
        <h1>Update Property</h1>
    </div>

    <form action='index.php?section=properties&action=update&uuid=<?php echo $uuid ?>' method='POST' enctype="multipart/form-data">

        <table class='table table-hover table-responsive'>
            <tr>
                <td><label for='county'>County:</label></td>
                <td><input type='text' id='county' name='county' value="<?php echo htmlspecialchars($property['county'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='country'>Country:</label></td>
                <td><input type='text' id='country' name='country' value="<?php echo htmlspecialchars($property['country'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='town'>Town:</label></td>
                <td><input type='text' id='town' name='town' value="<?php echo htmlspecialchars($property['town'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='description'>Description:</label></td>
                <td>
                    <textarea id='description' name='description' rows="4" cols="50" class='form-control'><?php echo htmlspecialchars($property['description'], ENT_QUOTES); ?></textarea>
                </td>
            </tr>
            <tr>
                <td><label for='address'>Displayable Address:</label></td>
                <td><input type='text' id='address' name='address' value="<?php echo htmlspecialchars($property['address'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td>
                    <label for='image_full'>Image:</label>
                    <img src="<?php echo htmlspecialchars($property['image_full'], ENT_QUOTES); ?>"/>
                </td>
                <td><input type='file' accept=".jpg, .jpeg, .png" id='image_full' name='image_full' class='form-control'/></td>
            </tr>
            <tr>
                <td>
                    <label for='image_thumbnail'>Thumbnail:</label>
                    <img src="<?php echo htmlspecialchars($property['image_thumbnail'], ENT_QUOTES); ?>"/>
                </td>
                <td><input type='file' accept=".jpg, .jpeg, .png" id='image_thumbnail' name='image_thumbnail' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='latitude'>Latitude:</label></td>
                <td><input type='text' id='latitude' name='latitude' value="<?php echo htmlspecialchars($property['latitude'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='longitude'>Longitude:</label></td>
                <td><input type='text' id='longitude' name='longitude' value="<?php echo htmlspecialchars($property['longitude'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='num_bedrooms'>Number of bedrooms:</label></td>
                <td>
                    <select name="num_bedrooms" id="num_bedrooms">
                        <?php
                            for ($i = 0; $i < 100; $i++) {
                                $string = "<option value='" . $i . "'>" . $i . "</option>";

                                if(htmlspecialchars($property['num_bedrooms'], ENT_QUOTES) == $i){
                                    str_replace($string, '<option', '<option selected');
                                }
                                echo $string;
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for='num_bathrooms'>Number of bathrooms:</label></td>
                <td>
                    <select name="num_bathrooms" id="num_bathrooms">
                        <?php
                            for ($i = 0; $i < 100; $i++) {
                                $string = "<option value='" . $i . "'>" . $i . "</option>";

                                if(htmlspecialchars($property['num_bathrooms'], ENT_QUOTES) == $i){
                                    str_replace($string, '<option', '<option selected');
                                }
                                echo $string;
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for='price'>Price:</label></td>
                <td><input type='number' id='price' name='price' value="<?php echo htmlspecialchars($property['price'], ENT_QUOTES); ?>" class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='property'>Property Type & Description:</label></td>
                <td>
                    <input name='property_type_title' type='text' list='property_type_title'  class='form-control mb-2' placeholder='Select type or enter new'/>
                    <datalist id="property_type_title">
                        <?php
                        foreach ($propertyTypes as $type) {
                            echo "<option value='" . $type['title'] . "'>" . $type['title'] . "</option>";
                        }
                        ?>
                    </datalist>

                    <textarea id='property_type_description' name='property_type_description' rows='4' cols='50' class='form-control' placeholder="Enter property's description"><?php echo htmlspecialchars($thisPropertyType['description'], ENT_QUOTES); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="d-flex justify-content-around">
                    <div>
                        <input class="mr-2" type="radio" id="sale" name="type" value="sale">
                        <label for="sale">Sale</label>
                    </div>
                    <div>
                        <input class="mr-2" type="radio" id="rent" name="type" value="rent">
                        <label for="rent">Rent</label>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <input type='submit' name='submit' value='Update' class='btn btn-primary'/>
                    <input type='reset' name='reset' value='Reset' class='btn btn-primary'/>
                    <a href='index.php?section=properties&action=index' class='btn btn-danger'>Back to read properties</a>
                </td>
            </tr>
        </table>
    </form>

</div> <!-- end .container -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script type='text/javascript'>
    $(document).ready(function () {
        $('#property_type_title').val("<?php echo htmlspecialchars($thisPropertyType['title'], ENT_QUOTES); ?>");
        var radioSelect = "<?php echo htmlspecialchars($property['type'], ENT_QUOTES); ?>"
        $('#' + radioSelect).prop('checked', true);
    });
</script>


