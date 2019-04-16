<?php

$response = array();
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: *');

// check for required fields
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user = $_GET['user'];
    $pass = $_GET['pass'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // mysql selecting the new row
    $result = mysqli_query($db,"SELECT * FROM login WHERE user = '$user' and pass = '$pass'");

    // check if row inserted or not
    if (mysqli_num_rows($result) == 1) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully Logged In.";

        // echoing JSON response
        echo json_encode($response);
        session_start();
        $_SESSION['user'] = $user;
        if ($user == 'admin')
            header("Location: admin.php");
        else
            header("Location: main.php");
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