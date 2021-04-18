<?php

include 'database.php';

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
    if(empty($_POST['tekst'])) {
        echo "Molim unesi tekst!";
    } else {
        $db->update_unos($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ažuriranje</title>
</head>
    <body>        
        <p>
            <a href="index.php"><< Povratak na početnu</a>
        </p>
        <hr>

        <form method="POST">        
            <input type="hidden" name="id" value="<?php echo $get_unos['id']; ?>">
            <label for="">Tekst</label><br>
            <input type="text" name="tekst" value="<?php echo $get_unos['tekst']; ?>"><br><br>
            <input type="submit" value="Ažuriraj">
        </form>
    </body>
</html>

