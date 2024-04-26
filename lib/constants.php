<?php

$hostname = $_SERVER['HTTP_HOST'];
date_default_timezone_set('Asia/Kolkata');
if (strpos($hostname, "codingfrontend")) {
    define('HOSTNAME', 'localhost');
    define('SITE_URL', 'https://freelancing.codingfrontend.in/doctor/');
    define('CDN_URL', 'https://freelancing.codingfrontend.in/doctor/cdn/');
    define('DB_USERNAME', 'u707479837_ecommerce');
    define('DB_DATABASE', 'u707479837_ecommerce');
    define('DB_PASSWORD', '9yT#yM!6xC!');
    define("BASE_PATH", "/home/u707479837/domains/codingfrontend.in/public_html/freelancing/doctor/");

    $apiUrl = "https://freelancing.codingfrontend.in/doctor/api/v1.php";
    $baseUrl = "https://freelancing.codingfrontend.in/doctor/";
    $adminBaseUrl = "https://freelancing.codingfrontend.in/doctor/";
    $uploadsDirectory = "/home/u707479837/domains/codingfrontend.in/public_html/freelancing/doctor/uploads/";
    $baseDirectory = "/home/u707479837/domains/codingfrontend.in/public_html/freelancing/doctor/";
} else {
    define('HOSTNAME', 'localhost');
    define('SITE_URL', 'https://nalamecoproducts.com/');
    define('CDN_URL', 'https://nalamecoproducts.com/cdn/');
    define('DB_USERNAME', 'tentrecen_nalam');
    define('DB_DATABASE', 'tentrecen_nalam');
    define('DB_PASSWORD', 'zP3BxTwgRSBI');
    define("BASE_PATH", "/home/tentrecen/nalamecoproducts.com/");
    $apiUrl = "https://nalamecoproducts.com/api/v1.php";
    $baseUrl = "https://nalamecoproducts.com/";
    $adminBaseUrl = "https://nalamecoproducts.com/";
    $uploadsDirectory = "/home/tentrecen/nalamecoproducts.com/uploads/";
    $baseDirectory = "/home/tentrecen/nalamecoproducts.com/";
}

$phoneRegex = "/^[0-9]{10}$/";
$pincodeRegex = "/^[0-9]{6}$/";
$pancardRegex = "/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/";
$ifscRegex = "/^([A-Za-z]){4}([0-9]){7}?$/";
$gstRegex = "/^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([1-9]){1}([a-zA-Z]){1}([0-9a-zA-Z]){1}?$/";
$bankAccountRegex = "/^([0-9]){9,18}?$/";
$emailRegex = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";
$amountRegex = "/^[0-9]+(\.[0-9]{1,2})?$/";
$addressRegex = "/^[a-zA-Z0-9\s\,\.\-\/\(\)\&\#]+$/";
$upiRegex = "/^([a-zA-Z0-9-.]){1,50}@([a-zA-Z0-9-]){1,10}$/";
$bankNameRegex = "/^[a-zA-Z0-9\s\,\.\-\/\(\)\&\#]+$/";
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$gstNoRegex = "/^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([1-9]){1}([a-zA-Z]){1}([0-9a-zA-Z]){1}?$/";
$fssaiNoRegex = "/^([0-9]){14}?$/";

$getErrorCode = array("code" => "#101", "description" => "Get request not allowed.");
$postErrorCode = array("code" => "#102", "description" => "Post request not allowed.");
$invalidRequestErrorCode = array("code" => "#103", "description" => "Invalid request.");
$invalidTokenErrorCode = array("code" => "#104", "description" => "Invalid token.");
$invalidUsernameErrorCode = array("code" => "#105", "description" => "Invalid username.");
$unauthorizedErrorCode = array("code" => "#105", "description" => "Unauthorized access.");
$invalidIdErrorCode = array("code" => "#106", "description" => "Invalid id.");
$invalidEmailErrorCode = array("code" => "#107", "description" => "Invalid email.");
$invalidPasswordErrorCode = array("code" => "#108", "description" => "Invalid password.");
$invalidPhoneErrorCode = array("code" => "#109", "description" => "Invalid phone.");
$invalidNameErrorCode = array("code" => "#110", "description" => "Invalid name.");
$invalidCategoryErrorCode = array("code" => "#111", "description" => "Invalid category.");
$invalidUserOrPass = array("code" => "#112", "description" => "Invalid username or password.");
$somethingWentWrong = array("code" => "#113", "description" => "Something went wrong.");
$permissionDenied = array("code" => "#114", "description" => "Permission denied.");
$fileNotFound = array("code" => "#115", "description" => "File not found.");
$pleaseFillAll = array("code" => "#116", "description" => "Please fill all the fields.");
$successErrorCode = array("code" => "#200", "description" => "Success.");