<?php

?>
<h3><b>Fill the Following Form To Add direction</b></h3>
<br />
<div class="row">
    <div class="col-md-6">
        <h6>Direction Title *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="name" placeholder="Enter direction name" required>
        </div>
    </div>
    <div class="col-md-6">
    </div>
    <div class="col-md-6">
        <h6>Direction Lattitude *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="latitude" placeholder="Enter direction lattitude" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Direction Longitude *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="longitude" placeholder="Enter direction longitude" required>
        </div>
    </div>

</div>
<div class="p-2">
    <button type="button" class="w-100 btn btn-primary saveButton">Save changes</button>
</div>

<link href="<?= $baseUrl ?>css/image-uploader.min.css" rel="stylesheet" />
<script src="<?= $baseUrl ?>js/image-uploader.min.js"></script>
<script>
    $(document).ready(() => {
        imageUploader.init(".input-images");
    })
    let _xUserData = {
        "baseURL": "<?= $baseUrl ?>",
        "auth": "<?= $_SESSION['token'] ?>",
        "username": "<?= $_SESSION['email'] ?>",
    };
    $(".saveButton").click(function() {
        var name = $("#name").val();
        var latitude = $("#latitude").val();
        var longitude = $("#longitude").val();

        if (name == "" || latitude == "" || longitude == "") {
            swal({
                icon: 'error',
                type: 'error',
                title: 'Oops...',
                text: 'Please fill all the fields!',
            })
        } else {
            swal({
                title: 'Are you sure to publish?',
                text: "The direction will be saved and pushed to the server!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var formData = new FormData();
                    formData.append("mode", "adddirection");
                    formData.append("title", name);
                    formData.append("latitude", latitude);
                    formData.append("longitude", longitude);
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
                                    text: "Your direction has been saved successfully!",
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