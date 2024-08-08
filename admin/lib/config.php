<?php
@ob_start();
@session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set("display_startup_errors", "1");
@ini_set('display_errors', 'On');
@ini_set('error_reporting', 1);
@ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
@ini_set('error_reporting', E_ALL);
include_once("constants.php");

// $options = [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_EMULATE_PREPARES => false,
//     PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci; SET SESSION sql_mode = ''; SET SESSION time_zone = '+05:30';"
// ];
// $pdoConn = new PDO("mysql:host=" . HOSTNAME . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD, $options);

// global $pdoConn;

// create the connection with to sql v5.7
$mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
global $mysqli;
include('functions.php');
