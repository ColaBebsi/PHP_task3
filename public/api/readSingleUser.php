<?php 
// Header 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../classes/Database.class.php";
include_once "../classes/User.class.php";

// Instantiate DB & connect 
$database = new Database();
$db = $database->connect();

// Instantiate User 
$user = new User($db);

// Get account ID
$user->account_id = isset($_GET["account_id"]) ? $_GET["account_id"] : die();

// Get single user
$user->readSingle();

// Create array
$user_arr = array(
    "id" => $user->id,
    "firstName" => $user->firstName,
    "lastName" => $user->lastName,
    "username" => $user->username,
    "password" => $user->password,
    "account_id" => $user->account_id,
    "balance" => $user->balance
);

// Make JSON
print_r(json_encode($user_arr));