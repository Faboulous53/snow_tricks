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


function getTricks()
{

    $db = connectDatabase();
    $query = 'SELECT * FROM propertyType';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function convertImage()
{
    if ($_FILES['picture']['error'] == 0) {
        if ($_FILES['picture']['size'] <= 5000000) {
            $fileInfo = pathinfo($_FILES['picture']['name']);
            $extension = $fileInfo['extension'];
            $mimetype = mime_content_type($_FILES['picture']['tmp_name']);
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'JPEG', 'JPG'];
            if (in_array($extension, $allowedExtensions) && in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png', 'image/JPEG', 'image/jpg', 'image/JPG'))) {
                $filePath = basename($_FILES['picture']['name']);
                move_uploaded_file($_FILES['picture']['tmp_name'], 'images/' . $filePath);

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

function createUser($lastName, $firstName, $userName, $mail, $password, $picture)
{
    $db = connectDatabase();
    $sqlQuery = "INSERT INTO users (last_name, first_name, username, mail, password, picture) 
    VALUES (:last_name,:first_name ,:username,:mail,:password ,:picture) ";
    $userStatement = $db->prepare($sqlQuery);

    return $userStatement->execute([
        'last_name' => $lastName,
        'first_name' => $firstName,
        'username' => $userName,
        'mail' => $mail,
        'password' => $password,
        'picture' => $picture

    ]);
}

function findUser($mail)
{
    $db = connectDatabase();
    $sqlQuery = "SELECT mail, password FROM users WHERE mail = :mail LIMIT 1";
    $connexionStatement = $db->prepare($sqlQuery);
    $connexionStatement->execute(['mail' => $mail]);
    return $connexionStatement->fetch();
}



