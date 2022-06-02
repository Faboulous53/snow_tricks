<?php
require_once __DIR__ . "/../entity/Remark.php";

function connectDatabase()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=snow_tricks;charset=utf8', 'root', 'Not24get',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        return $db;

    } catch (Exception $e) {

        die ('Erreur : ' . $e->getMessage());

    }
}


function getTricks()
{
    $db = connectDatabase();
    $query = 'SELECT tricks.*, tricks_group.name FROM `tricks`
              INNER JOIN tricks_group on tricks.id_tricks_group = tricks_group.id
              ORDER BY id DESC LIMIT 10 ';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}


function uploadImage()
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
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sqlQuery = "SELECT * FROM users WHERE mail = :mail LIMIT 1";
    $connexionStatement = $db->prepare($sqlQuery);
    $connexionStatement->execute(['mail' => $mail]);
    return $connexionStatement->fetch();
}

function logout()
{
    session_destroy();
    setcookie('loggedUser');
}

/**
 * Vérifie si l'utilisateur est connecté
 *
 * @return bool
 */
function isLogged(): bool
{
    if (isset($_SESSION['user'])) {
        return true;
    }

    return false;
}

function createTrickById($name, $description, $mainPhoto, $idGroup, $youtubes)
{
    $db = connectDatabase();
    $sqlQuery = "INSERT INTO tricks (name, description, main_photo, id_user, id_tricks_group) 
    VALUES (:name,:description ,:main_photo,:id_user ,:tricks_group_id)";
    $userStatement = $db->prepare($sqlQuery);

    $userStatement->execute([
        'name' => $name,
        'description' => $description,
        'main_photo' => $mainPhoto,
        'id_user' => $_SESSION["user"]["id"],
        'tricks_group_id' => $idGroup
    ]);
    $idTrick = $db->lastInsertId();
    foreach ($youtubes as $youtube) {
        createMedia(null, $youtube, $idTrick, "youtube");
    }
}

function createMedia($path, $html, $tricks, $type)
{

    $db = connectDatabase();
    $sqlQuery = "INSERT INTO medias (path, html, type, id_tricks) 
    VALUES (:path, :html, :type, :id_tricks)";
    $mediaStatement = $db->prepare($sqlQuery);
    $mediaStatement->execute([
        "path" => $path,
        "html" => $html,
        "type" => $type,
        "id_tricks" => $tricks
    ]);
}

function deleteMediaByTrickId($trickID){

    $db = connectDatabase();
    $sqlQuery = "DELETE FROM medias
                 WHERE id_tricks = :id_tricks";
    $mediaStatement = $db->prepare($sqlQuery);
    $mediaStatement->execute([
        "id_tricks" => $trickID
    ]);
}

function getTricksGroup()
{
    $db = connectDatabase();
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query = 'SELECT * FROM tricks_group';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function listTricksByUser()
{
    $db = connectDatabase();
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query = 'SELECT tricks.*, tricks_group.name, users.username 
              FROM `tricks` 
              INNER JOIN users ON tricks.id_user = users.id 
              INNER JOIN tricks_group on tricks.id_tricks_group = tricks_group.id';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function canUpdateOrDeleteTrick($tricks)
{
    if ($_SESSION['user']["id"] === $tricks["id_user"]) {
        return true;
    }

    return false;
}

function getTrickID($trickId)
{
    $db = connectDatabase();
    $sqlQuery = "SELECT tricks.id FROM tricks WHERE id = :id";
    $trickStatement = $db->prepare($sqlQuery);
    $trickStatement->execute([
        'id' => $trickId
    ]);

    return $trickStatement->fetchAll();
}

function getTrickByID($trickId)
{
    $db = connectDatabase();
    $sqlQuery = "
    SELECT tricks.* , users.*, tricks_group.name AS tricks_group_name FROM tricks
    INNER JOIN users ON tricks.id_user = users.id 
    INNER JOIN tricks_group on tricks.id_tricks_group = tricks_group.id 
    WHERE tricks.id = :id";
    $trickStatement = $db->prepare($sqlQuery);
    $trickStatement->execute([
        'id' => $trickId
    ]);

    return $trickStatement->fetch();
}


function deleteTrick($trickId)
{
    $trick = getTrickByID($trickId);
    if (isLogged() && $_SESSION['user']["id"] === (int)$trick["id_user"]) {
        $db = connectDatabase();
        $sqlQuery = "DELETE FROM tricks WHERE id = :id";
        $trickStatement = $db->prepare($sqlQuery);
        $trickStatement->execute([
            'id' => $trickId
        ]);
        return true;
    }
    return false;
}


/**
 * @param int $trickId
 * @return Remark[]|false
 */
function getRemarksByTrickId(int $trickId)
{
    $db = connectDatabase();
    $sqlQuery = "SELECT id, content, create_at AS createAt FROM remarks WHERE id_tricks = :id";
    $remarksStatement = $db->prepare($sqlQuery);
    $remarksStatement->execute([
        'id' => $trickId
    ]);
    return $remarksStatement->fetchAll(PDO::FETCH_CLASS, Remark::class);
}


function findUserByEmail($mail)
{
    $db = connectDatabase();
    $sqlQuery = "SELECT *  FROM users WHERE mail = :mail LIMIT 1";

    $connexionStatement = $db->prepare($sqlQuery);

    $connexionStatement->execute([
        'mail' => $mail
    ]);

    return $connexionStatement->fetch();

};

function getMediabyTrick($trickId)
{
    $db = connectDatabase();
    $sqlQuery = "SELECT medias.*  FROM medias WHERE medias.id_tricks = :trickId";
    $mediaStatement = $db->prepare($sqlQuery);
    $mediaStatement->execute([
        "trickId" => $trickId
    ]);
    return $mediaStatement->fetchAll();

}

function modifyTrick($id, $name, $description, $mainPhoto, $idGroup, $youtubes)
{

    if(empty($mainPhoto))
    {
        $trick = getTrickByID($id);
        $mainPhoto = $trick['main_photo'];

    }

    $db = connectDatabase();
    $sqlQuery = "UPDATE tricks SET     
    name=:name,
    description=:description,
    main_photo=:main_photo,   
    id_tricks_group=:id_group 
    WHERE id=:id";
    $trickStatement = $db->prepare($sqlQuery);
    $trickStatement->execute([
        "id" => $id,
        "name" => $name,
        "description" => $description,
        "main_photo" => $mainPhoto,
        "id_group" => $idGroup
    ]);
    deleteMediaByTrickId($id);
    foreach ($youtubes as $youtube) {
        createMedia(null, $youtube, $id, "youtube");
    }
}








