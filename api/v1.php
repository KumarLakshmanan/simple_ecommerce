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
    } else if ($mode == "book") {
        if (
            isset($_REQUEST["patient_name"]) &&
            isset($_REQUEST["patient_address"]) &&
            isset($_REQUEST["patient_phone"]) &&
            isset($_REQUEST["patient_email"]) &&
            isset($_REQUEST["room_id"]) &&
            isset($_REQUEST["payee_type"]) &&
            isset($_REQUEST["payee_name"]) &&
            isset($_REQUEST["card_number"]) &&
            isset($_REQUEST["card_name"]) &&
            isset($_REQUEST["expiry_year"]) &&
            isset($_REQUEST["expiry_month"]) &&
            isset($_REQUEST["cvc"])
        ) {
            $patient_name = trim(htmlspecialchars($_REQUEST["patient_name"]));
            $patient_address = trim(htmlspecialchars($_REQUEST["patient_address"]));
            $patient_phone = trim(htmlspecialchars($_REQUEST["patient_phone"]));
            $patient_email = trim(htmlspecialchars($_REQUEST["patient_email"]));
            $room_id = trim(htmlspecialchars($_REQUEST["room_id"]));
            $payee_type = trim(htmlspecialchars($_REQUEST["payee_type"]));
            $payee_name = trim(htmlspecialchars($_REQUEST["payee_name"]));
            $card_number = trim(htmlspecialchars($_REQUEST["card_number"]));
            $card_name = trim(htmlspecialchars($_REQUEST["card_name"]));
            $expiry_year = trim(htmlspecialchars($_REQUEST["expiry_year"]));
            $expiry_month = trim(htmlspecialchars($_REQUEST["expiry_month"]));
            $cvc = trim(htmlspecialchars($_REQUEST["cvc"]));
            $token = trim(htmlspecialchars($_SESSION['token']));
            $email  = trim(htmlspecialchars($_SESSION['email']));
            try {
                $userAuth  = validateSessionToken($mysqli, $token, $email);
                if ($userAuth) {

                    $sql = "SELECT * FROM rooms WHERE id = ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param('s', $room_id);
                    $stmt->execute();
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
                    if ($result['available'] == 0) {
                        $json["error"] = array("code" => "#400", "description" => "Room is already booked.");
                        echo json_encode($json);
                        exit;
                    }
                    // $costRoom = $result['cost'];
                    $room_name = $result['name'];
                    $room_cost    = $result['cost'];

                    $sql = "INSERT INTO bookings (patient_name, patient_address, patient_phone, patient_email, room_id, payee_type, payee_name, card_number, card_name, expiry_year, expiry_month, cvc, room_name, room_cost)
                        VALUES (?,? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param('ssssssssssssss', $patient_name, $patient_address, $patient_phone, $patient_email, $room_id, $payee_type, $payee_name, $card_number, $card_name, $expiry_year, $expiry_month, $cvc, $room_name, $room_cost);
                    $stmt->execute();

                    $last_id = $mysqli->insert_id;

                    $sql = "UPDATE rooms SET available = 0, current_occupant = ? WHERE id = ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param('ss', $last_id, $room_id);
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
    } else if ($mode == "checkout") {
        $room_id = trim(htmlspecialchars($_REQUEST["room_id"]));
        $token = trim(htmlspecialchars($_SESSION['token']));
        $email  = trim(htmlspecialchars($_SESSION['email']));
        try {
            $userAuth  = validateSessionToken($mysqli, $token, $email);
            if ($userAuth) {
                $sql = "UPDATE rooms SET available = 1, current_occupant = 0 WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('s', $room_id);
                $stmt->execute();

                // check_out 
                $sql = "UPDATE bookings SET check_out = ? WHERE room_id = ? ORDER BY id DESC LIMIT 1";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('ss', $datetime, $room_id);
                $stmt->execute();

                $json["error"] = array("code" => "#200", "description" => "Success.");
            } else {
                $json["error"] = array("code" => "#400", "description" => "Invalid token.");
            }
        } catch (Exception $e) {
            $json["error"] = array("code" => "#500", "description" => $e->getMessage());
        }
    } else {
        $json['error'] = array("code" => "#403", "description" => "Invalid mode.");
    }
} else {
    $json["error"] = array("code" => "#403", "description" => "Mode is required.");
}

unset($json["regid"]);
echo json_encode($json);
