<?php

?>
<h3><b>Fill the Following Form To Add event</b></h3>
<br />
<div class="row">
    <div class="col-md-6">
        <h6>Event Title *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="name" placeholder="Enter event name" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Event Venue *</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="venue" placeholder="Enter event venue" required>
        </div>
    </div>
    <div class="col-md-6">
        <h6>Link</h6>
        <div class="p-2">
            <input type="text" class="form-control" id="youtube" placeholder="Enter event/youtube link" required>
        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="row">
        <div class="col-md-6">
            <h6>Event start Date *</h6>
            <div class="p-2">
                <input type="date" class="form-control" id="sdate" placeholder="Enter event start date" required>
            </div>
        </div>
        <div class="col-md-6">
            <h6>Event start Time *</h6>
            <div class="p-2">
                <input type="time" class="form-control" id="stime" placeholder="Enter event start time" required>
            </div>
        </div>
        <div class="col-md-6">
            <h6>Event end Date *</h6>
            <div class="p-2">
                <input type="date" class="form-control" id="edate" placeholder="Enter event end date" required>
            </div>
        </div>
        <div class="col-md-6">
            <h6>Event end Time *</h6>
            <div class="p-2">
                <input type="time" class="form-control" id="etime" placeholder="Enter event end time" required>
            </div>
        </div>
    </div>
    <div class="col-12">
        <h6>Event Description *</h6>
        <div class="p-2">
            <textarea rows="5" class="form-control texteditor-content" id="description" placeholder="Enter event description" required></textarea>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="p-2">
            <label for="images">Event Images *</label>
            <div class="input-images" id="images" style="padding-top: .5rem;background: white"></div>
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
        var description = $("#description").val();
        var youtube = $("#youtube").val();
        var venue = $("#venue").val();
        var images = [];
        var sdate = $("#sdate").val();
        var edate = $("#edate").val();

        var stime = $("#stime").val();
        var etime = $("#etime").val();

        $(".uploaded-image").each(function() {
            images.push($(this).attr("data-name"));
        });
        if (name == "" || sdate == "" || edate == "" || stime == "" || etime == "") {
            swal({
                icon: 'error',
                type: 'error',
                title: 'Oops...',
                text: 'Please fill all the fields!',
            })
        } else {
            swal({
                title: 'Are you sure to publish?',
                text: "The post will be saved and pushed to the server!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var formData = new FormData();
                    formData.append("mode", "addevent");
                    formData.append("title", name);
                    formData.append("youtube", youtube);
                    formData.append("description", description);
                    formData.append("images", images);
                    formData.append("sdate", sdate);
                    formData.append("edate", edate);
                    formData.append("stime", stime);
                    formData.append("etime", etime);
                    formData.append("venue", venue);
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
                                    text: "Your event has been saved successfully!",
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