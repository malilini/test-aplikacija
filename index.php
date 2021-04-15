<?php

include 'database.php';

$db = new Database();

$unosi = $db->get_unosi();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST['unos'])) {
        $db->insert($_POST);
    }
}

echo 'Ovo je naša druga aplikacija na produkciji!';
echo '<br><br>';

echo date('d.m.Y H:i:s', time());
echo '<hr>';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heroku test 2</title>
</head>
<body>

    <h3>Unos novog teksta</h3>

    <div>
    <form action="" method="POST">
        <input type="text" id="tekst" name="tekst">
        <br><br>
        <input type="submit" name="unos" value="Spremi">
    </form>
    </div>


    <h3> Ispis svih tekstova iz baze podataka</h3>
    <table border="1">
        <tr>
            
            <th>Tekst</th>
        </tr>

        <?php if(!empty($unosi)): ?>
            <?php foreach($unosi as $unos): ?>
                <tr>
                    <td><?php echo $unos['unos']; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>

    </table>

</body>
</html>
