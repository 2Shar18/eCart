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
    // $pid = $request->pid;
    // $quantity = $request->quantity;
    $user = $_POST['user'];
    $pid = $_POST['pid'];
    $quantity = $_POST['quantity'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
    $result = mysqli_query($db,"SELECT id FROM login WHERE user = '$user'");
    $row = mysqli_fetch_row($result);
    $uid = $row[0];
    $result = mysqli_query($db,"SELECT * FROM cart WHERE user_id = $uid and product_id = $pid");
    $row = mysqli_fetch_row($result);
    $cid = $row[0];

    if (mysqli_num_rows($result) == 1) {
        $row=mysqli_fetch_row($result);
        $result = mysqli_query($db,"UPDATE cart SET quantity = $quantity WHERE id = $cid");
        if ($result) {
            // successfully inserted into database
            $response["success"] = 1;
            $response["message"] = "Cart Updated.";

            // echoing JSON response
            echo json_encode($response);
            header("Location: cart.php");
        } else {
            // failed to insert row
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";
            
            // echoing JSON response
            echo json_encode($response);
        }
    } else {
        // mysql inserting a new row
        $result = mysqli_query($db,"INSERT INTO cart VALUES(NULL,$uid, $pid, $quantity)");

        // check if row inserted or not
        if ($result) {
            // successfully inserted into database
            $response["success"] = 1;
            $response["message"] = "Product Added to Cart.";

            // echoing JSON response
            echo json_encode($response);
            header("Location: cart.php");
        } else {
            // failed to insert row
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";
            
            // echoing JSON response
            echo json_encode($response);
        }
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>