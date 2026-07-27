<?php

require_once "../config/database.php";
require_once "../models/User.php";

class UserController
{
    private User $user;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->user = new User($db);
    }

public function register()
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        empty($data["name"]) ||
        empty($data["email"]) ||
        empty($data["password"])
    )
    {
        echo json_encode([
            "message" => "All fields are required."
        ]);

        return;
    }

    $success = $this->user->register(
        $data["name"],
        $data["email"],
        $data["password"]
    );

    if ($success)
    {
        echo json_encode([
            "message" => "User registered successfully."
        ]);
    }
    else
    {
        echo json_encode([
            "message" => "Registration failed."
        ]);
    }
}
public function login()
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        empty($data["email"]) ||
        empty($data["password"])
    )
    {
        echo json_encode([
            "message" => "Email and password are required."
        ]);

        return;
    }

    $token = $this->user->login(
        $data["email"],
        $data["password"]
    );

    if ($token)
    {
        echo json_encode([
            "token" => $token
        ]);
    }
    else
    {
        echo json_encode([
            "message" => "Invalid email or password."
        ]);
    }
}
}