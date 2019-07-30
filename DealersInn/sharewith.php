<?php
	include("library/checklogin.php");
	include("library/opencon.php");
	include("library/functions.php");
	if(isset($_POST['btnSubmit']))
	{
		$PropertyID = $_REQUEST["PropertyID"];
		
		if($_REQUEST["cboShare"] == 1)
		{
			for($i=0;$i<sizeof($_REQUEST["chkFriend"]);$i++)
			{
				$Query = "INSERT INTO property_share(user_id, friend_id, property_id) 
					VALUES (".$_SESSION["UserID"].",".$_REQUEST["chkFriend"][$i].",".$PropertyID.")";
				mysqli_query($Conn, $Query);
				$Notification = "Share Property with you.<a href=\"property_detail.php?id=".$PropertyID."\">View Property</a>";
				MakeNotification($_REQUEST["chkFriend"][$i], $_SESSION["UserID"], $Notification);
			}
		}
		else if($_REQUEST["cboShare"] == 0)
		{
			$Query = "INSERT INTO property_share(user_id, friend_id, property_id) 
				VALUES (".$_SESSION["UserID"].",0,".$PropertyID.")";
			mysqli_query($Conn, $Query);
		}
		else
		{
			$Query = "INSERT INTO property_share(user_id, friend_id, property_id) 
				VALUES (".$_SESSION["UserID"].",".$_SESSION["UserID"].",".$PropertyID.")";
			mysqli_query($Conn, $Query);
		}
		header("Location: propertysubmitted.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Dealers Inn</title>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

<script src="lib/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/selectric/jquery.selectric.js"></script>
<script src="lib/tinymce/tinymce.min.js"></script>
<script src="lib/aos/aos.js"></script>
<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="lib/sticky-sidebar/ResizeSensor.min.js"></script>
<script src="lib/sticky-sidebar/theia-sticky-sidebar.min.js"></script>
<script src="lib/lib.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script
	<![endif]-->

<style type="text/css">


.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
   overflow-y: auto;
}

.overlay:target {
  visibility: visible;
  opacity: 1;

}



.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 80%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
	width: 70%;
  }
  .popup{
	width: 70%;
  }
}

/*2nd*/

.overlay3 {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}

.overlay3:target {
  visibility: visible;
  opacity: 1;
}




.popup3 {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 80%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup3 h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup3 .close3 {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup3 .close3:hover {
  color: #06D85F;
}
.popup3 .content3 {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box3{
	width: 70%;
  }
  .popup3{
	width: 70%;
  }
}
</style>
</head>
<body>
  <?php include("header.php")  ?>
  <div id="main">
  	<div class="clearfix"></div>
  	<div id="content">
  		<div class="container">
  			<div class="row justify-content-md-center">
  				<div class="col col-lg-12 col-xl-10">
  					<div class="row has-sidebar">
  						<div class="col-md-5 col-lg-4 col-xl-4 col-sidebar">
  							<div id="sidebar" class="sidebar-left">
  								<div class="sidebar_inner">
  									<div class="list-group no-border list-unstyled">
  										<span class="list-group-item heading">Manage Account</span>
  										<a href="#" class="list-group-item"><i class="fa fa-fw fa-pencil"></i> My Profile</a>
  										<a href="#" class="list-group-item"><i class="fa fa-fw fa-lock"></i> Change Password</a>
  										<a href="#" class="list-group-item"><i class="fa fa-fw fa-bell-o"></i> Notifications</a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="col-md-7 col-lg-8 col-xl-8">
  							<div class="page-header bordered">
  								<h1>Share Property With</h1>
  							</div>
  							<form method="POST">
  								<div class="form-group">
									<label for="cboShare">
										Share With
									</label>
									<select name="cboShare" id="cboShare" class="form-control form-control-lg" onchange="return showFriends(this.value);" required>
										<option value="" selected="">Choose Option</option>
										<option value="-1">Only Me</option>
										<option value="0">All Friends</option>
										<option value="1">Specific Friends</option>
									</select>
									<div id="FriendList" style="display: none">
									<hr>
									<b>Select Friends</b>
									<?php
										//SELECT user_id, fname, lname, email, password, phone, address, city, company, registration_date, lastedit, status, confirmcode FROM users WHERE 1
										$Query = "SELECT FL.friend_id, U.fname, U.lname
											FROM friends_list AS FL INNER JOIN users AS U ON FL.friend_id = U.user_id
											WHERE FL.user_id=".$_SESSION["UserID"]." AND FL.request_status=	1";
										$rstRow = mysqli_query($Conn, $Query);
										if(mysqli_num_rows($rstRow) > 0)
										{
											while ($objRow = mysqli_fetch_object($rstRow)) 
											{
									?>
										<div class="checkbox">
											<input id="chkFriend<?=$objRow->friend_id;?>"  name="chkFriend[]" type="checkbox" value="<?=$objRow->friend_id;?>">
											<label for="chkFriend<?=$objRow->friend_id;?>">
												<?=$objRow->fname." ".$objRow->lname;?>				
											</label>
										</div>
									<?php
											}
										}
									?>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<input type="hidden" name="PropertyID" value="<?=$_REQUEST["PropertyID"];?>">
									<button type="submit" name="btnSubmit" value="SEND" class="btn btn-lg btn-primary">Share Property</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvuspZieDAMlpAVAe2qwlvkk8oQU34dtg&libraries=places&callback=initAutocomplete" async defer></script> 
<script>
	tinymce.init({
		selector: '.text-editor',
		height: 200,
		menubar: false,
		branding: false,
		plugins: [
			'lists link image preview',
		],
		toolbar: 'undo redo | link | formatselect | bold italic underline  | alignleft aligncenter alignright alignjustify | bullist numlist'
	});

	function showSubType(PropertyType)
	{
		$("#SubType").load("loadsubtypeproperty.php?PropertyType="+PropertyType);
		$("#additionalFeatures").load("additionalfeatures.php?PropertyType="+PropertyType);
		//return false;
	}
	function loadCities(ProvinceID)
	{
		$("#Cities").load("loadcities.php?ProvinceID="+ProvinceID);
		return false;
	}
	function showFriends(Type)
	{
		if(Type == 1)
		{
			$("#FriendList").show(500);
		}
		else
		{
			$("#FriendList").hide(500);
		}
		return false;	
	}
</script>
</body>
</html>