<?php

session_start();
ini_set('log_errors', true);
ini_set('error_log', './php-error.log');
include("../lib/config.php");

if (isset($_REQUEST["id"])) {
    try {
        $id = $_REQUEST["id"];
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdoConn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
?>
        <div class="text-center">
            <?php
            if ($result["image"] != "") {
            ?>
                <img src="<?php echo $result["image"]; ?>" alt="user" class="img-circle" width="150" />
            <?php
            }
            ?>
        </div>
        <table class="table table-striped">
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><?php echo $result["first_name"] . " " . $result["last_name"]; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $result["email"]; ?></td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td>:</td>
                <td><?php echo $result["telephone"]; ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td><?php echo $result["gender"]; ?></td>
            </tr>
            <tr>
                <td>DOB</td>
                <td>:</td>
                <td><?php echo $result["dob"]; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $result["address"]; ?></td>
            </tr>
            <tr>
                <td>Created At</td>
                <td>:</td>
                <td><?php echo date('d M h:i A', strtotime($result["created_at"])); ?></td>
            </tr>
        </table>
<?php
    } catch (Exception $e) {
        $json["error"] = array("code" => "#500", "description" => $e->getMessage());
    }
}
