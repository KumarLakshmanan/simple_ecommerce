<?php
if (!isset($_SESSION)) {
	session_start();
}

$today = date('Y-m-d');

?>
<div class="p-3"></div>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link rel="stylesheet" href="<?= $adminBaseUrl ?>css/material.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.2/dist/chart.min.js"></script>
<!-- The Clinical Centre has 5 treatment rooms (i.e. numbers 1-5), 6 -15 are open ward bedrooms and 16 - 45 are private bedrooms. When patients visit the clinic, the clinic manager books them into any available room they request. The clinic manager records the patients’ names and personal details along with the payee’s credit card details. The payee’s details are entered as PRIVATE if the patient is the payee or the name of the company. The cost of visiting a doctor and receiving treatment in the treatment room is £100. Each treatment room is managed by a doctor and two staff nurses. The cost of a private bedroom is £50 and £40 for the open ward bedroom per week. -->
<div class="row">
	<div class="col-md-12 justify-content-end align-items-center d-flex mb-3">
		<div style="height: 20px;width: 20px;background-color: green;display: inline-block;"></div> &nbsp; Available
		&nbsp; &nbsp;
		<div style="height: 20px;width: 20px;background-color: red;display: inline-block;"></div> &nbsp; Booked
	</div>
	<?php
	$sql = "SELECT * FROM `rooms`";
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
	?>
			<div class="col-md-3 col-lg-2 col-sm-6 col-xs-12 p-0">
				<div class="card p-0 m-0">
					<div class="card-body" style="<?php if ($row['available'] == 1) {
														echo "background-color: green;";
													} else {
														echo "background-color: red;";
													} ?>">
						<h5 class="card-title text-white m-0"><?= $row['name'] ?></h5>
						<p class="card-text  text-white">
							Room No: <?php echo $row['id']; ?>
						</p>
						<p class="card-text  text-white">
							<?php
							echo "Cost: £" . $row['cost'];
							?>
						</p>
						<?php
						if ($row['available'] == 1) {
						?>
							<a href="<?= $adminBaseUrl ?>book?&room_id=<?= $row['id'] ?>" class="btn btn-primary m-0">Book Room</a>
						<?php
						} else {
						?>
							<a href="<?= $adminBaseUrl ?>viewbooking?&room_id=<?= $row['id'] ?>" class="btn btn-primary m-0">View</a>
							<a href="#" class="btn btn-secondary m-0" onclick="checkOut(<?= $row['id'] ?>)">Check Out</a>
						<?php
						}
						?>
					</div>
				</div>
			</div>
	<?php
		}
	}
	?>
</div>
<script>
	function checkOut($id) {
		swal({
			title: "Are you sure?",
			text: "Once checked out, the room will be available for booking again!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willCheckOut) => {
			if (willCheckOut) {
				$.ajax({
					url: "<?= $apiUrl ?>",
					type: 'POST',
					data: {
						mode: 'checkout',
						room_id: $id
					},
					success: function(data) {
						if (data.error.code == '#200') {
							location.reload();
						}
					}
				});
			}
		});
	}
</script>