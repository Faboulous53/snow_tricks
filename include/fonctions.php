<?php
require_once __DIR__ . "/../entity/Remark.php";


// Connexion à la base de données:
// ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION: Afin d'afficher les erreurs de type
// ATTR_EMULATE_PREPARES => false: Afin d'utiliser les requêtes préparées natives sans les émuler.
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

//fonction créée pour générer l'affichage dynamique des tricks sur la page d'accueil.
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

//fonction créée pour gérer l'upload d'image vers le dossier images du projet.
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

////fonction créée pour la création d'un compte utilisateur.
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

//fonction créée trouver un utilisateur en fonction de l'utilisateur afin de générer
// un message d'erreur en cas d'email introuvable.
function findUser($mail)
{
    $db = connectDatabase();
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sqlQuery = "SELECT * FROM users WHERE mail = :mail LIMIT 1";
    $connexionStatement = $db->prepare($sqlQuery);
    $connexionStatement->execute(['mail' => $mail]);
    return $connexionStatement->fetch();
}

//
//fonction créée afin de gérer la déconnexion de l'utilisateur.
function logout()
{
    session_destroy();
    setcookie('loggedUser');
}

//fonction créée afin de vérifier si un utilisateur est connecté avec retour d'un booléen.
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

//fonction créée pour créer une trick en fonction de l'utlisateur connecté.
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
    //Afin de récupérer le dernier ID inséré.
    $idTrick = $db->lastInsertId();
    foreach ($youtubes as $youtube) {
        createMedia(null, $youtube, $idTrick, "youtube");
    }
}

//fonction créée pour gérer l'insertion de médias dans la table prévue à cet effet.
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

//fonction créée pour gérer la supression de médias en fonction de l'id de la trick concerné.
//cette fonction est appelée lors de la modification d'une trick afin de supprimer les médias précèdents
//avant la création des nouveaux.
function deleteMediaByTrickId($trickID)
{

    $db = connectDatabase();
    $sqlQuery = "DELETE FROM medias
                 WHERE id_tricks = :id_tricks";
    $mediaStatement = $db->prepare($sqlQuery);
    $mediaStatement->execute([
        "id_tricks" => $trickID
    ]);
}

//fonction créée afin de pouvoir boucler sur les noms des groupes lors de la création d'une trick.
function getTricksGroup()
{
    $db = connectDatabase();
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query = 'SELECT * FROM tricks_group';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

//fonction créée afficher la liste de toutes tricks enregistrée en récupérant quelques données de l'utilisateur.
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

//fonction créée pour gérer la condition de suppression d'une trick, seul l'utilisateur ayant crée la trick
//peut la supprimer, retour d'un booléen.
function canUpdateOrDeleteTrick($tricks)
{
    if ($_SESSION['user']["id"] === $tricks["id_user"]) {
        return true;
    }

    return false;
}


//fonction créée récupérer une trick en fonction de son ID.
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

//fonction créée afin de supprimer.
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

//fonction créée pour récupérer les commentaires en fonction de l'ID de la trick.
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

//fonction créée pour rechercher un utilisateur en fonction de son email.
function findUserByEmail($mail)
{
    $db = connectDatabase();
    $sqlQuery = "SELECT *  FROM users WHERE mail = :mail LIMIT 1";
    $connexionStatement = $db->prepare($sqlQuery);
    $connexionStatement->execute([
        'mail' => $mail
    ]);

    return $connexionStatement->fetch();

}

;

//fonction créée pour récupérer les médias en fonction de la trick.
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

//fonction créée pour modifier une trick.
//Pour cela les médias précèdents sont supprimées avant d'en insérer des nouveaux.
function modifyTrick($id, $name, $description, $mainPhoto, $idGroup, $youtubes)
{
    if (empty($mainPhoto)) {
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












