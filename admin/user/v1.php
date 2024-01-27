<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include('../lib/config.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$displayCurrency = 'INR';

if (!isset($_SESSION)) {
    session_start();
}

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$today = strtotime("today");
$dayOfWeek = date("N", $today);
$daysToSubtract = $dayOfWeek - 1;

$firstDateOfWeek = date("Y-m-d", strtotime("-$daysToSubtract days", $today));

$json["data"] = [];
$json["error"] = array("code" => "#200", "description" => "Success.");
$json['request'] = $_REQUEST;
if (isset($_REQUEST["action"])) {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    $action = trim($_REQUEST["action"]);
    if ($action == "login") {
        $uname = $_REQUEST['email'];
        $upass = $_REQUEST['password'];
        $sql = "SELECT * FROM `users` WHERE `email` = :email OR `telephone` = :telephone";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute(['email' => $uname, 'telephone' => $uname]);
        $adminData = $stmt->fetch();
        if ($adminData) {
            if ($adminData['password'] == $upass) {
                $currentTime = strtotime($datetime);
                $token = md5($uname . $upass . time() . uniqid());
                $sql = "UPDATE `users` SET  last_login = :update_date, token = :token WHERE email = :email";
                $stmt = $pdoConn->prepare($sql);
                $stmt->bindParam(':update_date', $datetime);
                $stmt->bindParam(':email', $adminData['email']);
                $stmt->bindParam(':token', $token);
                $stmt->execute();
                $adminData['token'] = $token;
                $json["data"] = $adminData;
            } else {
                $json["error"] = array("code" => "#500", "description" => "Invalid password");
            }
        } else {
            $json["error"] = array("code" => "#500", "description" => "$uname This email or telephone number is not registered.");
        }
    } else if ($action == 'getschedule') {
        $sql = "SELECT * FROM events";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $json["data"] = array();

        for ($i = 0; $i < count($result); $i++) {
            $json["data"][] = array(
                "id" => $result[$i]["id"],
                "name" => htmlspecialchars_decode($result[$i]["name"]),
                "startdatetime" => strtotime($result[$i]["start_datetime"]) * 1000,
                "enddatetime" => strtotime($result[$i]["end_datetime"]) * 1000,
            );
        }
        $json["error"] = array("code" => "#200", "description" => "Success.");
    } else if ($action == "getemergency") {
        $sql = "SELECT * FROM emergency";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $json["data"] = $result;
    } else if ($action == 'getdirections') {
        $sql = "SELECT * FROM directions";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $json["data"] = array();

        for ($i = 0; $i < count($result); $i++) {
            $json["data"][] = array(
                "id" => $result[$i]["id"],
                "name" => htmlspecialchars_decode($result[$i]["name"]),
                "latitude" => $result[$i]["latitude"],
                "longitude" => $result[$i]["longitude"],
            );
        }
        $json["error"] = array("code" => "#200", "description" => "Success.");
    } else if ($action == "getsingleevent") {
        $id = trim(htmlspecialchars($_REQUEST['eventid']));
        $sql = "SELECT * FROM events WHERE id = :id";
        $stmt = $pdoConn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            $image = explode(",", $result["image"]);
            $image = array_filter($image);
            $imgArr = array();
            for ($j = 0; $j < count($image); $j++) {
                $imgArr[] = $adminBaseUrl . "uploads/images/" . $image[$j];
            }
            $json["data"] = array(
                "id" => $result["id"],
                "name" => htmlspecialchars_decode($result["name"]),
                "description" => htmlspecialchars_decode($result["description"]),
                "image" => $imgArr,
                "url" => $result["youtube"],
                "venue" => $result["venue"],
                "sdatetime" => strtotime($result["start_datetime"]) * 1000,
                "edatetime" => strtotime($result["end_datetime"]) * 1000,
                "created_date" => strtotime($result["created_date"]) * 1000,
            );
        } else {
            $json["error"] = array("code" => "#400", "description" => "This event is not available.");
        }
    } else if ($action == "register") {
        // {email: klakshmanan48@gmail.com, password: 123456, first_name: Karthik, last_name: Lakshmanan, phone: 9012345678}
        $firstName = $_REQUEST['first_name'];
        $lastName = $_REQUEST['last_name'];
        $email = $_REQUEST['email'];
        $telephone = $_REQUEST['phone'];
        $password = $_REQUEST['password'];
        $sql = "SELECT * FROM `users` WHERE `email` = :email OR `telephone` = :telephone";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute(['email' => $email, 'telephone' => $telephone]);
        $adminData = $stmt->fetch();
        if ($adminData) {
            $json["error"] = array("code" => "#500", "description" => "This email or telephone number is already registered.");
        } else {
            $token = md5($email . $password . time() . uniqid());
            $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `telephone`, `password`, `token`) VALUES (:first_name, :last_name, :email, :telephone, :password, :token)";
            $stmt = $pdoConn->prepare($sql);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $last_id = $pdoConn->lastInsertId();
            $sql = "SELECT * FROM `users` WHERE `id` = :id";
            $stmt = $pdoConn->prepare($sql);
            $stmt->execute(['id' => $last_id]);
            $adminData = $stmt->fetch();
            $json["data"] = $adminData;
            $json["error"] = array("code" => "#200", "description" => "User registered successfully.");
        }
    } else if ($action == "updateregid") {
        $regid = $_REQUEST["regid"];
        $version = $_REQUEST["version"] ?? "1.0.0 (1)";
        $sql  = "SELECT * FROM regid WHERE regid = :regid";
        $stmt = $pdoConn->prepare($sql);
        $stmt->bindParam(":regid", $regid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $date = $result["created_at"];
            $status = "active";
            $sql = "UPDATE regid SET version = :version, created_at = :created_at, status = :status WHERE regid = :regid";
            $stmt = $pdoConn->prepare($sql);
            $stmt->bindParam(":version", $version);
            $stmt->bindParam(":created_at", $date);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":regid", $regid);
            $stmt->execute();
        } else {
            $date = date("Y-m-d H:i:s");
            $status = "active";
            $sql = "INSERT INTO regid (regid, version, created_at, status) VALUES (:regid, :version, :created_at, :status)";
            $stmt = $pdoConn->prepare($sql);
            $stmt->bindParam(":regid", $regid);
            $stmt->bindParam(":version", $version);
            $stmt->bindParam(":created_at", $date);
            $stmt->bindParam(":status", $status);
            $stmt->execute();
        }
        track($pdoConn, $version);
    } else if ($action == "contactMessage") {
        $datetime = date("Y-m-d H:i:s");
        try {
            $name = $_REQUEST["name"] ?? "";
            $email = $_REQUEST["email"] ?? "";
            $mobile = $_REQUEST["phone"] ?? "";
            $message = $_REQUEST["message"] ?? "";
            $title = $_REQUEST["title"] ?? "";

            $name = htmlspecialchars($name);
            $mobile = htmlspecialchars($mobile);
            $email = htmlspecialchars($email);
            $message = htmlspecialchars($message);
            $title = htmlspecialchars($title);

            $sql = "INSERT INTO contact (name, email, phone,title, message, created_at) VALUES (:name, :email, :phone,:title, :message, :created_at)";
            $stmt = $pdoConn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone", $mobile);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":message", $message);
            $stmt->bindParam(":created_at", $datetime);
            $stmt->execute();

            $json["error"] = array("code" => "#200", "description" => "Success.");
        } catch (Exception $e) {
            $json["error"] = array("code" => "#500", "description" => $e->getMessage());
        }
    } else if ($action == "dashboard") {
        if (isset($_REQUEST['email']) && isset($_REQUEST['token'])) {
            $uname = $_REQUEST['email'];
            $token = $_REQUEST['token'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email AND `token` = :token";
            $stmt = $pdoConn->prepare($sql);
            $stmt->execute(['email' => $uname, 'token' => $token]);
            $adminData = $stmt->fetch();
            if ($adminData) {
                $mode = $_REQUEST['mode'];
                if ($mode == "getUserData") {
                    $json["data"] = $adminData;
                } else if ($mode == "uploadImage") {
                    if (isset($_FILES['image'])) {
                        $image = $_FILES['image'];
                        $filename = $_FILES['image']['name'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $imagenewname = "frontendforever_" . uniqid() . "." . rand(0000000, 9999999) . "." . $ext;
                        $imgpath = "";
                        $imgpath = "images";
                        $imagepath = BASE_PATH . "cdn/" . $imgpath . "/" . $imagenewname;
                        if (!file_exists(BASE_PATH . "cdn/" . $imgpath . "/")) {
                            mkdir(BASE_PATH . "cdn/" . $imgpath . "/", 0777, true);
                        }
                        $imageurl = CDN_URL . $imgpath . "/" . $imagenewname;

                        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
                            $success = move_uploaded_file($_FILES['image']['tmp_name'], $imagepath);
                            if ($success) {
                                $json['data'] = array("image" => $imageurl);
                                $json['error'] = array("code" => "#200", "description" => "Profile pic updated successfully.");
                            } else {
                                $json['error'] = array("code" => "#500", "description" => "Unable to upload image.");
                            }
                        } else {
                            $json['error'] = array("code" => "#500", "description" => "Please select valid image.");
                        }
                    } else {
                        $json['error'] = array("code" => "#500", "description" => "Please select valid file.");
                    }
                } else if ($mode == "inviteereports") {
                    $sql = "SELECT first_name,last_name,id,wallet,created_date,image,direct_invites FROM `users` WHERE `ref_id` = :ref_id";
                    $stmt = $pdoConn->prepare($sql);
                    $stmt->execute(['ref_id' => $adminData['id']]);
                    $subAdminData = $stmt->fetchAll();
                    $json["data"] = $subAdminData;
                } else if ($mode == "update_profile") {
                    if (
                        isset($_REQUEST['_firstname']) &&
                        isset($_REQUEST['_lastname']) &&
                        isset($_REQUEST['_dob']) &&
                        isset($_REQUEST['_gender']) &&
                        isset($_REQUEST['_image']) &&
                        isset($_REQUEST['_address'])
                    ) {
                        $firstname = $_REQUEST['_firstname'];
                        $lastname = $_REQUEST['_lastname'];
                        $dob = $_REQUEST['_dob'];
                        $gender = $_REQUEST['_gender'];
                        $image = $_REQUEST['_image'];
                        $address = $_REQUEST['_address'];
                        try {
                            $sql = "UPDATE `users` SET `gender` = :gender,  `dob` = :dob, `first_name` = :first_name, `last_name` = :last_name, `image` = :image, `address` = :address WHERE `id` = :id";
                            $stmt = $pdoConn->prepare($sql);
                            $stmt->bindParam(':gender', $gender);
                            $stmt->bindParam(':dob', $dob);
                            $stmt->bindParam(':first_name', $firstname);
                            $stmt->bindParam(':last_name', $lastname);
                            $stmt->bindParam(':image', $image);
                            $stmt->bindParam(':address', $address);
                            $stmt->bindParam(':id', $adminData['id']);
                            $stmt->execute();
                            $json["error"] = array("code" => "#200", "description" => "User updated successfully.");
                        } catch (PDOException $e) {
                            $pdoConn->rollBack();
                            $json["error"] = array("code" => "#500", "description" => "Database error: " . $e->getMessage());
                        }
                    } else {
                        $json["error"] = array("code" => "#500", "description" => "Invalid request.");
                    }
                } else if ($mode == "getSingleUser") {
                    $id = $_REQUEST['_id'];
                    $sql = "SELECT * FROM `users` WHERE `id` = :id";
                    $stmt = $pdoConn->prepare($sql);
                    $stmt->execute(['id' => $id]);
                    $subAdminData = $stmt->fetch();
                    if ($subAdminData) {
                        $json["data"] = $subAdminData;
                    } else {
                        $json["error"] = array("code" => "#500", "description" => "User not found.");
                    }
                } else if ($mode == "getAllUsers") {
                    $sql = "SELECT * FROM `users`";
                    $stmt = $pdoConn->prepare($sql);
                    $stmt->execute();
                    $subAdminData = $stmt->fetchAll();
                    $json["data"] = $subAdminData;
                } else if ($mode == "getUsersByPhone") {
                    $phone = $_REQUEST['_phone'];
                    $sql = "SELECT * FROM `users` WHERE `telephone` = :telephone";
                    $stmt = $pdoConn->prepare($sql);
                    $stmt->execute(['telephone' => $phone]);
                    $subAdminData = $stmt->fetchAll();
                    $json["data"] = $subAdminData;
                } else if ($mode == "getUserById") {
                    $id = $_REQUEST['_id'];
                    $sql = "SELECT * FROM `users` WHERE `id` = :id";
                    $stmt = $pdoConn->prepare($sql);
                    $stmt->execute(['id' => $id]);
                    $subAdminData = $stmt->fetch();
                    if ($subAdminData) {
                        $json["data"] = $subAdminData;
                    } else {
                        $json["error"] = array("code" => "#500", "description" => "User not found.");
                    }
                } else {
                    $json["error"] = array("code" => "#500", "description" => "Mode Not found.");
                }
            } else {
                $json["error"] = array("code" => "#500", "description" => "Token expired.");
            }
        } else {
            $json["error"] = array("code" => "#500", "description" => "Email or token is missing.");
        }
    } else {
        $json["error"] = array("code" => "#500", "description" => "Invalid request.");
    }
} else {
    $json["error"] = array("code" => "#500", "description" => "Invalid request.");
}

echo json_encode($json, JSON_PRETTY_PRINT);


function verifyAccess($userId, $shopId, $pdoConn)
{
    $sql = "SELECT * FROM `shop_access` WHERE `shop_id` = :shop_id AND `user_id` = :user_id";
    $stmt = $pdoConn->prepare($sql);
    $stmt->execute(['shop_id' => $shopId, 'user_id' => $userId]);
    $subAdminData = $stmt->fetch();
    if ($subAdminData) {
        return [
            "role" => $subAdminData['role'],
        ];
    } else {
        $sql = "SELECT * FROM `users` WHERE `id` = :user_id";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $subAdminData = $stmt->fetch();
        if ($subAdminData) {
            if ($subAdminData['type'] == "admin") {
                return [
                    "role" => 1,
                ];
            } else {
                return [
                    "role" => 0,
                ];
            }
        } else {
            return [
                "role" => 0,
            ];
        }
    }
}
