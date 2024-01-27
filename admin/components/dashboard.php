<?php

$pageId = "index";
if (isset($_GET["id"])) {
    $pageId = $_GET["id"];
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $baseUrl ?>css/richtext.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $baseUrl ?>css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?= $baseUrl ?>css/dashboard.css" type="text/css" />
    <link rel="stylesheet" href="<?= $baseUrl ?>css/dataTables.bootstrap4.min.css">
    <script src="<?= $baseUrl ?>js/jquery.min.js"></script>
    <script src="<?= $baseUrl ?>js/sweetalert.js"></script>
    <script src="<?= $baseUrl ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= $baseUrl ?>js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= $baseUrl ?>js/bootstrap.min.js"></script>
    <script src="<?= $baseUrl ?>js/jquery.richtext.min.js"></script>
    <script src="<?= $baseUrl ?>js/custom.js"></script>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php include "./components/sidebar.php"; ?>
        <div class="page-wrapper mt-5">
            <div class="container-fluid">
                <?php
                if ($pageId == "events") {
                    include "dashboard/events.php";
                } elseif ($pageId == "editevent") {
                    include "dashboard/event/edit.php";
                } elseif ($pageId == "addevent") {
                    include "dashboard/event/add.php";
                } else if ($pageId == 'adddirection') {
                    include "dashboard/direction/add.php";
                } else if ($pageId == 'editdirection') {
                    include "dashboard/direction/edit.php";
                } else if ($pageId == 'direction') {
                    include "dashboard/direction.php";
                } else if ($pageId == 'emergency') {
                    include "dashboard/emergency.php";
                } elseif ($pageId == "users") {
                    include "dashboard/users.php";
                } elseif ($pageId == "admins") {
                    include "dashboard/admins.php";
                } elseif ($pageId == "notification") {
                    include "dashboard/notification.php";
                } elseif ($pageId == "messages") {
                    include "dashboard/messages.php";
                } else {
                    include "dashboard/home.php";
                }
                ?>
            </div>
            <footer class="footer text-center"> Created by <a href="https://kumarlakshmanan.github.io">Lakshmanan</a></footer>
        </div>
    </div>
</body>

</html>