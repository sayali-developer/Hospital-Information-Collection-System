<?php 
session_start(); 
require_once "include.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    
    <title>HICS SYSTEM</title>

    <!-- Meta Tags -->
    
    <meta charset="utf-8">
    <meta name="description" content="Hospital Information Collection System">
    <meta name="theme-color" content="#FF0000" />

      <!-- Opengraph Meta Tags -->
      <meta property="og:type" content="website"/>
      <meta property="og:title" content="HICS SYSTEM"/>
      <meta property="og:description" content="Hospital Information Collection System"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css"
            media="screen,projection"/>

      <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/theme.css">

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
              <li class="padding-horizontal"><img src="./assets/logo/hics.png" alt="hics" width="200px"></li>
              <br/>
              <li><a class="font-nav-bar" href="./">Homepage</a></li>
              <li><a class="font-nav-bar" href="./admin">Admin Login</a></li>
              <li><a class="font-nav-bar" href="./register.php">Hospital's Registration</a></li>
              <li><a class="font-nav-bar" href="./hospital">Hospital's Login</a></li>
              <?php if(isset($_SESSION["user_type"])): ?>
            <li><a class="font-nav-bar" href="./logout">Logout</a></li>
          <?php endif; ?>
        </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="container center">
		<div class="row center">
            <h4 class="header col s12 light">Available Resources Report</h4>
            <hr/>
            <div class="col s12 light">
                <h6>Hospital Vise Report of Available Resources.</h6>
            </div>
			<div class="col s12 light">
			<?php
				try {
					$i=0;
					
					$db = new db;
					$con = $db->con();
					
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
				catch (PDOException $e) {
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
			endif; ?>

			</div>
		</div>
  
  </div>
  
  
  <div class="section no-pad-bot" id="index-banner">
    <div class="container center">
        <br><br>
        <img src="./assets/logo/hics.png" class="responsive-img" alt="HICS Logo">
        <div class="row center">
            <h4 class="header col s12 light">Hospital Information Collection System</h4>
            <hr/>
            <div class="col s12 light">
                <h6>A system for information on all hospitals in Pune district and their daily reports.</h6>
            </div>
            <div class="col s12">
                <br/>
            </div>
            <div class="col s12 l4 m12 center">
                <h5 class="center"><a href="./hospital">Hospital's Login</a></h5>
            </div>
            <div class="col s12 l4 m12 center">
                <h5 class="center"><a href="./register.php">Hospital's Registration</a></h5>
            </div>
            <div class="col s12 l4 m12 center">
                <h5 class="center"><a href="./admin">Admin Login</a></h5>
            </div>
             
        </div>
		<br><br>

    </div>
  </div>



  <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>

    <script type="text/javascript" src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

  </body>
</html>
