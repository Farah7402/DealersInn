<?php
clearstatcache();
  include("library/checklogin.php");
  include("library/opencon.php");
  include("library/functions.php");
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Dealer's INN</title>

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
<script>
	</script>
</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
<?php include("header.php") ?>
	<div class="container">
		<div class="page-header bordered">
                  <h1>Notifications</h1>
                </div>
		<div class="row">
			<div class="col-md-12 table-responsive">
				<table class="table table-bordered table-stripped table-hover">
					<tr>
						<th width="30%">Notification By</th>
						<th width="20%">Notification Date</th>
						<th width="50%">Notification</th>
					</tr>
				<?php
					$Query = "SELECT N.notification_id, U.fname, U.lname, N.notification, N.notification_time, N.status 
						FROM notifications AS N INNER JOIN users AS U ON N.notice_by = U.user_id
						WHERE N.notice_for=".$_SESSION["UserID"]." ORDER BY N.status, N.notification_time";
					$rstRow = mysqli_query($Conn, $Query);
					if(mysqli_num_rows($rstRow)>0)
					{
						while ($objRow = mysqli_fetch_object($rstRow)) 
						{
				?>
					<tr>
						<td><?=$objRow->fname." ".$objRow->lname;?></td>
						<td><?=date_format(date_create($objRow->notification_time), "F d, Y h:i A");?></td>
						<td><?=$objRow->notification;?></td>
						
					</tr>
				<?php
						}
					}
				?>
				</table>
			</div>
		</div>
	</div>
<?php include("footer.php") ?>

</body>
</html>

