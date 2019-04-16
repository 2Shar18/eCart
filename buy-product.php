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

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // mysql inserting a new row
    $result = mysqli_query($db,"SELECT * FROM cart WHERE id = $id");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $row = mysqli_fetch_row($result);
        $uid = $row[1];
        $pid = $row[2];
        $quantity = $row[3];

        $result = mysqli_query($db,"SELECT * FROM product WHERE id = $pid");
        $row = mysqli_fetch_row($result);
        if ($row[4] >= $quantity) {

            $q = $row[4] - $quantity;
            $result = mysqli_query($db,"UPDATE product SET quantity = $q WHERE id = $pid");
            $result = mysqli_query($db,"DELETE FROM cart WHERE id = $id");

            $result = mysqli_query($db,"SELECT * FROM history WHERE user_id = $uid and product_id = $pid");
            $row = mysqli_fetch_row($result);
            $cid = $row[0];

            if (mysqli_num_rows($result) == 1) {
                $quantity = $quantity + $row[3];
                $result = mysqli_query($db,"UPDATE history SET quantity = $quantity WHERE id = $cid");
                if ($result) {
                    // successfully inserted into database
                    $response["success"] = 1;
                    $response["message"] = "History Updated.";

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
                $result = mysqli_query($db,"INSERT INTO history(id, user_id, product_id, quantity) VALUES(NULL,$uid, $pid, $quantity)");

                // check if row inserted or not
                if ($result) {
                    // successfully inserted into database
                    $response["success"] = 1;
                    $response["message"] = "Product Added to History.";

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
            $response["success"] = 0;
            $response["message"] = "Sold Out!";

            $result = mysqli_query($db,"DELETE FROM cart WHERE id = $id");
            echo json_encode($response);
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