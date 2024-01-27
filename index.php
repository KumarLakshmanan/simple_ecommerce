<?php
session_start();
include("./admin/lib/config.php");

if (isset($_GET["page"])) {
	$pageNumber = $_GET["page"];
} else {
	$pageNumber = 1;
}
$sql = "SELECT * FROM products ORDER BY id DESC";
$stmt = $pdoConn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>E Commerce</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/style.css" />
</head>

<body>
	<nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html">E Commerce</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span> Menu
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto mr-md-3">
					<li class="nav-item <?= $pageNumber == 1 ? "active" : "" ?>"><a href="index.php?page=1" class="nav-link">Page One</a></li>
					<li class="nav-item <?= $pageNumber == 2 ? "active" : "" ?>"><a href="index.php?page=2" class="nav-link">Page Two</a></li>
					<li class="nav-item <?= $pageNumber == 3 ? "active" : "" ?>"><a href="index.php?page=3" class="nav-link">Page Three</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div>
		<div class="table-responsive container py-5">
			<table class="table no-wrap bDataTable" id="bDataTable">
				<thead>
					<tr>
						<th class="border-top-0" width="20px">#</th>
						<th class="border-top-0">Product Name</th>
						<?php
						if ($pageNumber == 1) {
						?>
							<th class="border-top-0">Distributor Price</th>
						<?php
						}
						if ($pageNumber != 3) {
						?>
							<th class="border-top-0">Retailer Price</th>
							<th class="border-top-0">MRP</th>
						<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($result as $key => $value) {
					?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td>
								<?php
									$images = explode(",", $value['product_images']);
									echo "<img src='admin/uploads/images/" . $images[0] . "' width='100px' style='margin-right:10px;'>" . $value['product_name'];
								?>
							</td>
							<?php
							if ($pageNumber == 1) {
							?>
								<td><?php echo $value['distributor_price']; ?></td>
							<?php
							}
							if ($pageNumber != 3) {
							?>
								<td><?php echo $value['retailer_price']; ?></td>
								<td><?php echo $value['mrp_price']; ?></td>
							<?php
							}
							?>
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
			border: 5px solid #558903;
		}
	</style>
</body>

</html>