<?php

$sql = "SELECT * FROM admins";
$stmt = $pdoConn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
?>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">Admins</h3>
            </div>
            <div class="table-responsive">
                <table class="table no-wrap bDataTable" id="bDataTable">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Name</th>
                            <th class="border-top-0">Phone</th>
                            <th class="border-top-0">Email</th>
                            <th class="border-top-0">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $key => $value) {
                            echo '<tr>';
                            echo "<td>" . ($key + 1) . "</td>";
                            echo "<td>" . $value['fullname'] . "</td>";
                            echo "<td>" . $value['phone'] . "</td>";
                            echo "<td>" . $value['email'] . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($value['created_at'])) . "</td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>