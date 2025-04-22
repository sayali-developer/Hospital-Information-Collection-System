<?php
$title = "Hospital's Dashboard : Reports";
require_once "chunks/top.php";
$con = $db->con();
$err = 0;
try {
    $q = $con->prepare("SELECT * FROM reporting WHERE hospital_id = ? ORDER BY rp_date DESC");
    $q->execute([$user["hospital_id"]]);

    $rows = $q->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    pageInfo("red", "Database Error Occurred, Please Try Again");
    $err++;
}
if ($err == 0):
    ?>
    <div class="row" style="margin-top: 10px;">
        <div class="col s12 z-depth-3" style="margin-top: 10px; min-height: 400px">
            <h5 class="teal-text">Reports : <?= $user["hospital_name"] ?></h5>
            <div style="padding: 10px;  overflow-y: scroll">
                <table class="centered highlight dataTable" style="border: 1px solid black">
                    <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Date</th>
                        <th>Total OPDs</th>
                        <th>IPDs (Remaining)</th>
                        <th>Surgeries / Deliveries</th>
                        <th>Total Patients Referred to District Covid Facility</th>
                        <th>Occupied Beds</th>
                        <th>Unoccupied Beds</th>
                        <th>Reported On</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date("d/m/Y", strtotime($row["rp_date"])) ?></td>
                            <td><?= $row["no_opd"] ?></td>
                            <td><?= $row["no_ipd"] ?></td>
                            <td><?= $row["no_surg"] ?></td>
                            <td><?= $row["no_cov"] ?></td>
                            <td><?= $row["occupied_beds"] ?></td>
                            <td><?= $row["empty_beds"] ?></td>
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
