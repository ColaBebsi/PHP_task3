<?php 
class Transaction
{
    //DB stuff
    private $conn;
    private $table = "bank.transactions";
    private $view = "bank.vw_users";

    // Transaction properties
    public $transaction_id;
    public $from_amount;
    public $from_account;
    public $to_amount;
    public $to_account;

    // Connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Setters
    public function setFromAmount($from_amount)
    {
        $this->from_amount = $from_amount;
    }

    public function setFromAccount($from_account)
    {
        $this->from_account = $from_account;
    }

    public function setToAmount($to_amount)
    {
        $this->to_amount = $to_amount;
    }

    public function setToAccount($to_account)
    {
        $this->to_account = $to_account;
    }

    // Read transaction
    public function readTransaction()
    {
        // Create query 
        $query = "SELECT transaction_id, from_amount, from_account, to_amount, to_account FROM $this->table";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create transaction
    public function createTransaction($balance, $amountSent) 
    {
        $this->checkBalance($balance, $amountSent);

        try {
            // Create query
            $query = "INSERT INTO $this->table (from_amount, from_account, to_amount, to_account)
            VALUES (:fromAmount, :fromAccount, :toAmount, :toAccount)";

            // Prepare query
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->from_amount = htmlspecialchars(strip_tags($this->from_amount));
            $this->from_account = htmlspecialchars(strip_tags($this->from_account));
            $this->to_amount = htmlspecialchars(strip_tags($this->to_amount));
            $this->to_account = htmlspecialchars(strip_tags($this->to_account));

            // Bind parameters to variables
            $stmt->bindParam(":fromAmount", $this->from_amount);
            $stmt->bindParam(":fromAccount", $this->from_account);
            $stmt->bindParam(":toAmount", $this->to_amount);
            $stmt->bindParam(":toAccount", $this->to_account);

            // Execute query
            $stmt->execute();

            return $stmt;

        } catch (Exception $e) {
            die('Errorr creating transaction: ') . $e->getMessage();
        }
    }

    /* // Get balance
    public function getBalance($account_id)
    {
        // Create query 
        $query = "SELECT balance FROM $this->view WHERE account_id = ? LIMIT 0, 1";

        // Prepare query 
        $stmt = $this->conn->prepare($query);

        // Bind parameter to variable
        $stmt->bindParam(1, $this->account_id);

        // Execute query 
        $stmt->execute();

        // Fetch row
        $row = $stmt->fetch();

        return $row['balance'];
    } */

    // Get balance
    public function getBalance($from_account) {
        // Create query
        $query = "SELECT balance FROM $this->view WHERE account_id = :account LIMIT 0, 1";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Bind parameter to variable
        $stmt->bindParam(':account', $this->from_account);

        // Execute query
        $stmt->execute();

        // Fetch data
        $data = $stmt->fetchAll();

        return $data[0]["balance"];
    }

    // Check balance
    public function checkBalance($balance, $amountSent)
    {
        // Check if balance is more than 0 OR amount sent 
        if($balance < 0 || $balance < $amountSent) {
            throw new Exception("You do not have enough money!");
        } 
        return true;
    }
}