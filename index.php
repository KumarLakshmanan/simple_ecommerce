<?php
session_start();
include("./admin/lib/config.php");


$sql = "SELECT * FROM products WHERE status = 1  ORDER BY id DESC";
$result = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Nalam</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/style.css" />
</head>

<body>
	<nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="#"><img src='images/logo.png' width='200px' style='margin-right:10px;'></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span> Menu
			</button>
		</div>
	</nav>
	<div style="overflow-x:auto;">
		<div class="py-5 container-fluid">
			<table class="table no-wrap bDataTable" id="bDataTable">
				<thead>
					<tr>
						<th class="border-top-0" width="30px">ID</th>
						<th style="white-space: nowrap;" class="border-top-0">Product Name</th>
						<th style="white-space: nowrap;" class="border-top-0">MRP (₹)</th>
						<th style="white-space: nowrap;" class="border-top-0">Distributor Price (₹)</th>
						<th style="white-space: nowrap;" class="border-top-0">Shop Price (₹)</th>
						<th style="white-space: nowrap;" class="border-top-0">Availability</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($result as $key => $value) {
					?>
						<tr>
							<td style="white-space: nowrap;">NTP <?php echo $value['id']; ?></td>
							<td>
								<?php
								$images = explode(",", $value['product_images']);
								echo "<img src='admin/uploads/images/" . $images[0] . "' width='100px' style='margin-right:10px;'>" . $value['product_name'];
								?>
							</td>
							<td><?php echo $value['mrp_price']; ?></td>
							<td><?php echo $value['distributor_price']; ?></td>
							<td><?php echo $value['retailer_price']; ?></td>
							<td><?php echo $value['available'] == 1 ? "Available" : "Out of Stock"; ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<style>
		table {
			border: 1px solid #558903;
			overflow: hidden;
		}

		thead {
			background: #558903;
			color: #fff;
		}

		thead th {
			font-size: 16px;
		}

		tbody tr {
			font-size: 14px;
		}

		thead th,
		tbody td {
			border: 3px solid #558903;
		}
	</style>
	<style>
		.footer {
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			background-color: #558903;
			color: white;
			text-align: center;
		}
	</style>

	<div class="footer">
		<p>3/23 Kunnathur Road, Perumanallur Tiruppur - 641666</p>
	</div>
</body>

</html>