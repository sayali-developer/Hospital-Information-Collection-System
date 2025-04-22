<?php
$title = "Hospital's Dashboard : My Account";
require_once "chunks/top.php";
$hosp = $user;
?>
    <div class="row" style="margin-top: 10px; padding: 3px">


        <div class="col s12 z-depth-2" style="margin-top: 10px; padding: 3px">
            <div class="container">
                <h5 class="teal-text">Account Details</h5>
                <div class="row">

                    <div class="col s12">
                        <p style="font-size: 16px;" title="<?= $hosp["hospital_name"] ?>" class="truncate"><strong>Hospital
                                Name : </strong><?= $hosp["hospital_name"] ?></p>
                    </div>
                    <div class="col s12">
                        <p style="font-size: 16px;" title="<?= $hosp["hospital_type"] ?>" class="truncate"><strong>Type
                                : </strong><?= $hosp["hospital_type"] ?></p>
                    </div>

                    <div class="col s12">
                        <p style="font-size: 16px;" title="<?= $hosp["name_of_doctor"] ?>" class="truncate"><strong>Doctor's
                                Name : </strong>Dr. <?= $hosp["name_of_doctor"] ?></p>
                    </div>
                    <div class="col s12">
                        <p style="font-size: 16px;" title="<?= $hosp["mobile_number"] ?>" class="truncate"><strong>Mobile
                                Number : </strong><?= $hosp["mobile_number"] ?></p>
                    </div>

                    <div class="col s12">
                        <p style="font-size: 16px;" title="<?= $hosp["subdist"] ?>" class="truncate"><strong>Taluka
                                : </strong><?= $hosp["subdist"] ?></p>
                    </div>
                    <div class="col s12">
                        <p style="font-size: 16px;" title="<?= $hosp["address"] ?>" class="truncate"><strong>Address
                                : </strong><?= $hosp["address"] ?></p>
                    </div>


                </div>
            </div>
        </div>

        <form class="col s12 z-depth-2" style="margin-top: 15px; margin-bottom: 15px" onsubmit="return checkPass()"
              action="backend/change-password.php" method="post"
        >
            <h5>Change Password</h5>
            <p class="red-text" id="pass_error"></p>
            <div style="margin-top: 30px" class="input-field">
                <input type="password" class="validate" required minlength="8" name="password_old"
                       placeholder="Enter Old Password" id="password_old">
                <label for="password_old">Old Password</label>
            </div>

            <div class="input-field">
                <input type="password" class="validate" required minlength="8" name="password"
                       placeholder="Enter New Password" id="password">
                <label for="password">New Password</label>
            </div>

            <div class="input-field">
                <input type="password" class="validate" required minlength="8" name="password_con"
                       placeholder="Confirm New Password" id="password_con">
                <label for="password_con">Confirm New Password</label>
            </div>
            <div>
                <button type="submit" class="btn waves-effect indigo right">Change Password</button>

            </div>
            <br/>
            <br/>
        </form>
    </div>
    <script>
        function checkPass() {
            if (document.getElementById("password").value == document.getElementById("password_old").value) {
                document.getElementById("pass_error").innerHTML = "New Password and Old Password Can't Be Same!";
                return false;
            }
            if (document.getElementById("password").value != document.getElementById("password_con").value) {
                document.getElementById("pass_error").innerHTML = "New Password and Confirmed Password Should Be Same!";
                return false;
            }

            document.getElementById("pass_error").innerHTML = "";
            return true;
        }
    </script>
<?php
require_once "chunks/bottom.php";

?>