<?php
	session_start();
	include("library/opencon.php");
	include("library/functions.php");
	if(isset($_REQUEST["btnLogin"]))
	{
		$Query = "SELECT user_id, fname, lname, status FROM users WHERE email='".$_REQUEST["txtEmail"]."' AND password='".$_REQUEST["txtPassword"]."'";
		$rstRow = mysqli_query($Conn, $Query);
		if(mysqli_num_rows($rstRow) > 0)
		{
			$objRow = mysqli_fetch_object($rstRow);
			if($objRow->status == 1)
			{
				$_SESSION["UserID"] = $objRow->user_id;
				$_SESSION["UserName"] = $objRow->fname." ".$objRow->lname;
				header("Location: main.php");
				exit();
			}
			else if($objRow->status == 0)
			{
				$_SESSION["Try"] = "Pending";
				header("Location: signin.php");
				exit();
			}
			else
			{
				$_SESSION["Try"] = "Blocked";
				header("Location: signin.php");
				exit();
			}
		}
		else
		{
			$_SESSION["Try"] = "Miss";
			header("Location: signin.php");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 eta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Dealer's INN</title>

<!-- Bootstrap -->
<link href="css/font.css" rel="stylesheet">
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate.css" rel="stylesheet">
<link href="lib/selectric/selectric.css" rel="stylesheet">
<link href="lib/aos/aos.css" rel="stylesheet">
<link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/selectric/jquery.selectric.js"></script>
<script src="lib/aos/aos.js"></script>
<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="lib/sticky-sidebar/ResizeSensor.min.js"></script>
<script src="lib/sticky-sidebar/theia-sticky-sidebar.min.js"></script>
<script src="lib/lib.js"></script>

</head>
<body>
<div id="main">

        <div class="page-header">
          <br><br>
          
          <h2 ><b><center>Dealer's INN</center></b></2>
          <hr>
          <br>
        <h1><center>Please sign in or register</center></h1>
        </div>
      </div>
    </div>
  </div>
<div id="content">
  <div class="container">
    <div class="row justify-content-md-center align-items-center">
    <?php
    	if(isset($_SESSION["Try"]))
    	{
    ?>
    	<div class="col-md-12">
    	<?php
    		if($_SESSION["Try"] == "Pending")
    		{
    	?>
    		<div class="alert alert-info">
    			<strong>Registration Pending!</strong>
    		</div>
    	<?php
    		}
    		else if($_SESSION["Try"] == "Blocked")
    		{
    	?>
    		<div class="alert alert-danger">
    			<strong>ID Bloacked!</strong>
    		</div>
    	<?php
    		}

        else if($_SESSION["Try"] == "Reset")
        {
      ?>
        <div class="alert alert-info">
          <strong>Password Reset!</strong>
        </div>
      <?php
        }
    		else
    		{
    	?>
    		<div class="alert alert-danger">
    			<strong>Invalid Email / Password!</strong>
    		</div>
    	<?php
    		}
    	?>
    	</div>
    <?php
    		unset($_SESSION["Try"]);
    	}
    ?>
      <div class="col col-md-6  col-lg-5 col-xl-4">
        <ul class="nav nav-tabs tab-lg" role="tablist">
          <li role="presentation" class="nav-item"><a class="nav-link active" href="signin.html">Sign In</a></li>
          <li role="presentation" class="nav-item"><a class="nav-link" href="registeramna.php">Register</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="login">
            <form method="post" action="signin.php" name="Form">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="txtEmail" class="form-control form-control-lg" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="txtPassword" class="form-control form-control-lg" placeholder="Password" required>
              </div>
              <p class="text-lg-right"><a href="forgot_pass.php">Forgot Password</a></p>
              <!--div class="checkbox">
                <input type="checkbox" id="remember_me">
                <label for="remember_me">Remember Me</label>
              </div-->
              <button type="submit" class="btn btn-primary btn-lg" name="btnLogin" id="login">Sign In</button>
            </form>
          </div>
        </div>
        <div> </div>
      </div>
      
      <!--div class="col-md-6 col-lg-5 col-xl-4">
        <div class="socal-login-buttons"> <a href="#" class="btn btn-social btn-block btn-facebook"><i class="icon fa fa-facebook"></i> Continue with Facebook</a> <a href="#" class="btn btn-social btn-block btn-twitter"><i class="icon fa fa-twitter"></i> Continue with Twitter</a> <a href="#" class="btn btn-social btn-block btn-google"><i class="icon fa fa-google"></i> Continue with Google</a> </div>
      </div-->
    </div>
  </div>
</div>
<button class="btn btn-primary btn-circle" id="to-top"><i class="fa fa-angle-up"></i></button>

</div>
</body></html>

