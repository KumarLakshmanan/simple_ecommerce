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
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-3 pt-2">
					<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
						<i class="material-icons opacity-10">person</i>
					</div>
					<div class="text-end pt-1">
						<p class="text-sm mb-0 text-capitalize">All Products</p>
						<h4 class="mb-0">
							<?php
							$sql = "SELECT count(id) as cnt FROM products";
							$stmt = $pdoConn->prepare($sql);
							$stmt->execute();
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							echo $result['cnt'] ?? 0;
							?>
						</h4>
					</div>
				</div>
				<hr class="dark horizontal my-0">
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-3 pt-2">
					<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
						<i class="material-icons opacity-10">person</i>
					</div>
					<div class="text-end pt-1">
						<p class="text-sm mb-0 text-capitalize">Total Distributor Price</p>
						<h4 class="mb-0">
							<?php
							$sql = "SELECT SUM(distributor_price) as cnt FROM products";
							$stmt = $pdoConn->prepare($sql);
							$stmt->execute();
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							echo $result['cnt'] ?? 0;
							?>
						</h4>
					</div>
				</div>
				<hr class="dark horizontal my-0">
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-3 pt-2">
					<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
						<i class="material-icons opacity-10">person</i>
					</div>
					<div class="text-end pt-1">
						<p class="text-sm mb-0 text-capitalize">Total Retailer Price</p>
						<h4 class="mb-0">
							<?php
							$sql = "SELECT SUM(retailer_price) as cnt FROM products";
							$stmt = $pdoConn->prepare($sql);
							$stmt->execute();
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							echo $result['cnt'] ?? 0;
							?>
						</h4>
					</div>
				</div>
				<hr class="dark horizontal my-0">
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-3 pt-2">
					<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
						<i class="material-icons opacity-10">person</i>
					</div>
					<div class="text-end pt-1">
						<p class="text-sm mb-0 text-capitalize">Total MRP Price</p>
						<h4 class="mb-0">
							<?php
							$sql = "SELECT SUM(mrp_price) as cnt FROM products";
							$stmt = $pdoConn->prepare($sql);
							$stmt->execute();
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							echo $result['cnt'] ?? 0;
							?>
						</h4>
					</div>
				</div>
				<hr class="dark horizontal my-0">
			</div>
		</div>
	</div>
</div>
<style>
	body,
	html {
		height: 100%;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.uploadContainer {
		width: 90%;
		max-width: 600px;
		margin: 0 auto;
	}
</style>
