# Task Manager REST API

A simple REST API built with PHP and MySQL using MVC architecture and PDO.
## Installation

1. Clone the repository

```bash
git clone https://github.com/Hajregul/task-manager-api.git
```

2. Copy the project to your XAMPP `htdocs` folder.

3. Create a MySQL database named:

```
task_manager
```

4. Import:

```
database/database.sql
```

5. Start Apache and MySQL.

6. Open:

```
http://localhost/task-manager-api/public
```
## Features

- User registration
- User login
- Token-based authentication
- Protected routes using Bearer Token
- CRUD operations for tasks
- RESTful API
- MVC architecture
- PDO database access

## Technologies

- PHP 8
- MySQL
- PDO
- Apache (XAMPP)
- Postman

## Project Structure

```
task-manager-api/
│
├── config/
├── controllers/
├── middleware/
├── models/
├── public/
├── routes/
└── README.md
```

## API Endpoints

### Register

POST `/register`

```json
{
    "name":"John",
    "email":"john@test.com",
    "password":"123456"
}
```

### Login

POST `/login`

```json
{
    "email":"john@test.com",
    "password":"123456"
}
```

Response

```json
{
    "token":"your_api_token"
}
```

### Get Tasks

GET `/tasks`

Authorization

```
Bearer your_api_token
```

### Create Task

POST `/tasks`

```json
{
    "user_id":1,
    "title":"Finish project",
    "description":"Complete REST API"
}
```

### Update Task

PUT `/tasks`

```json
{
    "id":1,
    "title":"Updated title",
    "description":"Updated description"
}
```

### Delete Task

DELETE `/tasks`

```json
{
    "id":1
}
```

## HTTP Status Codes

| Code | Description |
|------|-------------|
| 200 | OK |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 404 | Route Not Found |

## Author

Hajrija Muhić