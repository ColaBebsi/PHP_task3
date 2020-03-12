<?php 

// require_once "../../vendor/autoload.php";
// $dotenv = Dotenv\Dotenv::createImmutable("../../");
// $dotenv->load();

class Database
{   
    private $conn;
    
    private $host = "localhost";
    private $db_name = "bank";
    private $username = "root";
    private $password = "";
    

    public function connect()
    {
        $this->conn = null;

        // $this->host = $_ENV["DB_HOST"];
        // $this->db_name = $_ENV["DB_DATABASE"];
        // $this->username = $_ENV["DB_USER"];
        // $this->password = $_ENV["DB_PASS"];

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";db_name=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}


