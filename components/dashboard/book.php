<!-- CREATE TABLE bookings (
	id INT(6) AUTO_INCREMENT PRIMARY KEY,
	room_id INT(6) NOT NULL,
	patient_name VARCHAR(255) NOT NULL,
	patient_address VARCHAR(255) NOT NULL,
	patient_phone VARCHAR(255) NOT NULL,
	patient_email VARCHAR(255) NOT NULL,
	payee_type ENUM('PERSONAL', 'COMPANY') NOT NULL,
	payee_name VARCHAR(255) NOT NULL,
	card_number VARCHAR(255) NOT NULL,
	expiry_year INT(4) NOT NULL,
	expiry_month INT(2) NOT NULL,
	cvc INT(3) NOT NULL,
	card_name VARCHAR(255) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); -->
<h3><b>Fill the Following Form To Book room</b></h3>
<br />
<div class="row">
	<div class="col-md-6">
		<h6>Patient Name *</h6>
		<div class="p-2">
			<input type="text" class="form-control" id="patient_name" placeholder="Enter patient name" required>
		</div>
	</div>
    <div class="col-md-6">
        <h6>Patient Address *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="patient_address" placeholder="Enter patient address" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Patient Phone *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="patient_phone" placeholder="Enter patient phone" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Patient Email *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="patient_email" placeholder="Enter patient email" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Room ID *</h6>
        <div class="p-2">
            <select class="form-control" id="room_id" required>
                <option value="">Select Room ID</option>
                <?php 
                $sql = "SELECT * FROM rooms WHERE available = 1";
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
            <select class="form-control" id="payee_type" required>
                <option value="">Select Payee Type</option>
                <option value="PERSONAL">Personal</option>
                <option value="COMPANY">Company</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Payee Name *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="payee_name" placeholder="Enter payee name" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Card Number *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="card_number" placeholder="Enter card number" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Card Name *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="card_name" placeholder="Enter card name" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Expiry Year *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="expiry_year" placeholder="Enter expiry year" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Expiry Month *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="expiry_month" placeholder="Enter expiry month" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>CVC *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="cvc" placeholder="Enter cvc" required>
        </div>
    </div>
</div>
<div class="p-2">
	<button type="button" class="w-100 btn btn-primary saveButton">Save changes</button>
</div>

<script>
	let _xUserData = {
		"baseURL": "<?= $adminBaseUrl ?>",
		"auth": "<?= $_SESSION['token'] ?>",
		"username": "<?= $_SESSION['email'] ?>",
	};
	$(".saveButton").click(function() {
        var patient_name = $("#patient_name").val();
        var patient_address = $("#patient_address").val();
        var patient_phone = $("#patient_phone").val();
        var patient_email = $("#patient_email").val();
        var room_id = $("#room_id").val();
        var payee_type = $("#payee_type").val();
        var payee_name = $("#payee_name").val();
        var card_number = $("#card_number").val();
        var card_name = $("#card_name").val();
        var expiry_year = $("#expiry_year").val();
        var expiry_month = $("#expiry_month").val();
        var cvc = $("#cvc").val();
        // if (patient_name == "" || patient_address == "" || patient_phone == "" || patient_email == "" || room_id == "" || payee_type == "" || payee_name == "" || card_number == "" || card_name == "" || expiry_year == "" || expiry_month == "" || cvc == "") {
		// 	swal({
		// 		icon: 'error',
		// 		type: 'error',
		// 		title: 'Oops...',
		// 		text: 'Please fill all the fields!',
		// 	})
		// } else {
			swal({
				title: 'Are you sure to book this room?',
				text: "This will be saved in the database!",
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					var formData = new FormData();
					formData.append("mode", "book");
                    formData.append("patient_name", patient_name);
                    formData.append("patient_address", patient_address);
                    formData.append("patient_phone", patient_phone);
                    formData.append("patient_email", patient_email);
                    formData.append("room_id", room_id);
                    formData.append("payee_type", payee_type);
                    formData.append("payee_name", payee_name);
                    formData.append("card_number", card_number);
                    formData.append("card_name", card_name);
                    formData.append("expiry_year", expiry_year);
                    formData.append("expiry_month", expiry_month);
                    formData.append("cvc", cvc);

					$(".preloader").show();

					$.ajax({
						url: "<?= $apiUrl ?>",
						type: "POST",
						data: formData,
						contentType: false,
						cache: false,
						processData: false,
						success: function(response) {
							$(".preloader").hide();
							if (response.error.code == '#200') {
								swal({
									title: 'Success!',
									icon: 'success',
									text: "This room has been booked successfully!",
									confirmButtonText: 'Ok'
								}).then((result) => {
									window.location.href = "<?= $adminBaseUrl ?>" + 'home';
								});
							} else {
								swal({
									title: 'Error!',
									text: response.error.description,
									icon: 'error',
									confirmButtonText: 'Try Again'
								})
							}
						}
					});
				}
			});
		// }
	});
</script>
