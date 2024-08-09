<?php


if (isset($_GET['productid'])) {
    $id = $_GET['productid'];
    $sql = "SELECT * FROM products WHERE id = $id";
    // $stmt = $pdoConn->prepare($sql);
    // $stmt->execute();
    // $propertyEdit = $stmt->fetchAll();
    $propertyEdit = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
    if (count($propertyEdit) > 0) {
?>
        <h3><b>Fill the Following Form To Add product</b></h3>
        <br />
        <div class="row">
            <div class="col-md-6">
                <h6>Product Name *</h6>
                <div class="p-2">
                    <input type="text" class="form-control" id="name" placeholder="Enter product name" required value="<?php echo ($propertyEdit[0]['product_name']); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <h6>Distributor Price *</h6>
                <div class="p-2">
                    <input type="text" class="form-control" id="distributor_price" placeholder="Enter product distributor price" required value="<?php echo ($propertyEdit[0]['distributor_price']); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <h6>Retailer Price *</h6>
                <div class="p-2">
                    <input type="text" class="form-control" id="retailer_price" placeholder="Enter product retailer price" required value="<?php echo ($propertyEdit[0]['retailer_price']); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <h6>M.R.P Price *</h6>
                <div class="p-2">
                    <input type="text" class="form-control" id="mrp_price" placeholder="Enter product mrp price" required value="<?php echo ($propertyEdit[0]['mrp_price']); ?>">
                </div>
            </div>

            <div class="col-12">
                <h6>Product Description *</h6>
                <div class="p-2">
                    <textarea rows="5" class="form-control texteditor-content" id="description" placeholder="Enter product description" required><?php echo ($propertyEdit[0]['product_description']); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Product Availability *</h6>
                <div class="p-2">
                    <select class="form-control" id="availability">
                        <option value="1" <?php echo ($propertyEdit[0]['available'] == 1) ? "selected" : ""; ?>>Available</option>
                        <option value="0" <?php echo ($propertyEdit[0]['available'] == 0) ? "selected" : ""; ?>>Out of Stock</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Product Status *</h6>
                <div class="p-2">
                    <select class="form-control" id="status">
                        <option value="1" <?php echo ($propertyEdit[0]['status'] == 1) ? "selected" : ""; ?>>Public</option>
                        <option value="0" <?php echo ($propertyEdit[0]['status'] == 0) ? "selected" : ""; ?>>Private</option>
                    </select>
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
                "alreadyUploaded": "<?php echo ($propertyEdit[0]['product_images']); ?>",
            };

            $(".saveButton").click(function() {
                var name = $("#name").val();
                var distributor_price = $("#distributor_price").val();
                var retailer_price = $("#retailer_price").val();
                var mrp_price = $("#mrp_price").val();
                var description = $("#description").val();
                var availability = $("#availability").val();
                var status = $("#status").val();
                var images = [];

                $(".uploaded-image").each(function() {
                    images.push($(this).attr("data-name"));
                });
                if (name == "" || distributor_price == "" || retailer_price == "" || mrp_price == "" || description == "") {
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
                            formData.append("mode", "editproduct");
                            formData.append("product_name", name);
                            formData.append("product_description", description);
                            formData.append("distributor_price", distributor_price);
                            formData.append("retailer_price", retailer_price);
                            formData.append("mrp_price", mrp_price);
                            formData.append("product_images", images);
                            formData.append("available", availability);
                            formData.append("status", status);
                            formData.append("productid", "<?= $propertyEdit[0]['id'] ?>");
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
                                            text: "Your product has been updated successfully!",
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
<?php
    }
}
