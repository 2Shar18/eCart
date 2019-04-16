<?php

$response = array();
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

// check for required fields
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $postdata = file_get_contents("php://input");
    // $request = json_decode($postdata);
    // $user = $request->user;
    // $pass = $request->pass;
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // mysql inserting a new row
    $result = mysqli_query($db,"INSERT INTO login VALUES(null, '$user', '$pass', 'user')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>