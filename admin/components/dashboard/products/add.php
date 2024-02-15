<h3><b>Fill the Following Form To Add product</b></h3>
<br />
<div class="row">
	<div class="col-md-6">
		<h6>Product Name *</h6>
		<div class="p-2">
			<input type="text" class="form-control" id="name" placeholder="Enter product name" required>
		</div>
	</div>

	<div class="col-md-6">
		<h6>Distributor Price *</h6>
		<div class="p-2">
			<input type="text" class="form-control" id="distributor_price" placeholder="Enter product distributor price" required>
		</div>
	</div>

	<div class="col-md-6">
		<h6>Retailer Price *</h6>
		<div class="p-2">
			<input type="text" class="form-control" id="retailer_price" placeholder="Enter product retailer price" required>
		</div>
	</div>

	<div class="col-md-6">
		<h6>M.R.P Price *</h6>
		<div class="p-2">
			<input type="text" class="form-control" id="mrp_price" placeholder="Enter product mrp price" required>
		</div>
	</div>
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
		<div class="p-2">
			<label for="images">Product Images *</label>
			<div class="input-images" id="images" style="padding-top: .5rem;background: white"></div>
		</div>
	</div>
</div>
<div class="p-2">
	<button type="button" class="w-100 btn btn-primary saveButton">Save changes</button>
</div>

<link href="<?= $adminBaseUrl ?>css/image-uploader.min.css" rel="stylesheet" />
<script src="<?= $adminBaseUrl ?>js/image-uploader.min.js"></script>
<script>
	$(document).ready(() => {
		imageUploader.init(".input-images");
	})
	let _xUserData = {
		"baseURL": "<?= $adminBaseUrl ?>",
		"auth": "<?= $_SESSION['token'] ?>",
		"username": "<?= $_SESSION['email'] ?>",
	};
	$(".saveButton").click(function() {
		var name = $("#name").val();
        var distributor_price = $("#distributor_price").val();
        var retailer_price = $("#retailer_price").val();
        var mrp_price = $("#mrp_price").val();
		var images = [];
		$(".uploaded-image").each(function() {
			images.push($(this).attr("data-name"));
		});
		if (name == "" || distributor_price == "" || retailer_price == "" || mrp_price == "") {
			swal({
				icon: 'error',
				type: 'error',
				title: 'Oops...',
				text: 'Please fill all the fields!',
			})
		} else {
			swal({
				title: 'Are you sure to publish?',
				text: "This will be saved and pushed to the server!",
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					var formData = new FormData();
					formData.append("mode", "addevent");
					formData.append("product_name", name);
                    formData.append("product_description", "");
                    formData.append("distributor_price", distributor_price);
                    formData.append("retailer_price", retailer_price);
                    formData.append("mrp_price", mrp_price);
                    formData.append("product_images", images);
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
									text: "Your product has been saved successfully!",
									confirmButtonText: 'Ok'
								}).then((result) => {
									window.location.reload();
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
		}
	});
</script>
