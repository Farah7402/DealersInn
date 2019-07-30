<?php
	include("library/checklogin.php");
	include("library/opencon.php");
	include("library/functions.php");
	if(isset($_POST['btnAddFriend']))
	{
		$Query="INSERT INTO friends_list(user_id,friend_id,request_status)
			VALUES(".$_SESSION["UserID"].", ".$_REQUEST["FriendID"].", 2)";
		mysqli_query($Conn, $Query);
		header("Location: dealer_profile.php?ID=".$_REQUEST["FriendID"]);
		exit();
	}
	if(isset($_POST['btnRequestCancel']) || isset($_POST["btnUnfriend"]))
	{
		$Query = "DELETE FROM friends_list 
			WHERE user_id=".$_SESSION["UserID"]." AND friend_id=".$_REQUEST["FriendID"];
		mysqli_query($Conn, $Query);
		header("Location: dealer_profile.php?ID=".$_REQUEST["FriendID"]);
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
	<title>DelearsInn</title>

	<!-- Bootstrap -->
	<link href="css/font.css" rel="stylesheet">
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="lib/animate.css" rel="stylesheet">
	<link href="lib/selectric/selectric.css" rel="stylesheet">
	<link href="lib/swiper/css/swiper.min.css" rel="stylesheet">
	<link href="lib/aos/aos.css" rel="stylesheet">
	<link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/popper.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="lib/selectric/jquery.selectric.js"></script>
	<script src="lib/swiper/js/swiper.min.js"></script>
	<script src="lib/aos/aos.js"></script>
	<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
	<script src="lib/sticky-sidebar/ResizeSensor.min.js"></script>
	<script src="lib/sticky-sidebar/theia-sticky-sidebar.min.js"></script>
	<script src="lib/lib.js"></script>
</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
	<?php include("header.php") ?>
	<form method="POST">
	<div id="content">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col col-lg-12 col-xl-10">
					<div class="row has-sidebar">
						<div class="col-md-5 col-lg-4 col-xl-4 col-sidebar">
						<?php
							$Query = "SELECT U.fname, U.lname, U.email, U.phone, FL.request_status 
								FROM users AS U LEFT OUTER JOIN friends_list AS FL ON U.user_id = FL.friend_id AND FL.user_id=".$_SESSION["UserID"]."
								WHERE U.user_id = ".$_REQUEST["ID"];
							$rstRow = mysqli_query($Conn, $Query);
							if(mysqli_num_rows($rstRow) < 1)
							{
								header("Location: main.php");
								exit();
							}
							else
							{
								$objRow = mysqli_fetch_object($rstRow);
							}
						?>
							<div id="sidebar" class="sidebar-left">
								<div class="sidebar_inner">
									<div class="agent-details mb-5"> 
										<div class="text-center">
											<img class="img-fluid img-rounded agent-thumb" src="img/demo/profile.jpg" alt="">
										</div>
										<h3 class="subheadline"><?=$objRow->fname." ".$objRow->lname;?></h3>
										<ul class="list-unstyled">
							
										<?php
											if($objRow->request_status == 1)
											{
										?>
											<li>
												<a href="tel:<?=$objRow->phone;?>">
													<i class="fa fa-phone fa-fw" aria-hidden="true"></i> 
													Call: <?=$objRow->phone;?>
												</a>
											</li>
										<?php
											}
										?>
											<li>
												<a href="mailto:<?=$objRow->email;?>">
													<i class="fa fa-globe fa-fw" aria-hidden="true"></i> 
													<?=$objRow->email;?>
												</a>
											</li>
										</ul>
									<?php
										if($objRow->request_status == 1)
										{
									?>
										<button class="btn btn-lg btn-danger btn-block" name="btnUnfriend">UnFriend</button>
									<?php
										}
										else if($objRow->request_status == 2)
										{
									?>
										<small>Request Already Sent!</small>
										<button class="btn btn-lg btn-danger btn-block" name="btnRequestCancel">Cancel Request</button>
									<?php
										}
										else if($objRow->request_status == 0 && $objRow->request_status != NULL)
										{
									?>
										<small>You can't send request to this person!</small>
									<?php
										}
										else
										{
									?>
										<small>If you are friend you can share data!</small>
										<button class="btn btn-lg btn-primary btn-block" name="btnAddFriend">Add Friend</button>
									<?php
										}

									?>

										<input type="hidden" name="FriendID" value="<?=$_REQUEST["ID"];?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<?php include("footer.php") ?>
</body>
</html>