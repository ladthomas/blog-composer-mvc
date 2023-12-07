<?php


function postIndex(){
   

    // Informations de connexion
    $host = $_ENV['DB_HOST'];
    $database = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $socket = $_ENV['SOCKET'];
    // Connexion à la base de données avec MySQLi
    $mysqli = new mysqli($host, $username, $password, $database, null,$socket );


    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }



    // Préparation et exécution de la requête
    $result = $mysqli->query("SELECT * FROM posts");

    // Vérifier si la requête a réussi
    if (!$result) {
        die("Erreur dans la requête : " . $mysqli->error);
    }

    // Construction de la chaîne de texte HTML
    $html = '<h1>Liste des articles</h1>';
    $html .= '<ul>';

    // Ajout des articles à la chaîne de texte
    while ($post = $result->fetch_assoc()) {
        $html .= '<li>';
        $html .= 'ID: ' . $post['id'] . '<br>';
        $html .= 'Title: ' . $post['title'] . '<br>';
        $html .= 'Body: ' . $post['body'] . '<br>';
        $html .= 'Created At: ' . $post['created_at'] . '<br>';
        $html .= 'Updated At: ' . $post['updated_at'] . '<br>';
        $html .= '</li>';
    }

    $html .= '</ul>';

    // Fermer la connexion MySQLi
    $mysqli->close();

    // Retourner la chaîne de texte générée
    return $html;
}


function postShow($id){
    // Informations de connexion
    $host = $_ENV['DB_HOST'];
    $database = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $socket = $_ENV['SOCKET'];

    // Connexion à la base de données avec MySQLi
    $mysqli = new mysqli($host, $username, $password, $database, null, $socket);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    // Préparation et exécution de la requête avec la clause WHERE pour filtrer par ID
    $query = $mysqli->prepare("SELECT * FROM posts WHERE id = ?");
    $query->bind_param("i", $id);  // "i" indique un entier (ID)
    $query->execute();

    // Vérifier si la requête a réussi
    $result = $query->get_result();

    // Vérifier si l'article a été trouvé
    if ($result->num_rows === 0) {
        $html = '<h1>Article introuvable</h1>';
    } else {
        // Récupérer l'article
        $post = $result->fetch_assoc();

        // Construire la chaîne de texte HTML
        $html = '<h1>Détails de l\'article</h1>';
        $html .= '<ul>';
        $html .= '<li>ID: ' . $post['id'] . '</li>';
        $html .= '<li>Title: ' . $post['title'] . '</li>';
        $html .= '<li>Body: ' . $post['body'] . '</li>';
        $html .= '<li>Created At: ' . $post['created_at'] . '</li>';
        $html .= '<li>Updated At: ' . $post['updated_at'] . '</li>';
        $html .= '</ul>';
    }

    // Fermer la connexion MySQLi
    $mysqli->close();

    // Retourner la chaîne de texte générée
    return $html;
}

function postCreate($title, $body){
    // Informations de connexion
    $host = $_ENV['DB_HOST'];
    $database = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $socket = $_ENV['SOCKET'];

    // Connexion à la base de données avec MySQLi
    $mysqli = new mysqli($host, $username, $password, $database, null, $socket);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    // Préparation et exécution de la requête d'insertion
    $query = $mysqli->prepare("INSERT INTO posts (title, body) VALUES (?, ?)");
    $query->bind_param("ss", $title, $body);  // "ss" indique deux chaînes (title et body)
    $query->execute();

    // Vérifier si la requête a réussi
    if ($query->affected_rows > 0) {
        $html = '<h1>Article créé avec succès</h1>';
    } else {
        $html = '<h1>Erreur lors de la création de l\'article</h1>';
    }

    // Fermer la connexion MySQLi
    $mysqli->close();

    // Retourner la chaîne de texte générée
    return $html;
}


function postStore(){
    // Vérifier si les clés 'title' et 'body' existent dans $_POST
    if (isset($_POST['title'], $_POST['body'])) {
        // Récupérer les données du formulaire POST
        $title = $_POST['title'];
        $body = $_POST['body'];

        // Informations de connexion
        $host = $_ENV['DB_HOST'];
        $database = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $socket = $_ENV['SOCKET'];

        // Connexion à la base de données avec MySQLi
        $mysqli = new mysqli($host, $username, $password, $database, null, $socket);

        // Vérifier la connexion
        if ($mysqli->connect_error) {
            die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
        }

        // Préparation et exécution de la requête d'insertion
        $query = $mysqli->prepare("INSERT INTO posts (title, body) VALUES (?, ?)");
        $query->bind_param("ss", $title, $body);  // "ss" indique deux chaînes (title et body)
        $query->execute();

        // Vérifier si la requête a réussi
        if ($query->affected_rows > 0) {
            $html = '<h1>Article créé avec succès</h1>';
        } else {
            $html = '<h1>Erreur lors de la création de l\'article</h1>';
        }

        // Fermer la connexion MySQLi
        $mysqli->close();

        // Retourner la chaîne de texte générée
        return $html;
    } else {
        // Si les clés ne sont pas présentes dans $_POST
        return '<h1>Erreur : Les données du formulaire sont manquantes</h1>';
    }
}
