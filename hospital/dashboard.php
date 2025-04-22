<?php
$title = "Hospital Dashboard";
require_once "chunks/top.php";
?>
    <div class="container">
    <div class="row padding-2" style="margin-top: 10px">
        <form action="backend/reporting-form.php" id="_form" method="post">
            <div class="col s12 z-depth-1 padding-2 margin-card">
                <h5 class="pink-text">Daily Reporting Form</h5>
                <h6 style="text-transform: capitalize">Information about patients in hospital</h6>
            </div>
            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="date">Date <sup>*</sup></label>
                    <input type="date" id="date" name="date" value="<?= date('Y-m-d', time()) ?>" required
                           class="reporting-form-input">
                </div>
            </div>
            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="no_opd">Number of patients attended in OPD (Including Emergencies &
                        Night Calls) <sup>*</sup></label>
                    <input type="number" id="no_opd" placeholder="OPD Patients" name="no_opd" min="0" max="1000"
                           required class="validate reporting-form-input">
                </div>
            </div>
            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="no_ipd">Total IPD Patients (Remaining) <sup>*</sup></label>
                    <input type="number" id="no_ipd" placeholder="If Not Applicable Use 0" name="no_ipd" min="0"
                           max="1000" required class="validate reporting-form-input">
                </div>
            </div>
            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="no_surge">No. of Major + Minor Surgeries + Deliveries (For Surgical &
                        OBGY Braches)
                        <sup>*</sup></label>
                    <input type="number" id="no_surge" placeholder="If Not Applicable Use 0" name="no_surge" min="0"
                           max="1000" required class="validate reporting-form-input">

                </div>
            </div>

            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="no_cov">Number Of Patients referred to District COVID
                        facility<sup>*</sup></label>
                    <input type="number" id="no_cov" placeholder="If Not Applicable Use 0" name="no_cov" min="0"
                           max="1000" required class="validate reporting-form-input">
                </div>
            </div>
            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="no_occ">Number of occupied beds<sup>*</sup></label>
                    <input type="number" id="no_occ" placeholder="If Not Applicable Use 0" name="no_occ" min="0"
                           max="1000000" required class="validate reporting-form-input">
                </div>
            </div>
            <div class="col s12 padding-2 z-depth-1 margin-card">
                <div class="reporting-form-field">
                    <label class="lg-label" for="no_emp">Number of unoccupied beds<sup>*</sup></label>
                    <input type="number" id="no_emp" placeholder="If Not Applicable Use 0" name="no_emp" min="0"
                           max="1000000" required class="validate reporting-form-input">
                </div>
            </div>

            <div class="col s12 padding-2 z-depth-1 margin-card">
                <button type="button" onclick="confirmForm()" style="margin: 3px"
                        class="right btn btn-large waves-effect indigo">Submit
                </button>
                <button type="reset" style="margin: 3px" class="right btn btn-large waves-effect red">Reset</button>
            </div>
        </form>

    </div>
    <script>
        async function confirmForm() {
            let total_beds = <?= $user["no_of_beds"] ?>;
            let occ_beds = parseInt(document.getElementById("no_occ").value);
            let empty_beds = parseInt(document.getElementById("no_emp").value);
            if ((empty_beds + occ_beds) != total_beds) {
                Swal.fire({
                    title: "Please confirm number of occupied and unoccupied beds!",
                    text: "Please update your profile from update details page if you have any changes to the number of available beds as number of unoccupied beds and occupied beds is not matching to the total available at your hospital i.e. " + total_beds,
                    icon: "error"
                })
                return false;
            }
            var conf = await Swal.fire({
                title: "Confirm Report For " + document.getElementById("date").value,
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Yes, I Confirm!",
                html: `
                    <table class="centered highlight">
                        <tr>
                            <td>OPD Patients</td>
                            <td>` + document.getElementById("no_opd").value + `</td>
                        </tr>
                        <tr>
                            <td>IPD Patients</td>
                            <td>` + document.getElementById("no_ipd").value + `</td>
                        </tr>
                        <tr>
                            <td>Surgeries/Deliveries</td>
                            <td>` + document.getElementById("no_surge").value + `</td>
                        </tr>
                        <tr>
                            <td>Covid Referred</td>
                            <td>` + document.getElementById("no_cov").value + `</td>
                        </tr>
                        <tr>
                            <td>Occupied Beds</td>
                            <td>` + occ_beds + `</td>
                        </tr>
                        <tr>
                            <td>Empty Beds</td>
                            <td>` + empty_beds + `</td>
                        </tr>
                    </table>
                `
            });
            if (conf.value) {
                document.getElementById("_form").submit();
            }
            return false;
        }
    </script>
<?php
require_once "chunks/bottom.php";
