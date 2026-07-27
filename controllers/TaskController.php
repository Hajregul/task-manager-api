<?php

require_once "../config/database.php";
require_once "../models/Task.php";

class TaskController
{
    private Task $task;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->task = new Task($db);
    }
    public function getAll()
    {
        echo json_encode($this->task->getAll());
    }
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (
            empty($data["user_id"]) ||
            empty($data["title"]) ||
            empty($data["description"])
        )
        {
            echo json_encode([
                "message" => "Task id, title and description are required."
            ]);

            return;
        }

        $success = $this->task->create(
            $data["user_id"],
            $data["title"],
            $data["description"]
        );

        if ($success)
        {
            echo json_encode([
            "message" => "Task created successfully"
            ]);
        }
        else
        {
            echo json_encode([
                "message" => "Failed to create task"
            ]);
        }
    }
    public function update()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if(
            empty($data['id']) ||
            empty($data['title']) ||
            empty($data['description'])
        )
        {
            echo json_encode([
                "message" => "User ID, title and description are required."
            ]);

            return;
        }

        $success = $this->task->update(
            $data["id"],
            $data["title"],
            $data["description"]
        );

        if ($success)
        {
            echo json_encode([
            "message" => "Task updated successfully"
            ]);
        }
        else
        {
            echo json_encode([
                "message" => "Failed to update task"
            ]);
        }
    }
    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if(
            empty($data['id'])
        )
        {
            echo json_encode([
                "message" => "Task ID is required."
            ]);

            return;
        }

        $success = $this->task->delete(
            $data["id"]
        );

        if ($success)
        {
            echo json_encode([
            "message" => "Task deleted successfully"
            ]);
        }
        else
        {
            echo json_encode([
                "message" => "Failed to delete task"
            ]);
        }
    }
}