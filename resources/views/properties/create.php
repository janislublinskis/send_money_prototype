<?php
if ($_POST) {
    $crudController->create();
}

$propertyTypes = $connection->query("SELECT * FROM property_types")->fetchAll();
?>

<!-- container -->
<div class='container'>

    <div class='page-header'>
        <h1>Create Property</h1>
    </div>

    <form action='index.php?section=properties&action=create' method='POST' enctype="multipart/form-data">

        <table class='table table-hover table-responsive'>
            <tr>
                <td><label for='county'>County:</label></td>
                <td><input type='text' id='county' name='county' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='country'>Country:</label></td>
                <td><input type='text' id='country' name='country' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='town'>Town:</label></td>
                <td><input type='text' id='town' name='town' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='description'>Description:</label></td>
                <td><textarea id='description' name='description' rows="4" cols="50" class='form-control'></textarea>
                </td>
            </tr>
            <tr>
                <td><label for='address'>Displayable Address:</label></td>
                <td><input type='text' id='address' name='address' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='image_full'>Image:</label></td>
                <td><input type='file' accept=".jpg, .jpeg, .png" id='image_full' name='image_full' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='image_thumbnail'>Thumbnail:</label></td>
                <td><input type='file' accept=".jpg, .jpeg, .png" id='image_thumbnail' name='image_thumbnail' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='latitude'>Latitude:</label></td>
                <td><input type='text' id='latitude' name='latitude' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='longitude'>Longitude:</label></td>
                <td><input type='text' id='longitude' name='longitude' class='form-control'/></td>
            </tr>
            <tr>
                <td><label for='num_bedrooms'>Number of bedrooms:</label></td>
                <td>
                    <select name="num_bedrooms" id="num_bedrooms">
                        <?php
                            for ($i = 0; $i < 100; $i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
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
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for='price'>Price:</label></td>
                <td><input type='number' id='price' name='price' class='form-control'/></td>
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

                    <textarea id='property_type_description' name='property_type_description' rows='4' cols='50' class='form-control' placeholder="Enter property's description"></textarea>
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
                    <input type='submit' name='submit' value='Add' class='btn btn-primary'/>
                    <input type='reset' name='reset' value='Reset' class='btn btn-primary'/>
                    <a href='index.php?section=properties&action=index' class='btn btn-danger'>Back to read properties</a>
                </td>
            </tr>
        </table>
    </form>

</div> <!-- end .container -->



