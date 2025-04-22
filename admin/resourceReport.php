<?php
$title = "Available Resources Report";
if (isset($_GET["hosp_cat"]) && isset($_GET["subdist_"])) {
    $i = 0;
    if ($_GET["hosp_cat"] == "all")
        $cat = "'private', 'government'";
    else
        $cat = $_GET["hosp_cat"];

    if ($_GET["subdist_"] == "ALL")  
		$subdist = "'Pune City', 'Pimpri-Chinchwad City', 'Haveli', 'Khed', 'Ambegaon', 'Junnar', 'Shirur', 'Daund', 'Indapur', 'Baramati', 'Purandar', 'Bhor', 'Velhe', 'Mulshi', 'Maval'";

	else
        $subdist = $_GET["subdist_"];
    $i = 0;

} else {
    pageInfo("red", "Failed to load reports, fields missing");
    header("Location: reports.php");
}
require_once "chunks/top.php";
try {
    if ($_GET["subdist_"] == "ALL" && $_GET["hosp_cat"] == "all") {
        $q = $con->query("
                SELECT 
                    hospital_name as h_name,
                    subdist,
                    cat,
                    no_of_docs as docs,
                    no_of_beds as beds, 
                    no_of_wards as wards,
                    no_of_ppe as ppe,
                    no_of_ambs as ambs,
                    no_of_nurses as nurses,
                    no_of_o2_conc as o2_cons,   
                    no_of_o2_cel as o2_cels,
                    no_of_monitors as mon,
                    no_of_vents as vents,
                    no_of_nebs as nebs   
                FROM hospitals where ac_status = 'active'
                "
        );
        $hosps = $q->fetchAll(PDO::FETCH_ASSOC);

    }

    if ($_GET["subdist_"] == "ALL" && $_GET["hosp_cat"] <> "all") {
        $q = $con->prepare("
                SELECT 
                    hospital_name as h_name,
                    subdist,
                    cat,
                    no_of_docs as docs,
                    no_of_beds as beds, 
                    no_of_wards as wards,
                    no_of_ppe as ppe,
                    no_of_ambs as ambs,
                    no_of_nurses as nurses,
                    no_of_o2_conc as o2_cons,   
                    no_of_o2_cel as o2_cels,
                    no_of_monitors as mon,
                    no_of_vents as vents,
                    no_of_nebs as nebs   
                FROM hospitals 
                WHERE cat = ? and ac_status = 'active'
                "
        );
        $q->execute([$_GET["hosp_cat"]]);
        $hosps = $q->fetchAll(PDO::FETCH_ASSOC);
    }
    if ($_GET["subdist_"] <> "ALL" && $_GET["hosp_cat"] == "all") {
        $q = $con->prepare("
                SELECT 
                    hospital_name as h_name,
                    subdist,
                    cat,
                    no_of_docs as docs,
                    no_of_beds as beds, 
                    no_of_wards as wards,
                    no_of_ppe as ppe,
                    no_of_ambs as ambs,
                    no_of_nurses as nurses,
                    no_of_o2_conc as o2_cons,   
                    no_of_o2_cel as o2_cels,
                    no_of_monitors as mon,
                    no_of_vents as vents,
                    no_of_nebs as nebs   
                FROM hospitals 
                WHERE subdist = ?
                "
        );
        $q->execute([$_GET["subdist_"]]);
        $hosps = $q->fetchAll(PDO::FETCH_ASSOC);
    }
    if ($_GET["subdist_"] <> "ALL" && $_GET["hosp_cat"] <> "all") {
        $q = $con->prepare("
                SELECT 
                    hospital_name as h_name,
                    subdist,
                    cat,
                    no_of_docs as docs,
                    no_of_beds as beds, 
                    no_of_wards as wards,
                    no_of_ppe as ppe,
                    no_of_ambs as ambs,
                    no_of_nurses as nurses,
                    no_of_o2_conc as o2_cons,   
                    no_of_o2_cel as o2_cels,
                    no_of_monitors as mon,
                    no_of_vents as vents,
                    no_of_nebs as nebs   
                FROM hospitals 
                WHERE subdist = ? and cat = ? and ac_status = 'active'
                "
        );
        $q->execute([$_GET["subdist_"], $_GET["hosp_cat"]]);
        $hosps = $q->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $i++;
    pageInfo("red", "Database Error, While loading reports!");
}
if ($i == 0):
    ?>
    <style>
        th, td {
            text-align: center;

        }
    </style>
    <br/>
    <h5 class="center"><?= $title ?></h5>
    <br/>
    <table class="highlight centered dataTable">
        <thead>
        <tr>
            <th>Sr</th>
            <th>Name of Hospital</th>
            <th>Category</th>
            <th>Taluka</th>
            <th>Doctors</th>
            <th>Beds</th>
            <th>Wards</th>
            <th>Nurses</th>
            <th>Ambulances</th>
            <th>PPE</th>
            <th>Ventilators</th>
            <th>O<sub>2</sub> Cylinders</th>
            <th>O<sub>2</sub> Concentrators</th>
            <th>Monitors</th>
            <th>Nebulizers</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0;
        $t = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($hosps as $h): ?>
            <tr>
                <td><?= ++$i ?></td>
                <td><?= $h["h_name"] ?></td>
                <td><?= ucwords($h["cat"]) ?></td>
                <td><?= $h["subdist"] ?></td>
                <td><?= $h["docs"] ?></td>
                <td><?= $h["beds"] ?></td>
                <td><?= $h["wards"] ?></td>
                <td><?= $h["nurses"] ?></td>
                <td><?= $h["ambs"] ?></td>
                <td><?= $h["ppe"] ?></td>
                <td><?= $h["vents"] ?></td>
                <td><?= $h["o2_cels"] ?></td>

                <td><?= $h["o2_cons"] ?></td>
                <td><?= $h["mon"] ?></td>
                <td><?= $h["nebs"] ?></td>
            </tr>
            <?php
            $t[0] += $h["docs"];
            $t[1] += $h["beds"];
            $t[2] += $h["wards"];
            $t[3] += $h["nurses"];
            $t[4] += $h["ambs"];
            $t[5] += $h["ppe"];
            $t[6] += $h["vents"];
            $t[8] += $h["o2_cons"];
            $t[7] += $h["o2_cels"];
            $t[9] += $h["mon"];
            $t[10] += $h["nebs"];
        endforeach;
        ?>
        <tr>
            <td>0</td>
            <td>Total Hospitals <?= $i ?></td>
            <td>-</td>
            <td>-</td>
            <td><?= $t[0] ?></td>
            <td><?= $t[1] ?></td>
            <td><?= $t[2] ?></td>
            <td><?= $t[3] ?></td>
            <td><?= $t[4] ?></td>
            <td><?= $t[5] ?></td>
            <td><?= $t[6] ?></td>
            <td><?= $t[7] ?></td>
            <td><?= $t[8] ?></td>
            <td><?= $t[9] ?></td>
            <td><?= $t[10] ?></td>
        </tr>
        </tbody>
    </table>
<?php
endif;
require_once "chunks/bottom.php";
