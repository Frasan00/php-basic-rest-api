<?php
require __DIR__ . "/config.php";

class UserController{

    public $path;
    public $method;

    //constructor
    public function __construct(){
        $this->path = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER["REQUEST_METHOD"];
    }

    public function listen(){
        $basePath = "/projects_php/php-basic-rest-api/index.php";
        $userName = $_GET["userName"] ?? null;
        $age = $_GET["age"] ?? null;
        if($this->path === $basePath . "/user") {
            if ($this->method === "GET" && !$userName) { return $this->get(); }
        }
        if ($this->method === "GET" && $userName) { return $this->getOne($userName); }
        if ($this->method === "POST" && $userName && $age) { return $this->addOne($userName, $age); }
        if ($this->method === 'DELETE' && $userName) { return $this->removeOne($userName); }
        
    }

    public function get(){
        $db = connect();
        $users = [];
        $sql = "SELECT * FROM user ORDER BY id";
        $result = $db->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row);
        }
        if($users !== []) return json_encode($users);
        return "There are no users";
    } 

    public function getOne(string $userName){
        $db = connect();
        $users = [];
        $sql = "SELECT * FROM user WHERE userName='${userName}'";
        $result = $db->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row);
        }
        if($users !== [])return json_encode($users);
        return "There is no user with that name";
    }

    public function addOne(string $userName, int $age){
        $db = connect();
        $users = [];

        $check = "SELECT userName FROM user WHERE userName='${userName}'";
        $result = $db->query($check);
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row);
            break; // just need one match
        }
        if($users !== []) return "User already exists";
 
        $id = uniqid();
        $sql = "INSERT INTO user (id, userName, age) VALUES ('${id}', '${userName}', '${age}')";
        $db->query($sql);
        return "User added with success ";
    }

    public function removeOne(string $userName){
        $db = connect();
        $sql = "DELETE FROM user WHERE userName='${userName}'";
        $result = $db->query($sql);
        return "User eliminated";
    }
}
?>