<?php

namespace Core;

use PDO;
use PDOStatement;
use PDOException;

class Database
{
    private const DRIVER = DB_DRIVER;

    private const HOST = DB_HOST;

    private const USER = DB_USER;

    private const PASSWORD = DB_PASS;

    private const PORT = HOST_PORT;
    
    private const DATABASE = DB_NAME;

    private const DSN = self::DRIVER . ':host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE;

    private PDO $pdo;

    private PDOStatement $statement;

    private const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    public function __construct()
    {
        try {

            $this->pdo = new PDO(
                self::DSN,
                self::USER,
                self::PASSWORD,
                self::OPTIONS
            );

        } catch (PDOException $e) {

            $this->error = $e->getMessage();
        }
    }

    public function query(string $sql)
    {
        $this->statement = $this->pdo->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->statement->execute();
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchBool()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_COLUMN);
    }

    public function save()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }
}