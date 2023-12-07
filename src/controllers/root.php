<?php

// Inclure les fichiers nécessaires, comme le fichier contenant la logique métier

// Récupérer la variable d'action depuis la requête
$action = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$action = trim($action, '/'); 

// Définir les différentes actions et leurs traitements

switch ($action) {
    //page accueil
    case '':
        include("../src/view/home.php");
        break;

      // page pour creer un nouvelle articles
        case 'articles/create':
            include("../src/view/create.php");
            break;

    
    
    // page store
    case 'articles':
        include("../src/view/store.php");
        break;


        //page affichage articles
    case 'articles':
        if (empty($_GET['id'])) {
        include('../src/view/articles.php');

        }else {
            // la page qui affiche 1 article en fonction de l'id dans le get
            include('../src/view/articles_id.php');
        }
        break;





    default:
    echo('erreur 404');
        // Gérer les cas non prévus
        break;
}
