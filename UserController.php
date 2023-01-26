<?php
require __DIR__ . "/config.php";

class UserController{

    private $path = $_SERVER['REQUEST_URI'];
    private $method = $_SERVER["REQUEST_METHOD"];

    public function listen(){
        $basePath = "http://localhost/progetti/php-basic-rest-api/index.php";
        switch ($this->path) {
            case $basePath . "/user":
                if ($this->method === "GET") {
                    
                }
        }
    }

    public function get(){
        $db = connect();
        $users = [];
        $sql = "SELECT * FROM user ORDER BY id";
        $result = $db->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row);
        }
        return json_encode($users);
    } 
}
?>