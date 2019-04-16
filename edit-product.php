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
    // $id = $request->id;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // mysql inserting a new row
    $result = mysqli_query($db,"SELECT * FROM product WHERE id = $id");

    // check if row inserted or not
    if ($result) {
            $result = mysqli_query($db,"UPDATE product SET name = '$name', price = $price, weight = $weight, quantity = $quantity WHERE id = $id");
            if($result){
                header("Location: admin.php");
            }
            else{
                echo "UPDATE product SET name = $name, price = $price, weight = $weight, quantity = $quantity WHERE id = $id";
            }

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