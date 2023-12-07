

<?php
// Inclure le script qui contient la fonction postEdit
include('../src/model/articles.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
        echo postEdit($id);
    ?>
</body>
</html>
