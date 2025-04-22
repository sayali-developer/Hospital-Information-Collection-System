<?php

$title = "Hospital's Dashboard : Update Details";
require_once "chunks/top.php";

?>
    <style>
        label {
            color: black !important;
        }
    </style>
    <div class="container">
        <form method="post" action="backend/update-hospital-details.php" class="row z-depth-1"
              style="margin-top: 10px; padding: 10px;">
            <div class="col s12">
                <h5 style="text-align: left"><strong>Update Hospital Details -</strong></h5>
                <br/>
            </div>
            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_beds" placeholder="Number of Beds" id="no_of_beds" min="0"
                           max="100000"
                           class="validate" required
                           value="<?= $user["no_of_beds"] ?>">
                    <label for="no_of_beds">Number of Beds</label>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_wards" placeholder="Number of Wards" id="no_of_wards" min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_wards"] ?>">
                    <label for="no_of_wards">Number of Wards</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_docs" placeholder="Number of Doctors" id="no_of_docs" min="1"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_docs"] ?>">
                    <label for="no_of_docs">Number of Doctors</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_nurses" placeholder="Number of Nurses" id="no_of_nurses" min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_nurses"] ?>">
                    <label for="no_of_nurses">Number of Nurses</label>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_other_staff" placeholder="Number of Other Staff"
                           id="no_of_other_staff"
                           min="0" max="10000" class="validate" required
                           value="<?= $user["no_of_other_staff"] ?>">
                    <label for="no_of_other_staff">Number of Other Staff</label>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_amb" placeholder="Number of Ambulances" id="no_of_amb" min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_ambs"] ?>">
                    <label for="no_of_amb">Number of Ambulances</label>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_ppe" placeholder="Number of PPE Kits" id="no_of_ppe" min="0"
                           max="1000000" class="validate" required
                           value="<?= $user["no_of_ppe"] ?>">
                    <label for="no_of_ppe">Number of PPE Kits</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_vent" placeholder="Number of Ventilators" id="no_of_vent" min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_vents"] ?>">
                    <label for="no_of_vent">Number of Ventilators</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_o2_cel" placeholder="Number of O2 Cylinders" id="no_of_o2_cel"
                           min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_o2_cel"] ?>">
                    <label for="no_of_o2_cel">Number of O2 Cylinders</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_o2_conc" placeholder="Number of O2 Concentrators"
                           id="no_of_o2_conc"
                           min="0" max="10000" class="validate" required
                           value="<?= $user["no_of_o2_conc"] ?>">
                    <label for="no_of_o2_conc">Number of O2 Concentrators</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_monitors" placeholder="Number of Monitors" id="no_of_monitors"
                           min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_monitors"] ?>">
                    <label for="no_of_monitors">Number of Monitors</label>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="input-field">
                    <input type="number" name="no_of_neb" placeholder="Number of Nebulizers" id="no_of_neb" min="0"
                           max="10000" class="validate" required
                           value="<?= $user["no_of_nebs"] ?>">
                    <label for="no_of_neb">Number of Nebulizers</label>
                </div>
            </div>
            <div class="col s12">
                <button type="submit" style="margin: 3px" class="btn waves-effect indigo right">Update Details</button>
            </div>
        </form>
    </div>

<?php
require_once "chunks/bottom.php";
