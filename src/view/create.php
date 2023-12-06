<?php
// Inclure le script qui contient la fonction postIndex
include('../src/model/articles.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <?php

     $html = '<h1>Création d\'un nouvel article</h1>';
     $html .= '<form action="" method="post">';
     $html .= '<label for="title">Titre :</label>';
     $html .= '<input type="text" name="title" id="title" required><br>';
     $html .= '<label for="body">Contenu :</label>';
     $html .= '<textarea name="body" id="body" required></textarea><br>';
     $html .= '<input type="submit" value="Créer l\'article">';
     $html .= '</form>';
 
     // Retourner le formulaire HTML
     echo ($html);
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {   

        $title=$_POST['title'];
        $body=$_POST['body'];
        echo postCreate($title,$body);
    }
     
     
           
    ?>
</body>
</html>
