<?php
$title = "Admin Dashboard : Active Hospitals";
$sadmin = true;
require_once "chunks/top.php";
$err = 0;
try {
    $q = $con->query("SELECT * FROM hospitals WHERE ac_status = 'ACTIVE'");
} catch (PDOException $e) {
    $err++;
    pageInfo("red", "Database Error, Please Try After Some Time!");
}

?>

<div class="row" style="margin-top: 10px;">

    <?php
    if ($err == 0):
        $new_requests = $q->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="col s12 z-depth-2">
            <h5 class="teal-text">Active Hospitals/Doctors (<?= count($new_requests) ?>)</h5>
        </div>
        <div class="col s12 z-depth-3" style="margin-top: 10px; min-height: 400px">
            <div style="padding: 10px;  overflow-y: scroll">
                <table class="centered highlight dataTable" style="border: 1px solid black">
                    <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hospital Name</th>
                        <th>Doctor's Name</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Mobile</th>
                        <th>Taluka</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($new_requests as $req): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $req["hospital_name"] ?></td>
                            <td>Dr. <?= $req["name_of_doctor"] ?></td>
                            <td><?= ucwords($req["cat"]) ?></td>
                            <td><?= $req["hospital_type"] ?></td>
                            <td><?= $req["mobile_number"] ?></td>
                            <td><?= $req["subdist"] ?></td>
                            <td><a href="viewHospital.php?id=<?= $req["uqid"] ?>"><i
                                            class="material-icons">open_in_new</i> </a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php
require_once "chunks/bottom.php";
?>
