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
$result = mysqli_query($db,"SELECT * FROM product") or die(mysql_error());

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id"] = $row["id"];
        $product["name"] = $row["name"];
        $product["price"] = $row["price"];
        $product["weight"] = $row["weight"];
        $product["quantity"] = $row["quantity"];

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
