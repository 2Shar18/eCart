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
    $id = $_GET['id'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // mysql update row with matched pid
    $result = mysqli_query($db,"DELETE FROM cart WHERE id = $id");

    // check if row deleted or not
    if (mysqli_affected_rows($db) > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully deleted";

        // echoing JSON response
        echo json_encode($response);
        header("Location: cart.php");
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
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