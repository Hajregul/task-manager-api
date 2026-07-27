<?php

require_once "../config/database.php";
require_once "../models/User.php";

class AuthMiddleware
{
    private User $user;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->user = new User($db);
    }
    public function authenticate()
    {
        $headers = getallheaders();

        if (!isset($headers["Authorization"]))
        {
            http_response_code(401);

            echo json_encode([
                "message" => "Unauthorized"
            ]);

            exit;
        }

        $token = str_replace(
            "Bearer ",
            "",
            $headers["Authorization"]
        );

        $user = $this->user->findByToken($token);

        if (!$user)
        {
            http_response_code(401);

            echo json_encode([
                "message" => "Unauthorized"
            ]);

            exit;
        }
    }
}
