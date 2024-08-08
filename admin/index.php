<?php
session_start();
include("./lib/config.php");

if (isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'subadmin')) {
	$currentTime = time();
	$authId = $_SESSION['token'];
	$username = $_SESSION['email'];
	$userAuth = validateSessionToken($mysqli, $authId, $username);
	if ($userAuth) {
		include("components/dashboard.php");
		exit();
	} else {
		include("components/login.php");
		exit();
	}
} else {
	include("components/login.php");
	exit();
}
