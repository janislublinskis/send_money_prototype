<?php

class PropertyController
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function uploadImage($attribute): ?string
    {
        if(empty(basename($_FILES[$attribute]['name']))){
            return null;
        }

        $uploadDir =  'storage/public/images/';
        $path = $uploadDir . basename($_FILES[$attribute]['name']);
        move_uploaded_file($_FILES[$attribute]['tmp_name'], $path);

        return $path;
    }

    public function create(): void
    {
        if (isset($_POST['county'])) {
            $county = htmlspecialchars(strip_tags($_POST['county']));
        }
        if (isset($_POST['country'])) {
            $country = htmlspecialchars(strip_tags($_POST['country']));
        }
        if (isset($_POST['town'])) {
            $town = htmlspecialchars(strip_tags($_POST['town']));
        }
        if (isset($_POST['description'])) {
            $description = htmlspecialchars(strip_tags($_POST['description']));
        }
        if (isset($_POST['address'])) {
            $address = htmlspecialchars(strip_tags($_POST['address']));
        }
        if (isset($_POST['latitude'])) {
            $latitude = htmlspecialchars(strip_tags($_POST['latitude']));
        }
        if (isset($_POST['longitude'])) {
            $longitude = htmlspecialchars(strip_tags($_POST['longitude']));
        }
        if (isset($_POST['num_bedrooms'])) {
            $numBedrooms = htmlspecialchars(strip_tags($_POST['num_bedrooms']));
        }
        if (isset($_POST['num_bathrooms'])) {
            $numBathrooms = htmlspecialchars(strip_tags($_POST['num_bathrooms']));
        }
        if (isset($_POST['price'])) {
            $price = htmlspecialchars(strip_tags($_POST['price']));
        }
        if (isset($_POST['type'])) {
            $type = htmlspecialchars(strip_tags($_POST['type']));
        }
        if (isset($_POST['property_type_title'])) {
            $propertyTypeTitle = htmlspecialchars(strip_tags($_POST['property_type_title']));
        }
        if (isset($_POST['property_type_description'])) {
            $propertyTypeDescription = htmlspecialchars(strip_tags($_POST['property_type_description']));
        }

        if ($propertyType = $this->getPropertyTypeByTitle($propertyTypeTitle)) {
            $propertyTypeId = $propertyType['id'];
        } else {
            $propertyTypeId = $this->addPropertyType($propertyTypeTitle, $propertyTypeDescription);
        }

        $sql = "INSERT INTO properties (
                    property_type_id, county, country, town,
                    description, address, image_full, image_thumbnail, latitude, longitude,
                    num_bedrooms, num_bathrooms, price, type
                ) VALUES (
                    :property_type_id, :county, :country, :town,
                    :description, :address, :image_full, :image_thumbnail, :latitude,
                    :longitude, :num_bedrooms, :num_bathrooms, :price, :type
                )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":property_type_id", $propertyTypeId, PDO::PARAM_INT);
        $stmt->bindValue(":county", $county, PDO::PARAM_STR);
        $stmt->bindValue(":country", $country, PDO::PARAM_STR);
        $stmt->bindValue(":town", $town, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":address", $address, PDO::PARAM_STR);
        $stmt->bindValue(":image_full", $this->uploadImage('image_full'), PDO::PARAM_STR);
        $stmt->bindValue(":image_thumbnail", $this->uploadImage('image_thumbnail'), PDO::PARAM_STR);
        $stmt->bindValue(":latitude", $latitude, PDO::PARAM_STR);
        $stmt->bindValue(":longitude", $longitude, PDO::PARAM_STR);
        $stmt->bindValue(":num_bedrooms", $numBedrooms, PDO::PARAM_INT);
        $stmt->bindValue(":num_bathrooms", $numBathrooms, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":type", $type, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Record was saved.</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
    }

    public function addPropertyType(string $title, string $description): int
    {
        $sql = "INSERT INTO property_types (
                    title, description
                ) VALUES (
                    :title, :description
                )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $uuid)
    {
        $sql = "SELECT *
                FROM properties
                WHERE uuid = :uuid";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":uuid", $uuid, PDO::PARAM_STR);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $data['property_type'] = json_encode($this->getPropertyTypeById($data["property_type_id"]));
        }

        return $data;
    }

    public function getPropertyTypeById($propertyTypeId)
    {
        $sql = "SELECT * FROM property_types WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $propertyTypeId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPropertyTypeByTitle($title): array
    {
        $sql = "SELECT * FROM property_types WHERE title = :title";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $current): void
    {
        if (isset($_POST['county'])) {
            $county = htmlspecialchars(strip_tags($_POST['county']));
        }
        if (isset($_POST['country'])) {
            $country = htmlspecialchars(strip_tags($_POST['country']));
        }
        if (isset($_POST['town'])) {
            $town = htmlspecialchars(strip_tags($_POST['town']));
        }
        if (isset($_POST['description'])) {
            $description = htmlspecialchars(strip_tags($_POST['description']));
        }
        if (isset($_POST['address'])) {
            $address = htmlspecialchars(strip_tags($_POST['address']));
        }
        if (isset($_POST['latitude'])) {
            $latitude = htmlspecialchars(strip_tags($_POST['latitude']));
        }
        if (isset($_POST['longitude'])) {
            $longitude = htmlspecialchars(strip_tags($_POST['longitude']));
        }
        if (isset($_POST['num_bedrooms'])) {
            $numBedrooms = htmlspecialchars(strip_tags($_POST['num_bedrooms']));
        }
        if (isset($_POST['num_bathrooms'])) {
            $numBathrooms = htmlspecialchars(strip_tags($_POST['num_bathrooms']));
        }
        if (isset($_POST['price'])) {
            $price = htmlspecialchars(strip_tags($_POST['price']));
        }
        if (isset($_POST['type'])) {
            $type = htmlspecialchars(strip_tags($_POST['type']));
        }
        if (isset($_POST['property_type_title'])) {
            $propertyTypeTitle = htmlspecialchars(strip_tags($_POST['property_type_title']));
        }
        if (isset($_POST['property_type_description'])) {
            $propertyTypeDescription = htmlspecialchars(strip_tags($_POST['property_type_description']));
        }

        if ($propertyType = $this->getPropertyTypeByTitle($propertyTypeTitle)) {
            $propertyTypeId = $propertyType['id'];
        } else {
            $propertyTypeId = $this->addPropertyType($propertyTypeTitle, $propertyTypeDescription);
        }

        $sql = "UPDATE properties
                SET property_type_id = :property_type_id, county = :county, country = :country, town = :town, description = :description,
                    address = :address, image_full = :image_full, image_thumbnail = :image_thumbnail,
                    latitude = :latitude, longitude = :longitude, num_bedrooms = :num_bedrooms, 
                    num_bathrooms = :num_bathrooms, price = :price, type = :type
                WHERE uuid = :uuid";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":property_type_id", $propertyTypeId ?? $current["property_type_id"], PDO::PARAM_INT);
        $stmt->bindValue(":county", $county ?? $current["county"], PDO::PARAM_STR);
        $stmt->bindValue(":country", $country ?? $current["country"], PDO::PARAM_STR);
        $stmt->bindValue(":town", $town ?? $current["town"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $description ?? $current["description"], PDO::PARAM_STR);
        $stmt->bindValue(":address", $address ?? $current["address"], PDO::PARAM_STR);
        $stmt->bindValue(":image_full", $this->uploadImage('image_full') ?? $current['image_full'], PDO::PARAM_STR);
        $stmt->bindValue(":image_thumbnail", $this->uploadImage('image_thumbnail') ?? $current['image_thumbnail'], PDO::PARAM_STR);
        $stmt->bindValue(":latitude", $latitude ?? $current["latitude"], PDO::PARAM_STR);
        $stmt->bindValue(":longitude", $longitude ?? $current["longitude"], PDO::PARAM_STR);
        $stmt->bindValue(":num_bedrooms", $numBedrooms ?? $current["num_bedrooms"], PDO::PARAM_INT);
        $stmt->bindValue(":num_bathrooms", $numBathrooms ?? $current["num_bathrooms"], PDO::PARAM_INT);
        $stmt->bindValue(":price", $price ?? $current["price"], PDO::PARAM_INT);
        $stmt->bindValue(":type", $type ?? $current["type"], PDO::PARAM_STR);
        $stmt->bindValue(":uuid", $current["uuid"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Record was updated.</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to update the record. Please try again.</div>";
        }
    }
}