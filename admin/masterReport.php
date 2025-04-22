<?php
if (isset($_GET["mst_date"]))
    $d = $_GET["mst_date"];
else
    $d = date("Y-m-d");
$title = "Taluka Wise Report " . date("d/m/Y", strtotime($d));

require_once "../include.php";
$dep = new department();
if (!$dep->loggedIn()) {
    pageInfo("red", "Login First!");
    header("Location: ../");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        th, td {
            text-align: center !important;
        }

        @page {
            size: auto
        }
    </style>

</head>


<?php


echo "<body>";

$db = new db;

$con = $db->con();

$err = 0;
try {
    
	$subdists[] = ["Pune City" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Pimpri-Chinchwad City" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Haveli" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Khed" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Ambegaon" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Junnar" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Shirur" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Daund" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Indapur" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Baramati" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Purandar" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Bhor" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Velhe" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Mulshi" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];

$subdists[] = ["Maval" => array( 
        "g" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
        "p" => ["hosp" => 0, "rep_hosps" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]
    )];


    $i = 0;
    foreach ($subdists as $subdist => $arr) {
        foreach ($arr as $a => $item)
            $subdist_name = $a;

        $q = $con->prepare("SELECT count(*) as hosp_count, sum(ipd_rem) as ipd  FROM hospitals WHERE ac_status = 'active' AND subdist = ? and cat = 'government'");
        $q->execute([$subdist_name]);

        $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
        $subdists[$subdist][$subdist_name]["g"]["hosp"] = $tmp["hosp_count"];
        $subdists[$subdist][$subdist_name]["g"]["no_ipd"] = is_numeric($tmp["ipd"]) ? $tmp["ipd"] : 0;

        $q = $con->prepare("SELECT count(*) as rep, sum(no_opd) as total_opd, sum(no_cov) as total_covid, sum(no_surg) as total_surg FROM reporting  WHERE (reporting.rp_date = ?)and  reporting.hospital_id IN (SELECT hospitals.hospital_id FROM hospitals WHERE subdist = ? and cat = 'government')");
        $q->execute([$d, $subdist_name]);
        $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
        $subdists[$subdist][$subdist_name]["g"]["rep_hosps"] = $tmp["rep"];
        $subdists[$subdist][$subdist_name]["g"]["no_opd"] = is_numeric($tmp["total_opd"]) ? $tmp["total_opd"] : 0;
        $subdists[$subdist][$subdist_name]["g"]["no_cov"] = is_numeric($tmp["total_covid"]) ? $tmp["total_covid"] : 0;
        $subdists[$subdist][$subdist_name]["g"]["no_surgeries"] = is_numeric($tmp["total_surg"]) ? $tmp["total_surg"] : 0;

        $q = $con->prepare("SELECT count(*) as hosp_count, sum(ipd_rem) as ipd  FROM hospitals WHERE ac_status = 'active' AND subdist = ? and cat = 'private'");
        $q->execute([$subdist_name]);
        $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
        $subdists[$subdist][$subdist_name]["p"]["hosp"] = $tmp["hosp_count"];
        $subdists[$subdist][$subdist_name]["p"]["no_ipd"] = is_numeric($tmp["ipd"]) ? $tmp["ipd"] : 0;

        $q = $con->prepare("SELECT count(*) as rep, sum(no_opd) as total_opd, sum(no_cov) as total_covid, sum(no_surg) as total_surg FROM reporting  WHERE (reporting.rp_date = ?)and  reporting.hospital_id IN (SELECT hospitals.hospital_id FROM hospitals WHERE subdist = ? and cat = 'private')");
        $q->execute([$d, $subdist_name]);
        $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
        $subdists[$subdist][$subdist_name]["p"]["rep_hosps"] = $tmp["rep"];
        $subdists[$subdist][$subdist_name]["p"]["no_opd"] = is_numeric($tmp["total_opd"]) ? $tmp["total_opd"] : 0;
        $subdists[$subdist][$subdist_name]["p"]["no_cov"] = is_numeric($tmp["total_covid"]) ? $tmp["total_covid"] : 0;
        $subdists[$subdist][$subdist_name]["p"]["no_surgeries"] = is_numeric($tmp["total_surg"]) ? $tmp["total_surg"] : 0;
        $i++;
    }

} catch (PDOException $e) {

    $err++;
    pageInfo("red", "Database Error!" . $e->getMessage());
}
if ($err == 0):
    ?>
    <div class="container-fluid m-2 p-2">
        <h5 class="text-center">Taluka Wise Report <?= date("d/m/Y", strtotime($d)) ?></h5>
        <hr/>

        <div>
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th rowspan="2">Taluka Name</th>
                    <th colspan="2">Active Hospitals</th>
                    <th colspan="2">Reporting Hospitals</th>
                    <th colspan="2">Non Reporting Hospitals</th>
                    <th colspan="2">Total OPDs</th>
                    <th colspan="2">IPDs(Remaining)</th>
                    <th colspan="2">Surgeries /Deliveries</th>
                    <th colspan="2">Referred to Covid Facility</th>
                </tr>
                <tr>
                    <th>GOV</th>
                    <th>PVT</th>
                    <th>GOV</th>
                    <th>PVT</th>
                    <th>GOV</th>
                    <th>PVT</th>
                    <th>GOV</th>
                    <th>PVT</th>
                    <th>GOV</th>
                    <th>PVT</th>
                    <th>GOV</th>
                    <th>PVT</th>
                    <th>GOV</th>
                    <th>PVT</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $hosp_reporting_g = 0;
                $hosp_n_reporting_g = 0;
                $hosp_total_g = 0;
                $opd_total_g = 0;
                $ipd_total_g = 0;
                $total_surgeries_g = 0;
                $total_cov_g = 0;
                $hosp_reporting_p = 0;
                $hosp_n_reporting_p = 0;
                $hosp_total_p = 0;
                $opd_total_p = 0;
                $ipd_total_p = 0;
                $total_surgeries_p = 0;
                $total_cov_p = 0;
                $i = 1;
                foreach ($subdists as $sub => $ar):
                    foreach ($ar as $subdist => $arr):
                        ?>
                        <tr>
                            <td><?= $subdist ?></td>
                            <td><?= $arr["g"]["hosp"] ?></td>
                            <td><?= $arr["p"]["hosp"] ?></td>
                            <td><?= $arr["g"]["rep_hosps"] ?></td>
                            <td><?= $arr["p"]["rep_hosps"] ?></td>
                            <td><?= $arr["g"]["hosp"] - $arr["g"]["rep_hosps"] ?></td>
                            <td><?= $arr["p"]["hosp"] - $arr["p"]["rep_hosps"] ?></td>
                            <td><?= $arr["g"]["no_opd"] ?></td>
                            <td><?= $arr["p"]["no_opd"] ?></td>
                            <td><?= $arr["g"]["no_ipd"] ?></td>
                            <td><?= $arr["p"]["no_ipd"] ?></td>
                            <td><?= $arr["g"]["no_surgeries"] ?></td>
                            <td><?= $arr["p"]["no_surgeries"] ?></td>
                            <td><?= $arr["g"]["no_cov"] ?></td>
                            <td><?= $arr["p"]["no_cov"] ?></td>


                            <?php
                            $hosp_reporting_g += $arr["g"]["rep_hosps"];
                            $hosp_n_reporting_g += $arr["g"]["hosp"] - $arr["g"]["rep_hosps"];
                            $hosp_total_g += $arr["g"]["hosp"];
                            $opd_total_g += $arr["g"]["no_opd"];
                            $ipd_total_g += $arr["g"]["no_ipd"];
                            $total_surgeries_g += $arr["g"]["no_surgeries"];
                            $total_cov_g += $arr["g"]["no_cov"];

                            $hosp_reporting_p += $arr["p"]["rep_hosps"];
                            $hosp_n_reporting_p += $arr["p"]["hosp"] - $arr["p"]["rep_hosps"];
                            $hosp_total_p += $arr["p"]["hosp"];
                            $opd_total_p += $arr["p"]["no_opd"];
                            $ipd_total_p += $arr["p"]["no_ipd"];
                            $total_surgeries_p += $arr["p"]["no_surgeries"];
                            $total_cov_p += $arr["p"]["no_cov"];

                            ?>
                        </tr>
                    <?php endforeach; endforeach; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong><?= $hosp_total_g ?></strong></td>
                    <td><strong><?= $hosp_total_p ?></strong></td>
                    <td><strong><?= $hosp_reporting_g ?></strong></td>
                    <td><strong><?= $hosp_reporting_p ?></strong></td>
                    <td><strong><?= $hosp_n_reporting_g ?></strong></td>
                    <td><strong><?= $hosp_n_reporting_p ?></strong></td>
                    <td><strong><?= $opd_total_g ?></strong></td>
                    <td><strong><?= $opd_total_p ?></strong></td>
                    <td><strong><?= $ipd_total_g ?></strong></td>
                    <td><strong><?= $ipd_total_p ?></strong></td>
                    <td><strong><?= $total_surgeries_g ?></strong></td>
                    <td><strong><?= $total_surgeries_p ?></strong></td>
                    <td><strong><?= $total_cov_g ?></strong></td>
                    <td><strong><?= $total_cov_p ?></strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
endif;

?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>

