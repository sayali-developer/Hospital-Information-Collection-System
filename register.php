<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Hospital Registration</title>

    <!-- Meta Tags -->

    <meta charset="utf-8">

    <meta name="theme-color" content="#FF0000"/>
    <!-- Opengraph Meta Tags -->
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="HICS SYSTEM"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection"/>

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/theme.css">
    <style>
        label {
            color: black !important;
        }
    </style>
</head>

<body>

<nav class="red lighten-1" role="navigation">
    <div class="nav-wrapper padding-horizontal"><a id="logo-container" href="./" class="brand-logo">HICS <span
                    class="hide-on-small-and-down">SYSTEM</span></a>
        <?php if(isset($_SESSION["user_type"])): ?>
        <ul class="right hide-on-med-and-down">
            <li><a class="font-nav-bar" href="./logout">Logout</a></li>
        </ul>
        <?php endif; ?>
        <ul class="right hide-on-med-and-down">
            <li><a class="font-nav-bar" href="./admin">Admin Login</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a class="font-nav-bar" href="./hospital">Hospital's Login</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a class="font-nav-bar" href="./register.php">Hospital's Registration</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a class="font-nav-bar" href="./">Homepage</a></li>
        </ul>

        <ul id="nav-mobile" class="sidenav">
            <li class="padding-horizontal padding-vertical"><img src="./assets/logo/hics.png" width="200px"></li>
            <li><a class="font-nav-bar" href="./">Homepage</a></li>
            <li><a class="font-nav-bar" href="./admin">Admin Login</a></li>
            <li><a class="font-nav-bar" href="./hospital">Hospital's Login</a></li>
            <li><a class="font-nav-bar" href="./register.php">Hospital's Registration</a></li>
            <?php if(isset($_SESSION["user_type"])): ?>
            <li><a class="font-nav-bar" href="./logout">Logout</a></li>
        <?php endif; ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="container center z-depth-4" style="border: 1px solid #000; margin-bottom: 20px; margin-top: 20px">
    <h5 class="center lobster-cursive">Hospital Registration</h5>
    <hr/>
    <form action="javascript:void(0)" id="doctor_reg_form" onsubmit="registerFormSubmit()" onreset="registerFormReset()"
          class="row padding-horizontal">

        <div class="col s12 m6">
            <div class="input-field">
                <select name="cat_of_hosp" id="cat_of_hosp" class="validate">
                    <option value="">Select Type</option>
                    <option value="private">Private Hospital</option>
                    <option value="government">Government Hospital</option>
                </select>
                <label for="cat_of_hosp">Category of Hospital</label>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="input-field">
                <select name="type_of_hosp" onchange="hospChanged(this.value)" id="type_of_hosp" class="validate">
                    <option value="">Select Type</option>
                    <option value="allopathy">Allopathy</option>
                    <option value="ayurvedic">Ayurvedic</option>
                    <option value="homoeopathy">Homoeopathy</option>
                    <option value="unani">Unani</option>
                    <option value="other">Other</option>
                </select>
                <label for="type_of_hosp">Type of Hospital</label>
            </div>
            <div class="input-field" id="spec_other_type">
                <input type="text" minlength="3" placeholder="Specify Hospital Type" maxlength="64" name="other_type"
                       id="other_type" class="validate">
                <label for="other_type">Specify Hospital Type</label>
            </div>
        </div>
        <div class="col s12">
            <div class="input-field">
                <input type="text" minlength="5" maxlength="256"
                       name="hosp_name" id="hosp_name" required class="validate" placeholder="Hospital Name">
                <label for="hosp_name">Name of Hospital</label>
            </div>
        </div>
        <div class="col s12">
            <div class="input-field">
                <input type="text" name="doctor_name" minlength="5" maxlength="256"
                       placeholder="Name of Doctor (Don't Include Dr.)" id="doctor_name" required class="validate">
                <label for="doctor_name">Name of Doctor (Don't Include Dr.)</label>

            </div>
        </div>
        <div class="col s12 m6">
            <div class="input-field">
                <input type="number" name="mobile" placeholder="Doctors Mobile" id="mobile" min="100000000"
                       max="9999999999" class="validate" required>
                <label for="mobile">Mobile Number</label>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="input-field">
                <select name="subdist" id="subdist" class="validate">
                    <option value="">Select Taluka</option>
			
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
        </div>
        <div class="col s12">
            <div class="input-field">
                <textarea minlength="5" maxlength="512" style="height: 70px" name="address" id="address" required
                          class="validate materialize-textarea" placeholder="Detailed Address of Hospital"></textarea>
                <label for="address">Hospital Address</label>
            </div>
        </div>
        <div class="col s12">
            <p style="text-align: left"><strong>Hospital Details -</strong></p>
        </div>
        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_beds" placeholder="Number of Beds" id="no_of_beds" min="0" max="100000"
                       class="validate" required>
                <label for="no_of_beds">Number of Beds</label>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_wards" placeholder="Number of Wards" id="no_of_wards" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_wards">Number of Wards</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_docs" placeholder="Number of Doctors" id="no_of_docs" min="1"
                       max="10000" class="validate" required>
                <label for="no_of_docs">Number of Doctors</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_nurses" placeholder="Number of Nurses" id="no_of_nurses" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_nurses">Number of Nurses</label>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_other_staff" placeholder="Number of Other Staff" id="no_of_other_staff"
                       min="0" max="10000" class="validate" required>
                <label for="no_of_other_staff">Number of Other Staff</label>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_amb" placeholder="Number of Ambulances" id="no_of_amb" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_amb">Number of Ambulances</label>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_ppe" placeholder="Number of PPE Kits" id="no_of_ppe" min="0"
                       max="1000000" class="validate" required>
                <label for="no_of_ppe">Number of PPE Kits</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_vent" placeholder="Number of Ventilators" id="no_of_vent" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_vent">Number of Ventilators</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_o2_cel" placeholder="Number of O2 Cylinders" id="no_of_o2_cel" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_o2_cel">Number of O2 Cylinders</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_o2_conc" placeholder="Number of O2 Concentrators" id="no_of_o2_conc"
                       min="0" max="10000" class="validate" required>
                <label for="no_of_o2_conc">Number of O2 Concentrators</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_monitors" placeholder="Number of Monitors" id="no_of_monitors" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_monitors">Number of Monitors</label>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="input-field">
                <input type="number" name="no_of_neb" placeholder="Number of Nebulizers" id="no_of_neb" min="0"
                       max="10000" class="validate" required>
                <label for="no_of_neb">Number of Nebulizers</label>
            </div>
        </div>
        <div class="col s12">
            <button type="submit" style="margin: 3px" class="btn waves-effect indigo right">Register</button>
            <button type="reset" style="margin: 3px" class="btn waves-effect red right">Reset Form</button>

        </div>
    </form>
</div>


<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>

<script type="text/javascript" src="assets/js/theme.js"></script>
<script src="assets/js/doctor-register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

</body>
</html>
