<?php
	session_start();
	if(isset($_SESSION["UserID"]) && isset($_SESSION["UserName"]))
	{
		header("Location: main.php");
		exit();
	}
	include("library/opencon.php");
	include("library/functions.php");
	$Reset = FALSE;
	if(isset($_POST["btnReset"]))
	{
		$Query = "SELECT user_id, fname, lname FROM users WHERE email='".$_REQUEST["txtEmail"]."'";	
		$rstRow = mysqli_query($Conn, $Query);
		if(mysqli_num_rows($rstRow) > 0)
		{
			$objRow = mysqli_fetch_object($rstRow);
			$Name = $objRow->fname." ".$objRow->lname;
			$VerifyLink = "http://localhost/DealersInn/forgot_pass.php?I=".$objRow->user_id."&F=".md5(TrimText($Name,0))."_".$objRow->user_id."_".md5($objRow->user_id);
	        //$MailHead = "<IMG SRC=\"../assets/images/logo-site.png\" style='width:100px;'>";//
			$ClickHere = "<IMG SRC=\"../DealersInn/img/badge.png\" width='125px'>";
			$ClickHere1 = "<a href='".$VerifyLink."'><h4>Click here to change your password.</h4></a>";
			$FontBold = "<FONT STYLE='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #000000;'>";
	        $FontNormal = "<FONT STYLE='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;word-wrap: break-word;'>";
	        $btn = "style=\"width: 150px; font-weight: bold; background-color: red; color: #000\"";
	
      $mail_body = 
      "
     
            <html>
            <head>
              <title></title>
            </head>
            <body>
            Dear $Name <br> Your change password request has been accepted. <br> 
      <p>Please Open this link to change your password -  .$ClickHere1. 
      <p>Best Regards,<br/>DealersInn</p>
            </body>
            </html>
      ";


      require 'class/class.phpmailer.php';
      $mail = new PHPMailer;
            
      $mail->IsSMTP();
      $mail->Host = "smtp.gmail.com";

      $mail->SMTPAuth = true;
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;
      $mail->Username = "farah011997@gmail.com";
      $mail->Password = "bwA7GdqSHQefg53";

      $mail->From = "farah011997@gmail.com";     //Sets the From email address for the message
      $mail->FromName = 'DealersInn';         //Sets the From name of the message
      $mail->AddAddress($_POST['txtEmail']);    //Adds a "To" address     
      $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);              //Sets message type to HTML       
      $mail->Subject = 'Email Verification';      //Sets the Subject of the message
      $mail->Body = $mail_body;             //An HTML or plain text message body
      if($mail->Send())               //Send an Email. Return true on success or false on error
      {
           echo $_SESSION["Try"] = "  <BR>
	        <TABLE WIDTH='350px' BORDER='1' ALIGN='CENTER' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#666666'>
	            <TR>
	                <TD>
	                <TABLE WIDTH='100%' BORDER='0' CELLSPACING='4' CELLPADDING='2'>
	                    <TR ALIGN='CENTER'>
	                   
	                    </TR>
	                    <TR>
	                        <TD COLSPAN=\"4\" ALIGN='CENTER'>".$FontBold."<span style=\"font-size:18px;\">DealersInn</span></FONT></TD>
	                    </TR>;
	       
	                    <TR><TD COLSPAN=\"4\" HEIGHT=\"10\"><hr/></TD></TR>
	                    <TR>
	                        <TD COLSPAN=\"4\" ALIGN='CENTER'>".$FontBold."<span style=\"font-size:16px;\">Hello and Thank You...</span></FONT></TD>
	                    </TR>
	                    <TR VALIGN=\"TOP\" height=\"30\">
	                        <TD COLSPAN='4' ALIGN='LEFT'>
	                           ".$FontNormal."<p style=\"text-align: justify\">You are just one step away from reseting your password.</p></FONT>
	                        </TD>
	                    </TR>
	                    
	       
	                    <TR VALIGN=\"TOP\" height=\"30\">
	                        <TD COLSPAN='4' ALIGN='LEFT'>
	                           ".$FontNormal."<p style=\"text-align: justify\">Please check your email you have provided where change password link is given.</p><p style=\"text-align: justify\">Click that link to rest your password. </p></FONT>
	                        </TD>
	                    </TR>
	                    <TR>
	                        <TD COLSPAN='4' ALIGN='center'>
	                           ".$ClickHere."
	                        </TD>
	                    </TR>
	        
	                </TABLE>
	                </TD>
	            </TR>
	        </TABLE><BR>";
	       // echo $mail_body;
	        die();

      }
    }
   
	    
	    else
	    {
	    	$_SESSION["Try"] = "No";

	    	header("Location: forgot_pass.php");
	    	exit();
	    }
	}

	if(isset($_POST["btnResetPassword"]))
	{
		$Query = "UPDATE users SET password='".$_REQUEST["txtPassword"]."', lastedit=NOW() WHERE user_id=".$_REQUEST["UserID"];
		mysqli_query($Conn, $Query);
		$_SESSION["Try"] = "Reset";

		header("Location: signin.php");
		exit();
	}

	if(isset($_REQUEST["I"]) && isset($_REQUEST["F"]))
	{
		$Query = "SELECT fname, lname FROM users WHERE user_id=".$_REQUEST["I"];	
		$rstRow = mysqli_query($Conn, $Query);
		if(mysqli_num_rows($rstRow) > 0)
		{
			$objRow = mysqli_fetch_object($rstRow);
			$Name = $objRow->fname." ".$objRow->lname;
			$V = md5(TrimText($Name,0))."_".$_REQUEST["I"]."_".md5($_REQUEST["I"]);
			if($V == $_REQUEST["F"])
			{
				$Reset = TRUE;
			}
		}
		else
		{
			header("Location: index.php");
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
<title>DealersInn</title>

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
<script>
	function verify()
	{
		if(document.Form.txtPassword.value != document.Form.txtCPassword.value)
		{
			alert("Password and Confirm Password must be same!")
			document.Form.txtPassword.value = "";
			document.Form.txtCPassword.value = "";
			document.Form.txtPassword.focus();
			return false;	
		}
		else
		{
			document.Form.submit();
		}
	}
</script>
</head>
<body>
	<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-8  col-lg-6">
        <!--nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
            </ol>
            </nav-->
	<div class="page-header">
        <h1>Forgot Password</h1>
        </div>
      </div>
    </div>
  </div>
<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col col-md-8  col-lg-6">
      <p>Please enter the email address you registered with website below and we'll email you a link to a page where you can easily create a new password.</p>
      <?php
			if(isset($_SESSION["Try"]) && $_SESSION["Try"] == "Sent")
			{
		?>
			<div class="alert alert-success">
				<strong>Email sent to reset password!</strong> <br>
				Please follow the instructions given in email.
			</div>
		<?php
				unset($_SESSION["Try"]);
			}
			else if(isset($_SESSION["Try"]) && $_SESSION["Try"] == "No")
			{
		?>
			<div class="alert alert-danger">
				<strong>No Record Found!</strong> <br>
				Please register your account to use our services or contact us if you face any problem.
			</div>
		<?php
			}
			if($Reset)
			{
		?>
            <!--form>
            <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" class="form-control input-lg" placeholder="Email Address">
          </div>
              <button type="submit" class="btn btn-primary btn-lg">Continue</button>
            </form-->
            <form name="Form" method="POST" onsubmit="return verify();">
				<div class="form-group">
					<div class="form-label-group">
						<input type="Password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Password" minlength="8" maxlength="50" required autofocus>
						<label for="txtPassword">Password</label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="Password" id="txtCPassword" name="txtCPassword" class="form-control" placeholder="Confirm Password" minlength="8" maxlength="50" required>
						<label for="txtCPassword">Confirm Password</label>
					</div>
				</div>
				<button type="SUBMIT" name="btnResetPassword" class="btn btn-primary btn-block">Reset</button>
				<input type="hidden" name="UserID" value="<?=$_REQUEST["I"];?>">
		<?php
			}
			else
			{
		?>
			<form name="Form" method="POST">
				<div class="form-group">
					<div class="form-label-group">
						<input type="email" id="txtEmail" name="txtEmail" class="form-control" placeholder="Email address" required autofocus>
						<label for="txtEmail">Email address</label>
					</div>
				</div>
				<button type="SUBMIT" name="btnReset" class="btn btn-primary btn-block">Submit</button>
			<?php
				}
			?>
			</form>
        
        
        <div> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>