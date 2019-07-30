<?php
clearstatcache();



	include("library/opencon.php");
	include("library/functions.php");
	include("library/checklogin.php");

	$error = '';

	if(isset($_POST["btnSubmit"]))
	{
	
				$Query = "INSERT INTO postadd( post_by, post_text, post_time) 
					VALUES ( ".$_SESSION["UserID"].", '".$_POST['posttext']."', NOW())";
				mysqli_query($Conn, $Query);

		 $error = '<label class="text-success">You post is loaded successfully and your friends can see your request.</label>';
			}
		
		
		//header("Location: main.php");
		//exit();
	
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
                  <h1>Post Ad</h1>
                </div>
		<div class="row">
			<div class="col-md-12 table-responsive">
				<form action="" method="post">
					<span><?php echo $error; ?></span>
				<table class="table table-bordered table-stripped table-hover">
					<tr>
						<th width="30%">
					    <textarea class="form-control form-control-lg text-editor" placeholder="" name="posttext" required=""></textarea>
						</th>
					</tr>
		
				</table>
					<div class="form-group">
									<button type="submit" name="btnSubmit" class="btn btn-lg btn-primary">Post</button>
								</div>
				<form>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="page-header bordered">
                  <h1>Post Ad</h1>
                </div>
		<div class="row">
			<div class="col-md-12 table-responsive">
				<table class="table table-bordered table-stripped table-hover">
					<tr>
						<th width="30%">Post By</th>
						<th width="20%">Post Date</th>
						<th width="50%">Post</th>
					
					</tr>
				<?php
					$Query = 


					"

	SELECT

postadd.post_id,
users.fname,
users.lname,
postadd.post_text,
postadd.post_time



                FROM postadd
                INNER JOIN users ON users.user_id=postadd.post_by
                INNER JOIN friends_list ON friends_list.user_id=postadd.post_by

           WHERE friends_list.request_status='1' AND friends_list.friend_id=".$_SESSION["UserID"]." 
			
";

					$rstRow = mysqli_query($Conn, $Query);
					if(mysqli_num_rows($rstRow)>0)
					{
						while ($objRow = mysqli_fetch_object($rstRow)) 
						{
				?>
					<tr>
						<td><?=$objRow->fname." ".$objRow->lname;?></td>
						<td><?=date_format(date_create($objRow->post_time), "F d, Y h:i A");?></td>
						<td><?=$objRow->post_text;?></td>
						
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

