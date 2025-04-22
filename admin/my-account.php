<?php
$title = "Admin Dashboard : My Account";
require_once "chunks/top.php";

?>
    <form class="z-depth-1" onsubmit="return checkPass()" action="backend/change-password.php" method="post"
          style="margin: 10px; padding: 15px;">
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