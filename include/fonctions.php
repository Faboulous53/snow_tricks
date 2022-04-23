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
    $query = 'SELECT property.*,propertyType.name AS propertyName
    FROM property
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


function getNbrProperty($id): int {
    $db = connectDatabase();
    $sqlQuery = 'SELECT COUNT(*) 
    FROM property 
    WHERE seller_id ='.$id;
    $propertyStatement = $db->prepare($sqlQuery);
    $propertyStatement->execute();
    return $propertyStatement->fetchColumn();
}

function threeLastProperty() {
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

function getPropertiesWithSeller() {
    $db = connectDatabase();
    $query = 'SELECT *    FROM property,seller    WHERE seller_id = id_seller';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

//function classAvaible(){
//    if($idProperties['status'] === 'for Rent' && $idProperties['status'] === 'for Sale'){
//        echo "table-success";
//    }else{
//        echo "table-danger";
//    }
//}

