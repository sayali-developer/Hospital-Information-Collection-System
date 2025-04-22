<?php
$title = "Admin Dashboard : Hospital/Doctor Registration Requests";
$sadmin = true;
require_once "chunks/top.php";
$err = 0;
try {
    $q = $con->query("SELECT * FROM hospitals WHERE ac_status = 'REQUESTED'");
} catch (PDOException $e) {
    $err++;
    pageInfo("red", "Database Error, Please Try After Some Time!");
}

?>

<div class="row" style="margin-top: 10px;">
    <div class="col s12 z-depth-2">
        <h5 class="teal-text">New Hospital/Doctor Registration Requests (<?= $new_reg_req; ?>)</h5>
    </div>
    <?php
    if ($err == 0):
        $new_requests = $q->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="col s12 z-depth-3" style="margin-top: 10px; min-height: 400px">
            <div style="padding: 10px;  overflow-y: scroll">
                <table class="centered highlight dataTable" style="border: 1px solid black">
                    <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hospital Name</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Mobile</th>
                        <th>Taluka</th>
                        <th>Requested On</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($new_requests as $req): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><strong><?= $req["hospital_name"] ?></strong><br/>Dr. <?= $req["name_of_doctor"] ?></td>
                            <td><?= ucwords($req["cat"]) ?></td>
                            <td><?= $req["hospital_type"] ?></td>
                            <td><?= $req["mobile_number"] ?></td>
                            <td><?= $req["subdist"] ?></td>
                            <td><?= date("d/m/Y h:i:s A", strtotime($req["timestamp"])) ?></td>
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
