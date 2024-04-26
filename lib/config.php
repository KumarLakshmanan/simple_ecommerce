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
$mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$sql = "SET time_zone = '+05:30'";
$mysqli->query($sql);

global $mysqli;
include('functions.php');
