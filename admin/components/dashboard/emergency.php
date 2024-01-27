<?php
$sql = "SELECT * FROM emergency";
$stmt = $pdoConn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
?>
<br />
<div class="white-box">
    <h6>Emergency Number *</h6>
    <div class="p-2">
        <input type="text" class="form-control" id="name" placeholder="Enter Emergency Number" required value="<?= $result[0]['phone'] ?>">
    </div>
    <div class="p-2">
        <button type="button" class="w-100 btn btn-primary saveButton">Save changes</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#bDataTable').DataTable();
    });
    $(".saveButton").click(function() {
        var name = $("#name").val();
        if (name == "") {
            swal({
                icon: 'error',
                type: 'error',
                title: 'Oops...',
                text: 'Please fill all the fields!',
            })
        } else {
            var formData = new FormData();
            formData.append("mode", "addemergency");
            formData.append("phone", name);
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
                            text: "Emergency Number has been saved successfully!",
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
</script>