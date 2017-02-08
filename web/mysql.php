<?php

namespace Web\DataModel;

use PDO;

class MySQL
{
    private $dsn;
    private $user;
    private $password;

    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;

        $columns = array(
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ',
            'name VARCHAR(255) NOT NULL',
            'email VARCHAR(255) NOT NULL',
            'comment VARCHAR(1024) NOT NULL',
            'created DATETIME DEFAULT CURRENT_TIMESTAMP'
        );

        $this->columnNames = array_map(function ($columnDefinition) {
            return explode(' ', $columnDefinition)[0];
        }, $columns);
        $columnText = implode(', ', $columns);
        $pdo = $this->newConnection();
        $pdo->query("CREATE TABLE IF NOT EXISTS guests ($columnText)");
    }

    /**
     * Creates a new PDO instance and sets error mode to exception.
     *
     * @return PDO
     */
    private function newConnection()
    {
        $pdo = new PDO($this->dsn, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public function listGuests()
    {
        $pdo = $this->newConnection();
        $query = 'SELECT name, email, comment, created FROM guests ORDER BY created DESC';
        $statement = $pdo->prepare($query);
        $statement->execute();
        $rows = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($rows, $row);
        }
        return $rows;
    }

    public function create($guest)
    {
        $pdo = $this->newConnection();
        $names = array_keys($guest);
        $placeHolders = array_map(function ($key) {
            return ":$key";
        }, $names);
        $sql = sprintf(
            'INSERT INTO guests (%s) VALUES (%s)',
            implode(', ', $names),
            implode(', ', $placeHolders)
        );
        $statement = $pdo->prepare($sql);
        $statement->execute($guest);
        return $pdo->lastInsertId();
    }

    public function read($id)
    {
        $pdo = $this->newConnection();
        $statement = $pdo->prepare('SELECT * FROM guests WHERE id = :id');
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}
