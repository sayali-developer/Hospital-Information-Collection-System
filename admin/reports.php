<?php
$title = "Admin Dashboard: Reports";
$rf = "2020-04-15";
$rt = date("Y-m-d");

require_once "chunks/top.php";

?>
    <br/>
    <div class="container white z-depth-1">
        <form action="loadReports.php" method="post" onsubmit="return checkDates()" style="margin: 10px">
            <div class="row">
                <div class="col s12">
                    <p><strong>Reported Entries</strong></p>
                </div>
                <div class="col s6">
                    <label for="reports_from">From</label>
                    <input type="date" required name="reports_from" id="reports_from">
                </div>

                <div class="col s6">
                    <label for="reports_to">To</label>
                    <input type="date" required name="reports_to" id="reports_to">
                </div>
                <div class="col s6 input-field">
                    <select name="subdist" id="subdist" class="validate">
                        <option value="ALL" selected>ALL</option>
                        <option value="Pune City">Pune City</option>
                    <option value="Pimpri-Chinchwad City">Pimpri-Chinchwad City</option>
                    <option value="Haveli">Haveli</option>
                    <option value="Khed">Khed</option>
                    <option value="Ambegaon">Ambegaon</option>
                    <option value="Junnar">Junnar</option>
                    <option value="Shirur">Shirur</option>
                    <option value="Daund">Daund</option>
                    <option value="Indapur">Indapur</option>
                    <option value="Baramati">Baramati</option>
                    <option value="Purandar">Purandar</option>
                    <option value="Bhor">Bhor</option>
                    <option value="Velhe">Velhe</option>
                    <option value="Mulshi">Mulshi</option>
                    <option value="Maval">Maval</option>
                    </select>
                    <label for="subdist">Taluka</label>
                </div>
                <div class="col s6 input-field">
                    <select name="type_of_hosp" id="type_of_hosp" class="validate">
                        <option value="ALL">ALL</option>
                        <option value="ayurvedic">Ayurvedic</option>
                        <option value="allopathy">Allopathy</option>
                        <option value="homoeopathy">Homoeopathy</option>
                        <option value="unani">Unani</option>
                        <option value="other">Other</option>
                    </select>
                    <label for="type_of_hosp">Type of Hospital</label>
                </div>
                <div class="col s12" style="margin-bottom: 10px;">
                    <button type="submit" class="btn waves-effect indigo right">Generate Reports</button>
                </div>

            </div>
        </form>
    </div>
    <br/>

    <div class="container white z-depth-1">
        <form target="_blank" action="resourceReport.php" style="margin: 10px">
            <div class="row">
                <div class="col s12">
                    <p><strong>Report of Available Resources</strong></p>
                </div>
                <div class="col s6">
                    <label for="mst_date">Category</label>
                    <select name="hosp_cat" id="hosp_cat">
                        <option value="all">ALL</option>
                        <option value="private">Private</option>
                        <option value="government">Government</option>
                    </select>
                </div>
                <div class="col s6">
                    <label for="subdist_">Taluka</label>
                    <select name="subdist_" id="subdist_" class="validate">
                        <option value="ALL" selected>ALL</option>
                        <option value="Pune City">Pune City</option>
                    <option value="Pimpri-Chinchwad City">Pimpri-Chinchwad City</option>
                    <option value="Haveli">Haveli</option>
                    <option value="Khed">Khed</option>
                    <option value="Ambegaon">Ambegaon</option>
                    <option value="Junnar">Junnar</option>
                    <option value="Shirur">Shirur</option>
                    <option value="Daund">Daund</option>
                    <option value="Indapur">Indapur</option>
                    <option value="Baramati">Baramati</option>
                    <option value="Purandar">Purandar</option>
                    <option value="Bhor">Bhor</option>
                    <option value="Velhe">Velhe</option>
                    <option value="Mulshi">Mulshi</option>
                    <option value="Maval">Maval</option>
                    </select>
                </div>
                <div class="col s12" style="margin-bottom: 10px;">
                    <button type="submit" class="btn waves-effect indigo right">Generate Resources Reports</button>
                </div>

            </div>
        </form>
    </div>
    <br/>
    <div class="container white z-depth-1">
        <form target="_blank" action="masterReport.php" style="margin: 10px">
            <div class="row">
                <div class="col s12">
                    <p><strong>Master Report</strong></p>
                </div>
                <div class="col s6">
                    <label for="mst_date">Report Date</label>
                    <input type="date" required name="mst_date" id="mst_date">
                </div>
                <div class="col s12" style="margin-bottom: 10px;">
                    <button type="submit" class="btn waves-effect indigo right">Generate Master Reports</button>
                </div>

            </div>
        </form>
    </div>
    <script>
        document.getElementById("reports_from").value = "<?= $rf ?>";
        document.getElementById("reports_to").value = "<?= $rt ?>";

        function checkDates() {
            if (document.getElementById("reports_from").value > document.getElementById("reports_to").value) {
                Swal.fire({icon: "warning", title: "From date can't be greater than To date!!"})
                return false;
            }
            let subdist = document.getElementById("subdist").value;
            return true;
        }
    </script>
<?php
require_once "chunks/bottom.php";
