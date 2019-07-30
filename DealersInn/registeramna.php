<?php
	ob_start();
	session_start();
	include("library/opencon.php");
	include("library/functions.php");

	if(isset($_POST["btnSubmit"]))
	{
		$Query = "SELECT user_id, phone FROM users WHERE email = '".$_REQUEST["txtEmail"]."' OR phone = '".$_REQUEST["txtPhone"]."'";
		$rstRow = mysqli_query($Conn, $Query);
		if(mysqli_num_rows($rstRow) > 0)
		{
			$objRow = mysqli_fetch_object($rstRow);
			if($objRow->phone == $_REQUEST["txtPhone"])
			{
				$_SESSION["Try"] = "MissPhone";
			}
			else
			{
				$_SESSION["Try"] = "MissEmail";	
			}
		}
		else
		{
			 $confirmcode=rand();
			$UserID = GetMax("user_id","users");
			$Query = "INSERT INTO users(user_id, fname, lname, email, password, phone, address, city, company, registration_date, lastedit, status,confirmcode)

				VALUES (".$UserID.",'".TrimText($_REQUEST["txtFName"],1)."', '".TrimText($_REQUEST["txtLName"],1)."',
				'".$_REQUEST["txtEmail"]."','".$_REQUEST["txtPassword"]."','".$_REQUEST["txtPhone"]."', 
				'".$_REQUEST["txtAddress"]."','".$_REQUEST["cboCity"]."', '".$_REQUEST["txtCompany"]."',NOW(),NOW(),0,'$confirmcode')";
			$result=mysqli_query($Conn, $Query);
			if($result)
    {
    $objRow = mysqli_fetch_object($result);
      $Name = $objRow->fname." ".$objRow->lname;
    // $base_url = "http://localhost/youtubeVideo/verifyemail.php/";  //change this baseurl value as per your file path
      $mail_body = 
      "
     
            <html>
            <head>
              <title></title>
            </head>
            <body>
            Dear User, <br> Your account has been created.<br> Please wait until your account wiil be verified and activated
      <p>Your account will be verify less than 48 hrs.
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
      $mail->AddAddress($_POST['txtEmail'], $_POST['txtFName']);    //Adds a "To" address     
      $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);              //Sets message type to HTML       
      $mail->Subject = 'Email Verification';      //Sets the Subject of the message
      $mail->Body = $mail_body;             //An HTML or plain text message body
      if($mail->Send())               //Send an Email. Return true on success or false on error
      {
              echo "sent";  
      }
    }
    else
    {
      echo "Error <br/> " .$query. "<br/>" .$conn->error;
    }

			if($_REQUEST["txtCompany"]!="" || $_REQUEST["txtFNumber"]!="" || $_REQUEST["txtRNumber"]!="")
			{
				$Query = "INSERT INTO user_company_details(user_id, company_name, fax_number, registered, registeredin, registration_number) 
					VALUES (".$UserID.", '".$_REQUEST["txtCompany"]."', '".$_REQUEST["txtFNumber"]."', '".$_REQUEST["rdoRegisteredAs"]."', '".$_REQUEST["cboRegisteredBy"]."', '".$_REQUEST["txtRNumber"]."')";
				mysqli_query($Conn, $Query);
			}
			$_SESSION["Try"] = "Hit";
		}
		header("Location: registeramna.php");
		exit();
	}
?>
<!DOCTYPE>
<html>
<head>
	<title>Login/Registration</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width , initial-scale=1">

<link href="css/font.css" rel="stylesheet">
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate.css" rel="stylesheet">
<link href="lib/selectric/selectric.css" rel="stylesheet">
<link href="lib/aos/aos.css" rel="stylesheet">
<link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/reg_form.css" rel="stylesheet">


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


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery/min/js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.js"></script>
<script>
	function verify()
	{
		/*if(isNaN(document.Form.txtPhone.value))
		{
			alert("Please Enter Valid Phone Number! Phone Number Format 03xxxxxxxxx")
			document.Form.txtPhone.value = "";
			document.Form.txtPhone.focus();
			return false;
		}*/
		 if(document.Form.txtPassword.value != document.Form.txtCPassword.value)
		{
			alert("Password and Confirm Password must be same!")
			document.Form.txtPassword.value = "";
			document.Form.txtCPassword.value = "";
			document.Form.txtPassword.focus();
			return false;	
		}
	}
