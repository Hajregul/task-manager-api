<?php

class Database
{
    private string $host = "localhost";
    private string $database = "task_manager";
    private string $username = "root";
    private string $password = "";

   public function connect()
    {
        $conn = null;

        try
        {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
}