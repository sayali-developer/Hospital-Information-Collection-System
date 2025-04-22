<?php
if (isset($_GET["d"]))
    $d = $_GET["d"];
else
    $d = date("Y-m-d");
if ($_GET["r"] == 0)
    $title = "Non Reporting Hospitals";
else
    $title = "Reporting Hospitals";
require_once "chunks/top.php";
try {
    if ($_GET["r"] == 0)
        $q = $con->prepare("SELECT hospital_name, cat,hospital_type, uqid, name_of_doctor, mobile_number FROM hospitals WHERE ac_status = 'ACTIVE' and hospital_id not in (SELECT hospital_id FROM reporting WHERE rp_date = ?)");

    else
        $q = $con->prepare("SELECT hospital_name, cat,hospital_type, uqid, name_of_doctor, mobile_number FROM hospitals WHERE ac_status = 'ACTIVE' and hospital_id in (SELECT hospital_id FROM reporting WHERE rp_date = ?)");
    $q->execute([$d]);
    $data__ = $q->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    pageInfo("red", "Database Error - " . $e->getMessage());
}
if (isset($data__)):
    $z = 0;
    ?>
    <div class="container" style="margin-top: 10px">
        <h5 align="center"><?= $title ?> on <?= date("d/m/Y", strtotime($d)) ?> - (<?= count($data__) ?>)</h5>
        <table class="dataTable centered">
            <thead>
            <tr>
                <th>Sr No</th>
                <th>Hospital Name</th>
                <th>Doctor's Name</th>
                <th>Mobile Number</th>
                <th>Category</th>
                <th>Type</th>
                <th>view</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data__ as $item):
                ?>
                <tr>
                    <td><?= ++$z ?></td>
                    <td><?= $item["hospital_name"] ?></td>
                    <td><?= $item["name_of_doctor"] ?></td>
                    <td><?= $item["mobile_number"] ?></td>
                    <td><?= $item["cat"] ?></td>
                    <td><?= $item["hospital_type"] ?></td>
                    <td><a href="viewHospital.php?id=<?= $item["uqid"] ?>"><i
                                class="material-icons">open_in_new</i> </a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
endif;
require_once "chunks/bottom.php";
