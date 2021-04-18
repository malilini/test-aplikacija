<?php 

class Database {

private $dbhost = 'remotemysql.com';
private $dbname = 'mGZmUr5Loc';
private $dbuser = 'mGZmUr5Loc';
private $dbpass = 'UUWN1X7a44';
private $connection;

    public function __construct() 
    {
        $dsn = "mysql:host=".$this->dbhost.";dbname=".$this->dbname;

        try {

            $pdo = new PDO($dsn, $this->dbuser, $this->dbpass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connection = $pdo;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create_unos($params) {

        try {

            $id = $params['id'];
            $tekst = $params['tekst'];

            $stmt = $this->connection->prepare(
                "INSERT INTO unos (id, tekst) VALUES (:id, :tekst)"
            );

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':tekst', $tekst);

            $stmt->execute();

            header('Location: index.php');

        } catch(PDOException $e) {

            $this->connection->rollBack();
            throw $e;
        }
    }

    public function get_unosi() {

        $unosi = [];

        try {

            $stmt = $this->connection->prepare("SELECT * FROM unos");

            $stmt->execute();

            if($stmt->rowCount()) {
                $unosi = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return $unosi;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update_unos($params) {

        try {

            $id = $params['id'];
            $tekst = $params['tekst'];

            $stmt = $this->connection->prepare(
                "UPDATE unos SET tekst = :tekst WHERE id = :id"
            );

            $stmt->bindParam('id', $id);
            $stmt->bindParam('tekst', $tekst);

            $stmt->execute();

            header('Location: index.php');

        } catch(PDOException $e) {
            return $e->getMessage();
        }

    }

    public function delete_unos($params) {

        try {

            $id = $params['id'];

            $stmt = $this->connection->prepare(
                "DELETE FROM unos WHERE id = :id"
            );

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            header('Location: index.php');

        } catch (PDOException $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    public function get_unos($id) {

        $tekst = [];

            $stmt = $this->connection->prepare(
                "SELECT * FROM unos WHERE id = :id"
            );

            $stmt->bindParam(':id', $id);

            $result = $stmt->execute();

            if($stmt->rowCount()) {
                $tekst = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            return $tekst;

    }






    

}

?>