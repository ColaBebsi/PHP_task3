<?php 
// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "../classes/Database.class.php";
include_once "../classes/Transaction.class.php";

// Instantiate DB & connect 
$database = new Database();
$db = $database->connect();

// Instantiate Transaction
$transaction = new Transaction($db);

// Get raw transaction data
$data = json_decode(file_get_contents('php://input'));

// Set properties
$transaction->from_amount = $data->from_amount;
$transaction->from_account = $data->from_account;
$transaction->to_amount = $data->to_amount;
$transaction->to_account = $data->to_account;

/* if ($transaction->createTransaction()) {
    echo json_encode(
        array("message" => "Transaction created!")
    );
} else {
    echo json_encode(
        array("message" => "Transaction NOT created!")
    );
} */

// Create transaction and check for balance 
try {
    if ($transaction->createTransaction($transaction->getBalance($transaction->from_account), $transaction->from_amount)) {
        echo json_encode(array("msg" => "Transaction succesful!"));
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage(); 
}