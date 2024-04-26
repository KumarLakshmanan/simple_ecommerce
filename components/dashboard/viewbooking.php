<?php 

$roomId = $_GET['room_id'] ?? 0;
$sql = "SELECT * FROM `bookings` WHERE room_id = $roomId ORDER BY id DESC LIMIT 1";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $patient_name = $row['patient_name'];
    $patient_address = $row['patient_address'];
    $patient_phone = $row['patient_phone'];
    $patient_email = $row['patient_email'];
    $room_id = $row['room_id'];
    $payee_type = $row['payee_type'];
    $payee_name = $row['payee_name'];
    $card_number = $row['card_number'];
    $card_name = $row['card_name'];
    $expiry_year = $row['expiry_year'];
    $expiry_month = $row['expiry_month'];
    $cvc = $row['cvc'];
} else {
    $patient_name = "";
    $patient_address = "";
    $patient_phone = "";
    $patient_email = "";
    $room_id = "";
    $payee_type = "";
    $payee_name = "";
    $card_number = "";
    $card_name = "";
    $expiry_year = "";
    $expiry_month = "";
    $cvc = "";
}
?>
<h3><b>View Booking Details</b></h3>
<br />
<div class="row">
	<div class="col-md-6">
		<h6>Patient Name *</h6>
		<div class="p-2">
			<input type="text" class="form-control" id="patient_name" placeholder="Enter patient name" required value="<?= $patient_name ?>" readonly>
		</div>
	</div>
    <div class="col-md-6">
        <h6>Patient Address *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="patient_address" placeholder="Enter patient address" required value="<?= $patient_address ?>" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Patient Phone *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="patient_phone" placeholder="Enter patient phone" required value="<?= $patient_phone ?>" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Patient Email *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="patient_email" placeholder="Enter patient email" required value="<?= $patient_email ?>" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Room ID *</h6>
        <div class="p-2">
            <select class="form-control" id="room_id" required disabled>
                <option value="">Select Room ID</option>
                <?php 
                $sql = "SELECT * FROM rooms";
                $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['id'] ."'";
                        if (isset($_GET['room_id']) && $_GET['room_id'] == $row['id']) {
                            echo " selected ";
                        }
                        echo ">".$row['id']." - ".$row['name']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Payee Type *</h6>
        <div class="p-2">
            <select class="form-control" id="payee_type" required disabled>
                <option value="">Select Payee Type</option>
                <option value="PERSONAL" <?php if ($payee_type == "PERSONAL") { echo "selected"; } ?>>Personal</option>
                <option value="COMPANY" <?php if ($payee_type == "COMPANY") { echo "selected"; } ?>>Company</option>
            </select>
        </div>
    </div>
</div>
<div class="p-2">
	<button type="button" class="w-100 btn btn-primary saveButton">Save changes</button>
</div>