<?php
$title = "Covid Referred Reports";
require_once "chunks/top.php";
$con = $db->con();
$err = 0;
try {
    $q = $con->query("SELECT r.*, h.* FROM reporting r JOIN hospitals h on r.hospital_id = h.hospital_id WHERE r.no_cov <> 0 ORDER BY rp_date DESC");
    $rows = $q->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    pageInfo("red", "Database Error Occurred, Please Try Again" . $e->getMessage());
    $err++;
}
if ($err == 0):
    ?>
    <div class="row" style="margin-top: 10px;">
        <div class="col s12 z-depth-3" style="margin-top: 10px; min-height: 400px">
            <div style="padding: 10px;  overflow-y: scroll">
                <h5 class="teal-text">Covid Referred Reports</h5>
                <table class="centered highlight dataTable" style="border: 1px solid black">
                    <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hospital Name</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Taluka</th>
                        <th>Date</th>
                        <th>Total OPDs</th>
                        <th>Total Patients Referred to District Covid Facility</th>
                        <th>IPDs<br/>(Remaining)</th>
                        <th>Surgeries / Deliveries</th>
                        <th>Occupied Beds</th>
                        <th>Unoccupied Beds</th>
                        <th>Doctors Name</th>
                        <th>Mobile Number</th>
                        <th>Reported On</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["hospital_name"] ?>
                            </td>
                            <td><?= ucwords($row["cat"]) ?></td>
                            <td><?= ucwords($row["hospital_type"]) ?></td>
                            <td><?= $row["subdist"] ?></td>

                            <td><?= date("d/m/Y", strtotime($row["rp_date"])) ?></td>
                            <td><?= $row["no_opd"] ?></td>

                            <td><?= $row["no_cov"] ?></td>
                            <td><?= $row["no_ipd"] ?></td>
                            <td><?= $row["no_surg"] ?></td>
                            <td><?= $row["occupied_beds"] ?></td>
                            <td><?= $row["empty_beds"] ?></td>

                            <td>
                                Dr. <?= $row["name_of_doctor"] ?>
                            </td>

                            <td>
                                Dr. <?= $row["mobile_number"] ?>
                            </td>
                            <td><?= date("d/m/y h:i:s A", strtotime($row["reported_on"])) ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
endif;
require_once "chunks/bottom.php";
