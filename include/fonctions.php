<?php

function connectDatabase()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=snow_tricks;charset=utf8', 'root', 'Not24get');
        return $db;

    } catch (Exception $e) {

        die ('Erreur : ' . $e->getMessage());

    }
}


function getPropertyTypes()
{

    $db = connectDatabase();
    $query = 'SELECT * FROM propertyType';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function getProperty()
{

    $db = connectDatabase();
    $query = 'SELECT property.*,propertyType.name AS propertyName
    FROM property
    INNER JOIN propertyType ON property.property_type_id = propertytype.id_property_type';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}


function getAgent()
{

    $db = connectDatabase();
    $query = 'SELECT * FROM seller';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}


function getNbrProperty($id): int
{
    $db = connectDatabase();
    $sqlQuery = 'SELECT COUNT(*) 
    FROM property 
    WHERE seller_id =' . $id;
    $propertyStatement = $db->prepare($sqlQuery);
    $propertyStatement->execute();
    return $propertyStatement->fetchColumn();
}

function threeLastProperty()
{
    $db = connectDatabase();
    $query = 'SELECT property.*,propertyType.name AS propertyName
    FROM property
    INNER JOIN propertyType ON property.property_type_id = propertytype.id_property_type
    WHERE property.status <> \'Sold\'
    ORDER BY create_time DESC
    LIMIT 3';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
    $lastProperty = threeLastProperty();
}

function getPropertiesWithSeller()
{
    $db = connectDatabase();
    $query = 'SELECT *    FROM property,seller    WHERE seller_id = id_seller';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();

}


function createProperty($name, $street, $city, $postalCode, $state, $country, $propertyTypeId, $status, $price, $sellerId, $image)
{
    $db = connectDatabase();
    $sqlQuery = "INSERT INTO property (name, street, city, postal_code, state, country, price, status, property_type_id, seller_id, image) 
    VALUES (:name,:street ,:city,:postal_code,:state ,:country ,:price,:status,:property_type_id,:seller_id,:image) ";
    $propertyStatement = $db->prepare($sqlQuery);

    return $propertyStatement->execute([
        'name' => $name,
        'street' => $street,
        'city' => $city,
        'postal_code' => $postalCode,
        'state' => $state,
        'country' => $country,
        'price' => $price,
        'status' => $status,
        'property_type_id' => $propertyTypeId,
        'seller_id' => $sellerId,
        'image' => $image

    ]);
}

function convertImage()
{
    if ($_FILES['image']['error'] == 0) {
        if ($_FILES['image']['size'] <= 5000000) {
            $fileInfo = pathinfo($_FILES['image']['name']);
            $extension = $fileInfo['extension'];
            $mimetype = mime_content_type($_FILES['image']['tmp_name']);
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'JPEG', 'JPG'];
            if (in_array($extension, $allowedExtensions) && in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png', 'image/JPEG', 'image/jpg', 'image/JPG'))) {
                $filePath = basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/'. $filePath);

            } else {
                echo '<div class="alert alert-danger" role="alert">Le fichier doit être une image</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">L\'image ne doit pas dépasser 1mo</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Une erreur est survenue lors de l\'import de l\'image</div>';
    }
}

function modificationProperty($name, $street, $city, $postalCode, $state, $country, $propertyTypeId, $status, $price, $sellerId, $image, $id_property)
{
    $db = connectDatabase();
    $sqlQuery = "UPDATE property
    SET name = :name,
        street = :street,
        city = :city,
        postal_code = :postal_code,
        state = :state,
        country = :country,
        price = :price,
        status = :status,        
        image = :image,
        property_type_id = :property_type_id,
        seller_id = :seller_id
        WHERE id_property = :id_property; ";
    $modificationProperty = $db->prepare($sqlQuery);
    return $modificationProperty->execute([
        'name' => $name,
        'street' => $street,
        'city' => $city,
        'postal_code' => $postalCode,
        'state' => $state,
        'country' => $country,
        'price' => $price,
        'status' => $status,
        'property_type_id' => $propertyTypeId,
        'seller_id' => $sellerId,
        'image' => $image,
        'id_property' => $id_property
    ]);

}

function getPropertyById(){
    $db = connectDatabase();
    $sqlQuery = "SELECT property.*,propertyType.name AS propertyName
    FROM property
    INNER JOIN propertyType ON property.property_type_id = propertytype.id_property_type
    WHERE id_property = ? ";
    $propertyStatement = $db->prepare($sqlQuery);
    $propertyStatement->execute([
         $_GET["id"]
    ]);
    return
        $propertyStatement->fetchAll();

}


