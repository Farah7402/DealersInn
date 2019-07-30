<?php
clearstatcache();
  include("library/checklogin.php");
  include("library/opencon.php");
  include("library/functions.php");
 $pid=null;
 if(isset($_GET['id'])){
	$pid=$_GET['id'];}
	else
	{
		$pid = 0;
	}
	//echo $pid;
//echo $_SESSION['pid'];
  if(isset($_POST['btnSubmit']))
  {
  	if($_REQUEST["PropertyID"] == 0)
  	{
	  	$MaxID = GetMax("property_id", "property");
		$Query = "INSERT INTO property(property_id, submitted_by, property_title, 
		  property_type, property_sub_type, property_for, 
		  property_price, area, meauring_unit, address, city_id, 
		  property_description, submit_date, approved_by, status,date_time) 
		  VALUES (".$MaxID.", ".$_SESSION["UserID"].", '".$_POST['txtTitle']."', 
		  	'".$_POST['rdoPropertyType']."', '".$_POST['rdoSubType']."',  '".$_POST['rdoPropertyFor']."', 
		  	'".$_POST["txtPrice"]."', '".$_POST["textArea"]."', '".$_POST["cboUnit"]."', 
		  	'".$_POST["txtLocation"]."', '".$_POST["cboCity"]."','".$_POST["txtDescription"]."', NOW(), 0, 0,NOW())";
		mysqli_query($Conn, $Query);
		$_SESSION["Try"] = "Hit";
		header("Location: additionalfeatures.php?PropertyID=".$MaxID."&Type=".$_POST['rdoPropertyType']);
		
	exit();
	}
	else
	{
		$Query = "UPDATE property SET property_title='".$_POST['txtTitle']."',property_type='".$_POST['rdoPropertyType']."',
			property_sub_type='".$_POST['rdoSubType']."',property_for='".$_POST['rdoPropertyFor']."',
			property_price='".$_POST["txtPrice"]."',area='".$_POST["textArea"]."',
			meauring_unit='".$_POST["cboUnit"]."',address='".$_POST["txtLocation"]."',
			city_id='".$_POST["cboCity"]."',property_description='".$_POST["txtDescription"]."'
			WHERE property_id=".$_REQUEST["PropertyID"];
		mysqli_query($Conn, $Query);
		$_SESSION["Try"] = "Hit";
		$submitted_by==$_SESSION["UserID"];
		header("Location: additionalfeatures.php?Edit&PropertyID=".$_REQUEST["PropertyID"]."&Type=".$_POST['rdoPropertyType']);
    ?>
      <div class="alert alert-success">
        <strong>Property has been edited!</strong> <br>
        
      </div>
    <?php
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
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Real Estate</title>

<!-- Bootstrap -->
<link href="css/font.css" rel="stylesheet">
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate.css" rel="stylesheet">
<link href="lib/selectric/selectric.css" rel="stylesheet">
<link href="lib/aos/aos.css" rel="stylesheet">
<link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<script src="lib/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

<script src="lib/popper.min.js"></script>
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
  								<h1>Submit your property</h1>
  							</div>
  						<?php
  							if(isset($_SESSION["Try"]))
  							{
  								if($_SESSION["Try"] == "Hit")
  								{
  						?>
	  						<!--div class="alert alert-success">
	  							Property Submitted Successfully! <br>
	  							Your property will be availabe for sale/rent after aproval from admin.
	  						</div-->
  						<?php
  								}
								unset($_SESSION["Try"]);
							}
						?>

						<?php 
							$ptitle=null;
							$ptype=null;
							$psubtype=null;
							$salerent=null;
							$price=null;
							$area=null;
							$unit=null;
							
							$loc=null;
							$desc=null;
							$province=null;
							$provinceName=null;
							$city=null;
							$cityName=null;
							if(isset($_GET['id']))
							{
								//SELECT property_id, submitted_by, property_title, property_type, property_sub_type, property_for, property_price, area, meauring_unit, address, city_id, property_description, submit_date, approved_by, status FROM property WHERE 1
								$pid=$_GET['id'];
								$q=mysqli_query($Conn,"select * from property where property_id='$pid'");
								$p=mysqli_fetch_array($q);

								$ptitle=$p['property_title'];
								$ptype=$p['property_type'];;
								$psubtype=$p['property_sub_type'];
								$salerent=$p['property_for'];
								$price=$p['property_price'];
								$area=$p['area'];
								$unit=$p['meauring_unit'];						
								$loc=$p['address'];
								$desc=$p['property_description'];
								$city=$p['city_id'];

								//echo $pid;
								//echo $pid;
							$p=mysqli_query($Conn,"select province_id from Cities where city_id ='$city'");
							$p1=mysqli_fetch_array($p);
							$province=$p1['province_id'];



							}

						?>
							<form action="" method="POST">
								<h3 class="subheadline">Basic Details</h3>
								<div class="form-group">
									<label for="title">Property Title</label><span style="color: red; font-size: 20px">*</span>
									<input type="text" value="<?php echo $ptitle; ?>" name= "txtTitle" class="form-control form-control-lg" id="title" placeholder="Property Title" autofocus required="">
								</div>
								<div class="form-group">
									<label>Property Type</label>
									<span style="color: red; font-size: 20px">*</span>
									<div>
										<div class="radio radio-inline" >
										<?php
											$Query = "SELECT property_type, types FROM property_types WHERE property_subtype=0 AND status=1";
											$rstRow = mysqli_query($Conn, $Query);
											if(mysqli_num_rows($rstRow) > 0)
											{
												while ($objRow = mysqli_fetch_object($rstRow)) 
												{
													

										?>
											<input <?php if($ptype==$objRow->property_type)  { ?> checked <?php } ?> id="ProType<?=$objRow->property_type;?>" value="<?=$objRow->property_type;?>"  type="radio" name="rdoPropertyType" 
											 onclick="showSubType(<?=$objRow->property_type;?>);" > 
											<label for="ProType<?=$objRow->property_type;?>">
												<?=$objRow->types;?>
											</label>
										<?php
												}
											}
										?>
										</div>
									</div>
									<div id="SubType" style="color: black; font-size: 18px;"></div>
									<div class="form-group">
										<label>For Sale/Rent?</label>
										<span style="color: red; font-size: 20px">*</span>
										<div>
											<div class="radio radio-inline">
												<input <?php if($salerent==1) { ?>checked <?php } ?> id="Rent" type="radio" name="rdoPropertyFor" value="1" >
												<label for="Rent">
													Rent
												</label>
											</div>
											<div class="radio radio-inline">
												<input <?php if($salerent==2) { ?>checked <?php } ?> id="Sale" type="radio" name="rdoPropertyFor" value="2">
												<label for="Sale">
													Sale
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Price (IN PKR RS.)</label>
										<span style="color: red; font-size: 20px">*</span>
										<input  value="<?php echo $price; ?>" type="number" name="txtPrice" class="form-control form-control-lg"  placeholder="Price (IN PKR RS.)" required="">
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Area </label>
												<span style="color: red; font-size: 20px">*</span>
												<input value="<?php echo $area; ?>" type="number" name="textArea" class="form-control form-control-lg" placeholder="" required="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Unit</label>
												<span style="color: red; font-size: 20px">*</span>
												<select  id="Unit" name="cboUnit" class="form-control form-control-lg ui-select">
												<?php
													$Query = "SELECT meauring_unit, unit_name FROM meauring_units WHERE status=1";
													$rstRow = mysqli_query($Conn, $Query);
													if(mysqli_num_rows($rstRow) > 0)
													{
														while ($objRow = mysqli_fetch_object($rstRow)) 
														{
												?>

													<option value="<?=$objRow->meauring_unit;?>" <?php if($unit == $objRow->meauring_unit) echo "SELECTED";?>>
														<?=$objRow->unit_name;?>
														
													</option>
												<?php
														}
													}
													

												?>
												</select>
											</div>
										</div>
									</div>
									<h3 class="subheadline">Address</h3>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Location</label>
												<span style="color: red; font-size: 20px">*</span>
												<input value="<?php echo $loc; ?>" type="text" name="txtLocation" class="form-control form-control-lg" id="autocomplete" placeholder="Enter your location" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Province</label>
												<span style="color: red; font-size: 20px">*</span>
												<select  id="Unit" name="cboProvice" class="form-control form-control-lg ui-select" onchange="return loadCities(this.value);" >
													<option value="">Choose Province</option>
													
												<?php
													$Query = "SELECT province_id, province_name FROM provinces WHERE status=1 ORDER BY province_name";
													$rstRow = mysqli_query($Conn, $Query);
													if(mysqli_num_rows($rstRow) > 0)
													{
														while ($objRow = mysqli_fetch_object($rstRow)) 
														{
												?>
													<option value="<?=$objRow->province_id;?>" <?php if($province == $objRow->province_id) echo "SELECTED";?> >
														<?=$objRow->province_name;?>
													</option>
												<?php
														}
													}
												?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="Cities" class="form-group">
												<label>City</label>
												<span style="color: red; font-size: 20px">*</span>
												<select class="form-control form-control-lg ui-select" >
													<option selected value="<?php if(isset($_GET['id'])) echo $city; else echo "" ?>" disabled><?php
													if(isset($_GET['id'])) echo $cityName; else echo "Choose Province First" ?></option>
													
												</select>
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label>Property Description</label>
										<textarea value="<?php echo $desc; ?>" class="form-control form-control-lg text-editor" placeholder="" name="txtDescription" ></textarea>
									</div>
									<div class="form-group">
										<h3 class="subheadline">Upload Photos</h3>
										<div class="ui-dropzone">
											<div class="icon"></div>
											<div>Drag and drop images or click to upload</div>
											<input type="file" class="form-control form-control-lg" id="gallery" multiple>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="checkbox">
										<input type="checkbox" id="featured">
										<label for="featured">Yes ‚ feature this Property. </label>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<button type="submit" name="btnSubmit" value="SEND" class="btn btn-lg btn-primary">Additonal Features</button>
									<input type="hidden" value="<?=$pid;?>" name="PropertyID">
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
		$("#SubType").load("loadsubtypeproperty.php?PropertyType="+PropertyType+"&SubTypeSelected=<?=$psubtype;?>");
		//return false;
	}
	function loadCities(ProvinceID)
	{
		$("#Cities").load("loadcities.php?ProvinceID="+ProvinceID+"&SelectedCity=<?=$city;?>");
		//return false;
	}
<?php
	if($pid > 0)
	{
?>
	showSubType(<?=$ptype;?>);
	loadCities(<?=$province;?>)
<?php
	}
?>
</script>
</body>
</html>