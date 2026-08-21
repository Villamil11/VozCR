<?php

class Database
{
    private $host = "db";
    private $db_name = "proyecto";
    private $username = "root";
    private $password = "root";

    public function connect()
    {
        $conn = null;

        try {
            $conn = new PDO(
                "mysql:host=" . $this->host .
                ";dbname=" . $this->db_name .
                ";charset=utf8mb4",
                $this->username,
                $this->password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        return $conn;
    }
}