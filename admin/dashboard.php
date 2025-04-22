<?php
$title = "HICS Reporting Dashboard";
$rf = "2020-04-15";
$rt = date("Y-m-d");
if (isset($_GET["reports_from"]) && isset($_GET["reports_to"])) {
    $rf = $_GET["reports_from"];
    $rt = $_GET["reports_to"];
    if ($rf > $rt) {
        $err++;
        pageInfo("red", "Invalid Date Range Selected, Showing Default Reports");
    }
}
require_once "chunks/top.php";
$err = 0;
try {
    $q = $con->query("SELECT sum(ipd_rem) as no_ipd, count(*) as hosp_count FROM hospitals WHERE ac_status = 'active'");
    $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
    $no_ipd = is_numeric($tmp["no_ipd"]) ? $tmp["no_ipd"] : 0;

    $no_act_hosp = $tmp["hosp_count"];
    $q = $con->query("SELECT sum(no_opd) as total_opd, sum(no_cov) as total_covid FROM reporting");
    $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
    $no_opd = is_numeric($tmp["total_opd"]) ? $tmp["total_opd"] : 0;
    $no_covid = is_numeric($tmp["total_covid"]) ? $tmp["total_covid"] : 0;
    $subdists =
        [
            "Pune City" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Pimpri-Chinchwad City" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Haveli" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Khed" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Ambegaon" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Junnar" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Shirur" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Daund" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Indapur" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Baramati" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Purandar" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Bhor" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Velhe" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Mulshi" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0],
		"Maval" => ["all" => [], "hosp" => 0, "no_opd" => 0, "no_cov" => 0, "no_ipd" => 0, "no_surgeries" => 0]


        ];
    foreach ($subdists as $subdist => $arr) {
        $q = $con->prepare("SELECT hospital_name as h_name,
                    sum(no_of_docs) as docs,
                    sum(no_of_beds) as beds, 
                    sum(no_of_wards) as wards,
                    sum(no_of_ppe) as ppe,
                    sum(no_of_ambs) as ambs,
                    sum(no_of_nurses) as nurses,
                    sum(no_of_o2_conc) as o2_cons,   
                    sum(no_of_o2_cel) as o2_cels,
                    sum(no_of_monitors) as mon,
                    sum(no_of_vents) as vents,
                    sum(no_of_nebs) as nebs, count(*) as hosp_count, sum(ipd_rem) as ipd  FROM hospitals WHERE ac_status = 'active' AND subdist = ?");
        $q->execute([$subdist]);
        $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
        $subdists[$subdist]["all"] = $tmp;
        $subdists[$subdist]["hosp"] = $tmp["hosp_count"];
        $subdists[$subdist]["no_ipd"] = is_numeric($tmp["ipd"]) ? $tmp["ipd"] : 0;

        $q = $con->prepare("SELECT sum(no_opd) as total_opd, sum(no_cov) as total_covid, sum(no_surg) as total_surg FROM reporting  WHERE (reporting.rp_date BETWEEN ? and ?)and  reporting.hospital_id IN (SELECT hospitals.hospital_id FROM hospitals WHERE subdist = ?)");
        $q->execute([$rf, $rt, $subdist]);
        $tmp = $q->fetchAll(PDO::FETCH_ASSOC)[0];
        $subdists[$subdist]["no_opd"] = is_numeric($tmp["total_opd"]) ? $tmp["total_opd"] : 0;
        $subdists[$subdist]["no_cov"] = is_numeric($tmp["total_covid"]) ? $tmp["total_covid"] : 0;
        $subdists[$subdist]["no_surgeries"] = is_numeric($tmp["total_surg"]) ? $tmp["total_surg"] : 0;

    }

} catch (PDOException $e) {
	
    $err++;
    pageInfo("red", "Database Error!" . $e->getMessage());
}
if ($err == 0):

    ?>
    <div id="card-stats">
        <div class="row mt-1">
            <div class="col s12 m6 l3">
                <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">local_hospital</i>
                            <p>Active Hospitals</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5><?= $no_act_hosp ?></h5>
                            <p class="no-margin">Total</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">local_hospital</i>
                            <p>Total OPD</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5><?= $no_opd ?></h5>
                            <p class="no-margin">Total</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">group_work</i>
                            <p>Total IPD</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5><?= $no_ipd ?></h5>
                            <p class="no-margin">Total</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l3">
                <div onclick="window.location.href = 'covRefReports.php'" style="cursor: pointer"
                     class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                        <div class="col s7 m7">
                            <p class="mt-5">Patients Referred to District Covid Facility </p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5><?= $no_covid ?></h5>
                            <p class="no-margin">Total</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="margin: 10px;">
        <div class="row z-depth-1" style="padding: 5px">
            <?php
            if (isset($_GET["rp_date_1"]))
                $d = $_GET["rp_date_1"];
            else
                $d = date("Y-m-d");
            $z = 0;
            $stmt = "SELECT count(*) as total_reporting, sum(no_opd) as total_opd, sum(no_cov) as total_covid,  sum(occupied_beds) as total_occ_beds FROM reporting WHERE rp_date = ?";
            try {
                $q = $con->prepare($stmt);
                $q->execute([$d]);
                $reporting = $q->fetchAll(PDO::FETCH_ASSOC)[0];
                $q = $con->query("SELECT sum(no_of_beds) as total_beds FROM hospitals WHERE ac_status = 'ACTIVE'");

                $reporting["total_beds"] = $q->fetchAll(PDO::FETCH_ASSOC)[0]["total_beds"];
            } catch (PDOException $e) {
		print_r($e);
                echo "<script>alert('Database Error')</script>";
                $z++;
            }

            ?>

            <?php if ($z == 0): ?>
                <div class="col s12">
                    <form action="" class="row">
                        <div class="container">
                            <label for="rp_date_1" class="black-text"><strong>Performance Statistics (<?= $d ?>
                                    )</strong></label>
                            <input type="date" value="<?= $d ?>" class="validate" required name="rp_date_1"
                                   id="rp_date_1">

                        </div>
                        <div class="container">
                            <button type="submit" class="btn waves-effect indigo right">Submit</button>
                        </div>
                    </form>
                    <div class="row mt-1">
                        <div style="cursor: pointer"
                             onclick="window.location.href = 'non_reporting_hospitals.php?r=1&d=<?= $d ?>'"
                             class="col s12 m6 l3">
                            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                                <div class="padding-4">
                                    <div class="col s7 m7">
                                        <p>Reporting Hospitals</p>
                                    </div>
                                    <div class="col s5 m5 right-align">
                                        <h5><?= $reporting["total_reporting"] ?></h5>
                                        <p class="no-margin">Total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="cursor: pointer"
                             onclick="window.location.href = 'non_reporting_hospitals.php?r=0&d=<?= $d ?>'"
                             class="col s12 m6 l3">
                            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                                <div class="padding-4">
                                    <div class="col s7 m7">
                                        <p>Non Reporting Hospitals</p>
                                    </div>
                                    <div class="col s5 m5 right-align">
                                        <h5><?= $no_act_hosp - $reporting["total_reporting"] ?></h5>
                                        <p class="no-margin">Total</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6 l3">
                            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                                <div class="padding-4">
                                    <div class="col s7 m7">
                                        <p>Total OPD</p>
                                    </div>
                                    <div class="col s5 m5 right-align">
                                        <h5><?= is_numeric($reporting["total_opd"]) ? $reporting["total_opd"] : 0 ?></h5>
                                        <p class="no-margin">Total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l3">
                            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                                <div class="padding-4">
                                    <div class="col s7 m7">
                                        <p>Total Covid Reported</p>
                                    </div>
                                    <div class="col s5 m5 right-align">
                                        <h5><?= is_numeric($reporting["total_covid"]) ? $reporting["total_covid"] : 0 ?></h5>
                                        <p class="no-margin">Total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <br/>
        <div class="row z-depth-1" style="padding: 5px">
            <div class="col s12">
                <h5 class="center">Taluka Wise Resources Available</h5>
                <hr/>
                <div style="overflow-y: scroll">
                    <table class="centered highlight dataTable">
                        <thead>
                        <tr>
                            <th>Taluka Name</th>
                            <th>Hospitals</th>
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
                        <?php
                        $i = 0;
                        $t = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        foreach ($subdists as $subdist => $arr):

                            $h = $arr["all"];
                            ?>
                            <tr>
                                <td><?= $subdist ?></td>
                                <td><?= is_numeric($arr["hosp"]) ? $arr["hosp"] : 0 ?></td>
                                <td><?= is_numeric($h["docs"]) ? $h["docs"] : 0 ?></td>
                                <td><?= is_numeric($h["beds"]) ? $h["beds"] : 0 ?></td>
                                <td><?= is_numeric($h["wards"]) ? $h["wards"] : 0 ?></td>
                                <td><?= is_numeric($h["nurses"]) ? $h["nurses"] : 0 ?></td>
                                <td><?= is_numeric($h["ambs"]) ? $h["ambs"] : 0 ?></td>
                                <td><?= is_numeric($h["ppe"]) ? $h["ppe"] : 0 ?></td>
                                <td><?= is_numeric($h["vents"]) ? $h["vents"] : 0 ?></td>
                                <td><?= is_numeric($h["o2_cels"]) ? $h["o2_cels"] : 0 ?></td>
                                <td><?= is_numeric($h["o2_cons"]) ? $h["o2_cons"] : 0 ?></td>
                                <td><?= is_numeric($h["mon"]) ? $h["mon"] : 0 ?></td>
                                <td><?= is_numeric($h["nebs"]) ? $h["nebs"] : 0 ?></td>
                            </tr>
                            <?php
                            $t[11] += is_numeric($arr["hosp"]) ? $arr["hosp"] : 0;
                            $t[0] += is_numeric($h["docs"]) ? $h["docs"] : 0;
                            $t[1] += is_numeric($h["beds"]) ? $h["beds"] : 0;
                            $t[2] += is_numeric($h["wards"]) ? $h["wards"] : 0;
                            $t[3] += is_numeric($h["nurses"]) ? $h["nurses"] : 0;
                            $t[4] += is_numeric($h["ambs"]) ? $h["ambs"] : 0;
                            $t[5] += is_numeric($h["ppe"]) ? $h["ppe"] : 0;
                            $t[6] += is_numeric($h["vents"]) ? $h["vents"] : 0;
                            $t[8] += is_numeric($h["o2_cons"]) ? $h["o2_cons"] : 0;
                            $t[7] += is_numeric($h["o2_cels"]) ? $h["o2_cels"] : 0;
                            $t[9] += is_numeric($h["mon"]) ? $h["mon"] : 0;
                            $t[10] += is_numeric($h["nebs"]) ? $h["nebs"] : 0;
                        endforeach; ?>

                        <tr>
                            <td>Total</td>
                            <td><?= $t[11] ?></td>
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
                </div>
            </div>
        </div>
        <br/>
        <div class="row z-depth-1" style="padding: 5px">
            <div class="col s12">
                <h5 class="center">Taluka Wise Report</h5>
                <hr/>

                <form action="" onsubmit="return checkDates()" style="margin: 10px">
                    <div class="row">
                        <div class="col s12">
                            <p><strong>Select Report Range (Dates)</strong></p>
                        </div>
                        <div class="col s6">
                            <label for="reports_from">From</label>
                            <input type="date" required name="reports_from" id="reports_from">
                        </div>

                        <div class="col s6">
                            <label for="reports_to">To</label>
                            <input type="date" required name="reports_to" id="reports_to">
                        </div>
                        <div class="col s12" style="margin-bottom: 10px;">
                            <button type="submit" class="btn waves-effect indigo right">Submit</button>
                        </div>
                    </div>
                </form>
                <div style="overflow-y: scroll">
                    <table class="centered highlight dataTable">
                        <thead>
                        <tr>
                            <th>Sr. <br/>No.</th>
                            <th>Taluka Name</th>
                            <th>Active Hospitals</th>
                            <th>Total OPDs</th>
                            <th>IPDs (Remaining)</th>
                            <th>Surgeries Deliveries</th>
                            <th>Covid Referred</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $hosp_total = 0;
                        $opd_total = 0;
                        $ipd_total = 0;
                        $total_surgeries = 0;
                        $total_cov = 0;
                        $i = 1;
                        foreach ($subdists as $subdist => $arr): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $subdist ?></td>
                                <td><?= $arr["hosp"] ?></td>
                                <td><?= $arr["no_opd"] ?></td>
                                <td><?= $arr["no_ipd"] ?></td>
                                <td><?= $arr["no_surgeries"] ?></td>
                                <td><?= $arr["no_cov"] ?></td>
                                <?php
                                $hosp_total += $arr["hosp"];
                                $opd_total += $arr["no_opd"];
                                $ipd_total += $arr["no_ipd"];
                                $total_surgeries += $arr["no_surgeries"];
                                $total_cov += $arr["no_cov"];
                                ?>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>#</strong></td>
                            <td><strong>Total</strong></td>
                            <td><strong><?= $hosp_total ?></strong></td>
                            <td><strong><?= $opd_total ?></strong></td>
                            <td><strong><?= $ipd_total ?></strong></td>
                            <td><strong><?= $total_surgeries ?></strong></td>
                            <td><strong><?= $total_cov ?></strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("reports_from").value = "<?= $rf ?>";
        document.getElementById("reports_to").value = "<?= $rt ?>";

        function checkDates() {
            if (document.getElementById("reports_from").value > document.getElementById("reports_to").value) {
                Swal.fire({icon: "warning", title: "From date can't be greater than To date!!"})
                return false;
            }
            return true;
        }
    </script>
<?php
endif;
    require_once "chunks/bottom.php";
?>
