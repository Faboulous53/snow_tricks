<?php

function connectDatabase()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=rentup;charset=utf8', 'root', 'Not24get');
        return $db;

    } catch (Exception $e) {

        die ('Erreur : ' . $e->getMessage());

    }
}



function getPropertyTypes() {

    $db = connectDatabase();
    $query = 'SELECT * FROM propertyType';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function getProperty() {

    $db = connectDatabase();
    $query = 'SELECT property.*,propertyType.name AS propertyName FROM property
    INNER JOIN propertyType ON property.property_type_id = propertytype.id_property_type';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}


function getAgent() {

    $db = connectDatabase();
    $query = 'SELECT * FROM seller';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function getNumberOfProperty() {

    $db = connectDatabase();
    $query = 'SELECT seller.*,COUNT (property.name) AS nombreProperty FROM seller, 
    INNER JOIN property ON id_seller = property.seller_id 
    WHERE seller.id = :id_seller';
    //WHERE property.property_type_id = propertytype.id_property_type
    //GROUP BY property_type_id';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}