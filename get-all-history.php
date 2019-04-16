<?php

$response = array();
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');

// include db connect class
require_once __DIR__ . '/db_connect.php';

// get all products from products table
$result = mysqli_query($db,"SELECT * FROM history");
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id"] = $row["id"];
        $uid = $row["user_id"];
        $pid = $row["product_id"];
        $res = mysqli_query($db,"SELECT * FROM product WHERE id = $pid");
        $res1 = mysqli_query($db,"SELECT * FROM login WHERE id = $uid");
        $row1 = mysqli_fetch_array($res);
        $row2 = mysqli_fetch_array($res1);
        $product["name"] = $row1["name"];
        $product["price"] = $row1["price"];
        $product["weight"] = $row1["weight"];
        $product["quantity"] = $row1["quantity"];
        $product["select"] = $row["quantity"];
        $product["user"] = $row2["user"];

        // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    echo json_encode($response);
}
?>
