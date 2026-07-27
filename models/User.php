<?php

class User
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function register($name, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password) 
                VALUES (:name, :email, :password)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        return $stmt->execute();
    }
    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function login($email, $password)
    {
        $user = $this->findByEmail($email);

        if (!$user)
        {
            return false;
        }

        if (!password_verify($password, $user["password"]))
        {
            return false;
        }
        $token = bin2hex(random_bytes(32));
        $this->updateToken($user["id"], $token);
        return $token;
    }
    public function findByToken($token)
    {
        $query = "SELECT * FROM users WHERE api_token = :token";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":token", $token);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateToken($userId, $token)
    {
        $query = "UPDATE users
                SET api_token = :token
                WHERE id = :userId";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":userId", $userId);

        return $stmt->execute();
    }
}