</script>


<body>
		
	 
		<div id="container">
		

	<form method="post" name="Form" action="registeramna.php" onsubmit="return verify();">
<div class="container">
	<div class="row">


	 <div class="subhead font_s ros subhead1" style="margin-top: 50px;"><h4 style="font-weight: bold; font-size: 25px;"><center>Register Your Account.</center></h4></div>
	<div class="col-md-12">
	<?php
			if(isset($_SESSION["Try"]))
			{
				if($_SESSION["Try"] == "Hit")
				{
		?>
			<div class="alert alert-success">
				<strong>Thank You</strong> <br>
				Please verify your email. If you dont find the email please check spam or junk mail folder.
			</div>
		<?php
				}
				else if($_SESSION["Try"] == "MissEmail")
				{
		?>
			<div class="alert alert-danger">
		
				<strong>Email already Exists!</strong> <br>
				Please use forgot password if you forgot the password or contact us if something went wrong.
			</div>
		<?php
				}
				else if($_SESSION["Try"] == "MissPhone")
				{
		?>
			<div class="alert alert-danger">
		
				<strong>Phone already Exists!</strong> <br>
				Please use valid phone number or contact us if something went wrong.
			</div>
		<?php
				}

				unset($_SESSION["Try"]);
			}
		?>
	</div>
</div>
	 <br> <br> <br>

	<div class="col-sm-6 col-md-6 col-lg-6" >

		<fieldset>
		<br> <br>
		 <div class="subhead font_s ros subhead1">Registration</div>
	 
	<!--div class="form-group">
		<label for="name">User Name</label>
		<input type="text" class="form-control" name="username" placeholder="Name">
	</div-->

		 <div class="form-group">
		<label for="name">First Name</label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="text" class="form-control" name="txtFName" pattern="^[a-zA-Z ]*$" placeholder="First Name" title="Alphabets only" required>
	</div>

	<div class="form-group">
		<label for="name">Last Name</label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="text" class="form-control" name="txtLName" pattern="^[a-zA-Z ]*$" placeholder="Last Name" title="Alphabets only" required>
	</div>

	<div class="form-group">
		<label for="email">Enter email</label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="email" class="form-control" name="txtEmail" placeholder="Enter email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,}$" title="abc@gmail.com">
	</div>

	<div class="form-group">
		<label for="pwd">Enter Password</label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="password" class="form-control" name="txtPassword"	placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required >
	</div>

	<div class="form-group">
		<label for="pwd">Confirm Password</label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="password" class="form-control" name="txtCPassword"	placeholder="Confirm Password" required>
	</div>
		</fieldset>


		<fieldset>

