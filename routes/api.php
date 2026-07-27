<?php

$route = str_replace(
    "/task-manager-api/public",
    "",
    parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)
);

$method = $_SERVER["REQUEST_METHOD"];

header("Content-Type: application/json");

require_once "../controllers/UserController.php";
require_once "../controllers/TaskController.php";
require_once "../middleware/AuthMiddleware.php";

$userController = new UserController();
$taskController = new TaskController();
$authMiddleware = new AuthMiddleware();

if ($method === "POST" && $route === "/register")
{
    $userController->register();
    exit;
}

if ($method === "POST" && $route === "/login")
{
    $userController->login();
    exit;
}

if ($method === "GET" && $route === "/tasks")
{
    $authMiddleware->authenticate();
    $taskController->getAll();
    exit;
}

if ($method === "POST" && $route === "/tasks")
{
    $authMiddleware->authenticate();
    $taskController->create();
    exit;
}

if ($method === "PUT" && $route === "/tasks")
{
    $authMiddleware->authenticate();
    $taskController->update();
    exit;
}

if ($method === "DELETE" && $route === "/tasks")
{
    $authMiddleware->authenticate();
    $taskController->delete();
    exit;
}

http_response_code(404);

echo json_encode([
    "message" => "Route not found"
]);