<?php 
// Header 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../classes/Database.class.php";
include_once "../classes/User.class.php";

// Instantiate DB & connect 
$database = new Database();
$db = $database->connect();

// Instantiate User & read
$user = new User($db);

// Query User
$result = $user->read();

// Get row count
$num = $result->rowCount();

// Check if there are any users
if ($num > 0) {
    $users_arr = array();
    $users_arr["data"] = array();

    // Loop through read method and fetch stuff as assoc arrays
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Converse array pairs to variable names and values
        extract($row);

        // Stuff we want to get
        $user_item = array(
            "id" => $id,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "username" => $username,
            "password" => $password,
            "account_id" => $account_id,
            "balance" => $balance
        );

        // Push stuff to "data" array
        array_push($users_arr["data"], $user_item);
    }
    // Turn array to JSON & output
    echo json_encode($users_arr);
} else {
    echo json_encode(array("message" => "No users found!"));
}