<br> <br>
 <div class="subhead font_s ros subhead1">Personal Details</div>

	<div class="form-group">
		<label for="mobile">Mobile</label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="text"  maxlength="15" class="form-control" name="txtPhone"	placeholder="+92-" pattern="^[\+]\d{2}-\d{3}-\d{7}$" title="Foramat +92-123-123456" required>
	</div>

	<div class="form-group">
		<label for="address">Address </label>
		<span style="color: red; font-size: 20px">*</span>
		<input type="text" class="form-control" name="txtAddress"	placeholder="Address ">
	</div>

	<div class="form-group">
		<label for="city">City </label>
		<span style="color: red; font-size: 20px">*</span>
		<select name="cboCity" class="form-control form-control-lg" required="" > 
			<option value="" selected="" >Select one. </option>
		<?php
			$Query = "SELECT city_id, city_name FROM cities WHERE status=1";
			$rstRow = mysqli_query($Conn, $Query);
			while ($objRow = mysqli_fetch_object($rstRow)) 
			{
		?>
			<option value="<?=$objRow->city_id;?>" style="color: black;"><?=$objRow->city_name;?></option>
		<?php
			}
		?>
		</select>
	</div>

	<div class="form-group">
		<label for="zipcode">Zipcode</label>
		<input type="text" class="form-control" name="txtZCode"	placeholder="Zipcode" maxlength="5" 
		pattern="[0-9]{5}" title="5-digit Postal Code">
	</div>

	</fieldset>

	 
	</div>


	<div class="col-sm-6 col-md-6 col-lg-6">

		<fieldset>
		
		<br> <br>

 <div class="subhead font_s ros subhead1">Business Details</div>

	<div class="form-group">
		<label for="company">Company Name</label>
		<input type="text" class="form-control" name="txtCompany"	placeholder="Company">
	</div>

	<div class="form-group">
		<label for="fax">Fax Number</label>
		<input type="number" class="form-control" name="txtFNumber"	placeholder="Fax number">
	</div>


	<div class="form-group">
		
		
 		<label for="company">Registered As</label> <br/>
		 <input type="radio" id="yesCheck" value="1" name="rdoRegisteredAs"
		onclick="javascript:yesnoCheck();"> <label for="Government Registered">Government Registered</label>

			&nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
 
		 <input type="radio" id="yesCheck" value="2" name="rdoRegisteredAs" checked 
		 onclick="javascript:yesnoCheck();"> <label for="N_Government Registered">Not Government Registered
		 </label>

			 <div id="ifYes" style="visibility:hidden ; color: black; font-size: 20px;">
				
				<select name="cboRegisteredBy" class="form-control form-control-lg" > 
				<option value="0" selected="">Select one.... </option>
				<option value="1" style="color: black;">Government</option>
				<option value="2" style="color: black;">Fedral</option>
				<option value="3" style="color: black;">Local</option>
				<option value="4" style="color: black;">Province</option>
				</select>
			<br>
				<input type='number' id='registrationnumber' class="form-control" name='txtRNumber' placeholder="Enter Registered Number"/></div>

			<script >
					function yesnoCheck() {
				if (document.getElementById('yesCheck').checked) {
					document.getElementById('ifYes').style.visibility = 'visible';
				}
				else document.getElementById('ifYes').style.visibility = 'hidden';

}
			</script>

	</div>

		</fieldset>
	</div>
</form>

		<!--div class="subhead font_s ros subhead1">Deals with</div> 

	<div class="sale">
	 <input type="checkbox" id="saleyesCheck" value="1" name="rdoProperryFor" onclick="javascript:Checksale();"> <label for="sale">Sale</label>
 </div>
	
<div class="sale">
	 <input type="checkbox" id="rentyesCheck" value="2" name="rdoProperryFor" onclick="javascript:Checkrent();"> <label for="rent">Rent</label>
</div>


	 
<div id="saleYes" style="visibility:hidden">

<div class="saleyes">
	
	 <input type="checkbox" id="yes" name="sale[]" value="house"> <label for="house">House</label>
 
	 <input type="checkbox" id="yes" name="sale[]" value="plot"> <label for="house">Plots</label>

	 <input type="checkbox" id="yes" name="sale[]" value="flat"> <label for="house">Flats</label>
	
	 <input type="checkbox" id="yes" name="sale[]" value="apartment"> <label for="house">Apartments</label></div>
		 
 </div> 

 <div	id="rentYes" style="visibility:hidden;">

	<div class="saleyes">
	 <input type="checkbox" id="yes"	name="rent[]" value="house"> <label for="house">House</label>
 
	 <input type="checkbox" id="yes"	name="rent[]" value="plot"> <label for="house">Plots</label>

	 <input type="checkbox" id="yes"	name="rent[]" value="flat"> <label for="house">Flats</label>
	
	 <input type="checkbox" id="yes"	name="rent[]" value="apartment"> <label for="house">Apartments</label> </div>
		 
 </div> 



 <!--------------------------------------------------------------------------------------------------------------->
<script >


function Checksale() {
	if (document.getElementById('saleyesCheck').checked) {
		document.getElementById('saleYes').style.visibility = 'visible';
	}
	else document.getElementById('saleYes').style.visibility = 'hidden';}


	 function Checkrent() {
	if (document.getElementById('rentyesCheck').checked) {
		document.getElementById('rentYes').style.visibility = 'visible';
		 }
	 
	 else 
		document.getElementById('rentYes').style.visibility = 'hidden';}

		
</script>
</fieldset>
<br> <br>
<br><br>
<br><br>


<div class="form-group" style=" margin-right:100px; " align="center">
									<button type="submit" name="btnSubmit" value="SEND" class="btn btn-primary btn-lg"   style="background-color: #ffce40; border-color: #ffce40; color: #563d7c; " >Register</button>
							

		<br/><br/>
	<a href="signin.php" style="color: #563d7c; font-size: 18px;">Already have a account?Login here</a><br/>
</div>
</div>
</body>
</html>
