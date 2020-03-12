<?php 
class User
{   
    // DB stuff
    private $conn;
    private $view = "bank.vw_users";

    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $account_id;
    public $balance;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Create query
        $query = "SELECT id, firstName, lastName, username, password, account_id, balance FROM $this->view";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function readSingle() 
    {
        // Create query 
        $query = "SELECT id, firstName, lastName, username, password, account_id, balance 
        FROM $this->view WHERE account_id = ? LIMIT 0, 1";

        // Prepare query 
        $stmt = $this->conn->prepare($query);

        // Bind parameter to variable
        $stmt->bindParam(1, $this->account_id);

        // Execute query 
        $stmt->execute();

        // Fetch row 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row["id"];
        $this->firstName = $row["firstName"];
        $this->lastName = $row["lastName"];
        $this->username = $row["username"];
        $this->password = $row["password"];
        $this->account_id = $row["account_id"];
        $this->balance = $row["balance"];

    }
}