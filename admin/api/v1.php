<?php

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
ini_set('log_errors', true);
ini_set('error_log', './php-error.log');
include("../lib/config.php");

$keyId = 'rzp_live_PnH6hXuq0ds6JA';
$keySecret = '1uuH5tmj6QJg4L8dVEB4B72i';

$displayCurrency = 'INR';


$json["data"] = [];
$json["error"] = array("code" => "#200", "description" => "Success.");

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Calcutta');

$emailRegex  =  '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
$phoneRegex  =  '/^[0-9]{10}$/';
$nameRegex   =  '/^[a-zA-Z ]{2,30}$/';


function sendGCM($title, $message, $id)
{
    $serverKey = 'AAAA2UFn85k:APA91bGul4JaKjNhqETgWEYMA0Jm2rm9Jv9GKEOfTP7yO_2nXi4RrAJX6j2miMfufcJtT0urZJLmHgWvHzQwKPVca1SgLMBqdJyMzN7BX3EX0WoFZ3vMDecXPQ7iig1GZZJ0bxv8CCgM';
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' => $id,
        'data' => array(
            "title" => $title,
            "message" => $message,
        )
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . $serverKey,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$datetime = date("Y-m-d H:i:s");
if (isset($_REQUEST["mode"])) {
    $mode = $_REQUEST["mode"];
    if ($mode == 'adminlogin') {
        if (isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {
            try {
                $email = trim(htmlspecialchars($_REQUEST["email"]));
                $password = trim(htmlspecialchars($_REQUEST["password"]));
                $regid = trim(htmlspecialchars($_REQUEST["regid"] ?? ""));
                if (trim($email) == "" || trim($password) == "") {
                    $json["error"] = array("code" => "#400", "description" => "Please enter email and password.");
                    echo json_encode($json);
                    exit;
                }
                if (strlen($password) < 5) {
                    $json["error"] = array("code" => "#400", "description" => "Password must be at least 5 characters.");
                    echo json_encode($json);
                    exit;
                }
                // $sql = "SELECT * FROM admins WHERE (email = :email AND password = :password) AND (role = 'admin' OR role = 'subadmin')";
                // $stmt = $pdoConn->prepare($sql);
                // $stmt->bindParam(":email", $email);
                // $stmt->bindParam(":password", $password);
                // $stmt->execute();
                // $result = $stmt->fetchAll();
                $sql = "SELECT * FROM admins WHERE (email = ? AND password = ?) AND (role = 'admin' OR role = 'subadmin')";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('ss', $email, $password);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) > 0) {
                    $id = $result[0]["id"];
                    $token = getSessionToken($mysqli, $result[0]['email'], $id);
                    $json["error"] = array("code" => "#200", "description" => "Success.");
                    $json["data"] = array(
                        "token" => $token,
                        "id" => $id,
                        "fullname" => $result[0]["fullname"],
                        "email" => $result[0]["email"],
                        "role" => $result[0]["role"],
                    );
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $result[0]["email"];
                    $_SESSION['fullname'] = $result[0]["fullname"];
                    $_SESSION['email'] = $result[0]["email"];
                    $_SESSION['role'] = $result[0]["role"];
                    $_SESSION['token'] = $token;
                    $json["error"] = array("code" => "#200", "description" => "Success.");
                } else {
                    $json["error"] = array("code" => "#400", "description" => "Invalid email or password.");
                }
            } catch (Exception $e) {
                $json["error"] = array("code" => "#500", "description" => $e->getMessage());
            }
        } else {
            $json["error"] = array("code" => "#400", "description" => "email and password are required.");
        }
    } else if ($mode == 'addevent') {
        // mode: addevent
        // product_name: images
        // product_description: 100
        // distributor_price: 100
        // retailer_price: 100
        // mrp_price: 100
        // product_images: 1706351660_65b4dc2c477018.18770701.png
        if (
            isset($_REQUEST['product_name']) &&
            isset($_REQUEST['product_description']) &&
            isset($_REQUEST['distributor_price']) &&
            isset($_REQUEST['retailer_price']) &&
            isset($_REQUEST['mrp_price']) &&
            isset($_REQUEST['product_images']) &&
            isset($_REQUEST['available']) &&
            isset($_REQUEST['status'])
        ) {
            $name = trim(htmlspecialchars($_REQUEST['product_name']));
            $description  = trim(htmlspecialchars($_REQUEST['product_description']));
            $distributor_price = trim(htmlspecialchars($_REQUEST['distributor_price']));
            $retailer_price = trim(htmlspecialchars($_REQUEST['retailer_price']));
            $mrp_price = trim(htmlspecialchars($_REQUEST['mrp_price']));
            $images = trim(htmlspecialchars($_REQUEST['product_images']));
            $available = trim(htmlspecialchars($_REQUEST['available']));
            $status = trim(htmlspecialchars($_REQUEST['status']));

            $token = trim(htmlspecialchars($_SESSION['token']));
            $email  = trim(htmlspecialchars($_SESSION['email']));

            try {
                // $sql = "INSERT INTO products (product_name, product_description, distributor_price, retailer_price, mrp_price, product_images, created_at) VALUES (:name, :description, :distributor_price, :retailer_price, :mrp_price, :image, NOW())";
                // $stmt = $pdoConn->prepare($sql);
                // $stmt->bindParam(":name", $name);
                // $stmt->bindParam(":description", $description);
                // $stmt->bindParam(":distributor_price", $distributor_price);
                // $stmt->bindParam(":retailer_price", $retailer_price);
                // $stmt->bindParam(":mrp_price", $mrp_price);
                // $stmt->bindParam(":image", $images);
                // $stmt->execute();
                $sql = "INSERT INTO products (product_name, product_description, distributor_price, retailer_price, mrp_price, product_images, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('ssssss', $name, $description, $distributor_price, $retailer_price, $mrp_price, $images);
                $stmt->execute();
                $json["error"] = array("code" => "#200", "description" => "Success.");
            } catch (Exception $e) {
                $json["error"] = array("code" => "#500", "description" => $e->getMessage());
            }
        } else {
            $json["error"] = array("code" => "#400", "description" => "Invalid request 1.");
        }
    } else if ($mode == 'editproduct') {
        if (
            isset($_REQUEST['productid']) &&
            isset($_REQUEST['product_name']) &&
            isset($_REQUEST['product_description']) &&
            isset($_REQUEST['distributor_price']) &&
            isset($_REQUEST['retailer_price']) &&
            isset($_REQUEST['mrp_price']) &&
            isset($_REQUEST['available']) &&
            isset($_REQUEST['status']) &&
            isset($_REQUEST['product_images'])
        ) {
            $id = trim(htmlspecialchars($_REQUEST['productid']));
            $name = trim(htmlspecialchars($_REQUEST['product_name']));
            $description  = trim(htmlspecialchars($_REQUEST['product_description']));
            $distributor_price = trim(htmlspecialchars($_REQUEST['distributor_price']));
            $retailer_price = trim(htmlspecialchars($_REQUEST['retailer_price']));
            $mrp_price = trim(htmlspecialchars($_REQUEST['mrp_price']));
            $images = trim(htmlspecialchars($_REQUEST['product_images']));
            $available = trim(htmlspecialchars($_REQUEST['available']));
            $status = trim(htmlspecialchars($_REQUEST['status']));
            try {
                // $sql = "UPDATE products SET product_name = :name, product_description = :description, distributor_price = :distributor_price, retailer_price = :retailer_price, mrp_price = :mrp_price, product_images = :image WHERE id = :id";
                // $stmt = $pdoConn->prepare($sql);
                // $stmt->bindParam(":name", $name);
                // $stmt->bindParam(":description", $description);
                // $stmt->bindParam(":distributor_price", $distributor_price);
                // $stmt->bindParam(":retailer_price", $retailer_price);
                // $stmt->bindParam(":mrp_price", $mrp_price);
                // $stmt->bindParam(":image", $images);
                // $stmt->bindParam(":id", $id);
                // $stmt->execute();
                $sql = "UPDATE products SET product_name = ?, product_description = ?, distributor_price = ?, retailer_price = ?, mrp_price = ?, product_images = ?, available = ?, status = ? WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('ssssssiii', $name, $description, $distributor_price, $retailer_price, $mrp_price, $images, $available, $status, $id);
                $stmt->execute();
                $json["error"] = array("code" => "#200", "description" => "Success.");
            } catch (Exception $e) {
                $json["error"] = array("code" => "#500", "description" => $e->getMessage());
            }
        } else {
            $json["error"] = array("code" => "#400", "description" => "Invalid request 1.");
        }
    } else if ($mode == 'deleteproduct') {
        if (isset($_REQUEST['productid'])) {
            $id = trim(htmlspecialchars($_REQUEST['productid']));
            $token = trim(htmlspecialchars($_SESSION['token']));
            $email  = trim(htmlspecialchars($_SESSION['email']));
            try {
                $userAuth  = validateSessionToken($mysqli, $token, $email);
                if ($userAuth) {
                    // $sql = "DELETE FROM products WHERE id = :id";
                    // $stmt = $pdoConn->prepare($sql);
                    // $stmt->bindParam(":id", $id);
                    // $stmt->execute();
                    $sql = "DELETE FROM products WHERE id = ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param('s', $id);
                    $stmt->execute();
                    $json["error"] = array("code" => "#200", "description" => "Success.");
                } else {
                    $json["error"] = array("code" => "#400", "description" => "Invalid token.");
                }
            } catch (Exception $e) {
                $json["error"] = array("code" => "#500", "description" => $e->getMessage());
            }
        } else {
            $json["error"] = array("code" => "#400", "description" => "Invalid request.");
        }
    } else {
        $json['error'] = array("code" => "#403", "description" => "Invalid mode.");
    }
} else {
    $json["error"] = array("code" => "#403", "description" => "Mode is required.");
}

unset($json["regid"]);
echo json_encode($json);
