<?php

include 'database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if
(
    !isset($_GET['id']) ||
    empty($_GET['id']) ||
    !is_numeric($_GET['id'])
) 
{
    header('Location: index.php');
}

$db = new Database();

$get_unos = $db->get_unos($_GET['id']);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST['delete_unos'])) {
        $db->delete_unos($_POST);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisanje</title>
</head>
    <body>
        <p>
            <a href="index.php"><< Povratak na početnu</a>
        </p>
        <hr>
        
        <h3>Sigurno želiš izbrisati unos?</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $get_unos['id']; ?>">        
            <input type="submit" name="delete_unos" value="Da!">
        </form>
    </body>
</html>