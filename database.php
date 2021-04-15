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


    public function get_unosi() {

        $unosi = [];

        try {

            $stmt = $this->connection->prepare("SELECT Tekst FROM Ispis");
            $stmt->execute();

            if($stmt->rowCount()) {
                $unosi = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return $unosi;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function insert($params) {

        try {
            //započinjanje transakcije
            $this->connection->beginTransaction();

            $unos = intval($params['unos']);

            $stmt = $this->connection->prepare(
                "INSERT INTO Ispis (Tekst) 
                VALUES (:unos)"
            );

            $stmt->bindParam(':unos', $unos);

            $result = $stmt->execute();

            //Izvršiti SQL upit
            $this->connection->commit();

        } catch(PDOException $e) {

            $this->connection->rollBack();
            throw $e;
        }

    }

}

?>