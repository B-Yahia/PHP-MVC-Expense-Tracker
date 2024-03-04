<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{
    private PDO $connection;
    private PDOStatement $statement;

    public function __construct(string $driver, array $config, string $user, string $password)
    {

        $config = http_build_query(data: $config, arg_separator: ';');
        $dsn = $driver . ':' . $config;


        try {
            $this->connection = new PDO($dsn, $user, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []): Database
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);


        return $this;
    }

    public function count()
    {
        return $this->statement->fetchColumn();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function id()
    {
        return $this->connection->lastInsertId();
    }
}
