<?php


$sql = "SELECT * FROM events ORDER BY id DESC";
$stmt = $pdoConn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
?>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box text-end">
            <a href="<?= $adminBaseUrl ?>addevent" class="btn btn-success text-white">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                    <path fill="currentColor" d="M17 15V8h-2v7H8v2h7v7h2v-7h7v-2z" />
                </svg>
                Add new event
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">All events</h3>
            </div>
            <div class="table-responsive">
                <table class="table no-wrap bDataTable" id="bDataTable">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Title</th>
                            <th class="border-top-0">Venue</th>
                            <th class="border-top-0">Date</th>
                            <th class="border-top-0">Created Date</th>
                            <th class="border-top-0">Action</th>
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
                                    echo $value['name'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $value['venue'];
                                    ?>
                                </td>
                                <td><?php echo date('d M h:i A', strtotime($value['start_datetime'])); ?></td>
                                <td><?php echo date('d M h:i A', strtotime($value['created_date'])); ?></td>
                                <td>
                                    <a href="<?= $adminBaseUrl ?>editevent?eventid=<?= $value['id'] ?>" class="btn btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="if(confirm('Are you sure to delete ?')){deleteCode('<?= $value['id'] ?>')}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#bDataTable').DataTable();
    });

    function deleteCode($id) {
        $.ajax({
            url: "<?= $apiUrl ?>",
            type: 'POST',
            data: {
                eventid: $id,
                mode: 'deleteevent'
            },
            success: function(data) {
                if (data.error.code == '#200') {
                    location.reload();
                }
            }
        });
    }
</script>