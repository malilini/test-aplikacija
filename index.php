<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'classes/database.php';

$db = new Database();

$unosi = $db->get_unosi();

$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['tekst'])) {
        $message = 'Molim unesi tekst!';
    
    } else {

        $db->create_unos($_POST);
        //echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heroku test 2</title>
</head>
    <body>

        <h3>Ovo je naša druga aplikacija na produkciji!</h3>
        <br><br>
            <?php echo date('d.m.Y H:i:s', time()); ?>
        <br><br>
            <?php echo 'Evo nešto novo za heroku!'; ?>
        <br><br>
        <hr>

        <div>
            <?php if(!empty($message)) {echo $message; } ?>
                <form method="POST">
                    <input type="text" name="tekst" placeholder="Unesi neki tekst"><br><br>
                    <input type="submit" value="Spremi">
                </form>     
        </div>
        <hr>  
        <br><br>

        <h3> Ispis svih tekstova iz baze podataka</h3>
        <table border="1">
            <tr>
                <th>#</th>
                <th>Tekst</th>
                <th colspan="2">Akcije</th>
            </tr>
                <?php if(!empty($unosi)): ?>
                    <?php foreach($unosi as $unos): ?>
                        <tr>
                            <td><?php echo $unos['id']; ?> </td>                        
                            <td><?php echo $unos['tekst']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $unos['id']; ?>">Ažuriraj</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $unos['id']; ?>">Izbriši</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
        </table>
    </body>
</html>