<?php
	
	require_once '../include.php';

	$dep = new department();

	if($dep->loggedIn()) {
		header("Location: ./dashboard.php");
		exit;
	}

	if(isset($_POST["username"]) && isset($_POST["password"])) {
	    $username = trim(strtolower($_POST["username"]));
	    $pass = hash_password($_POST["password"]);
	    if(strlen($username) > 3 && strlen($username) < 20) {
	        if($dep->login(htmlentities($username), $pass)) {
	            header("Location: ./dashboard.php");
	            exit;
            }
        }
        pageInfo("red", "Invalid Username or Password, try again!");
    }

?>

  <!DOCTYPE html>
  <html>
    <head>
      
      <title>Admin Login</title>

      <!-- Meta Tags -->
      
      <meta charset="utf-8">
      <meta name="description" content="Administrator Login">
      <meta name="theme-color" content="#FF0000" />
      <!-- Opengraph Meta Tags -->
      <meta property="og:type" content="website"/>
      <meta property="og:title" content="Admin Login"/>
      <meta property="og:description" content="Administrator Login"/>
      
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../assets/materialize/css/materialize.min.css"  media="screen,projection"/>

      <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.min.css" rel="stylesheet">
      
      <link rel="stylesheet" href="../assets/css/theme.css">

    </head>

    <body class="grey">
        <main class="center">

            <div class="section"></div>
            <div class="section"></div>

            <div class="container ">
                <div class="z-depth-1 white row" style="max-width: 400px; inline-block; padding: 10px 28px 0px 28px; border: 1px solid #EEE;">

                    <form class="col s12" action="" method="post">
                        <div class="row">
                            <div class="col s12">
                                <h4 class="center lobster-cursive red-text"><u>Admin Login</u></h4>
                            </div>
                            <div class="col s12">
                                <div class='input-field'>
                                    <input class='validate' title="Please Enter Valid Username" type='text' minlength="3" maxlength="20" name='username' id='username' required/>
                                    <label for='username'>Enter your Username</label>
                                </div>

                                <div class='input-field'>
                                    <input class='validate' title="Please Enter Valid Password" type='password' minlength="8" name='password' id='password' required/>
                                    <label for='password'>Enter your Password</label>
                                </div>
                            </div>
                        </div>

                        <?php if(isset($_SESSION["PAGE_INFO_EXISTS"])): ?>
                        <div class="row center">
                            <h6 class="<?= $_SESSION["TYPE"] ?>-text lighten-2"><?= $_SESSION["PAGE_INFO"] ?></h6>
                        </div>
                        <?php clearPageInfo(); endif; ?>
                        <div class='row center'>
                            <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section"></div>
        </main>
        

        <!--JavaScript at end of body for optimized loading-->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../assets/materialize/js/materialize.min.js"></script>

      <script type="text/javascript" src="../assets/js/theme.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

    </body>
  </html>