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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/selectric/jquery.selectric.js"></script>
<script src="lib/sticky-sidebar/ResizeSensor.min.js"></script>
<script src="lib/sticky-sidebar/theia-sticky-sidebar.min.js"></script>
<script src="lib/tinymce/tinymce.min.js"></script>
<script src="lib/aos/aos.js"></script>
<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="lib/lib.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
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
                  <a href="myprofile.html" class="list-group-item active"><i class="fa fa-fw fa-pencil"></i> My Profile</a>
                  <a href="changepass.html" class="list-group-item"><i class="fa fa-fw fa-lock"></i> Change Password</a>
                  <a href="my_notifications.html" class="list-group-item"><i class="fa fa-fw fa-bell-o"></i> Notifications</a>
<!--a href="#" class="list-group-item"><i class="fa fa-fw fa-cubes"></i> Membership</a>
<a href="#" class="list-group-item"><i class="fa fa-fw fa-cog"></i> Account</a-->
                </div>
              </div>
            </div>
          </div>
	<div class="col-md-7 col-lg-8 col-xl-8">
            <div class="page-header bordered">
              <h1>My profile <small>Manage your public profile</small></h1>
            </div>
            <form action="header.php">
              <h3 class="subheadline">Basic Information</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" value="ABC">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" value="XYZ">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Your Email</label>
                <input type="text" class="form-control form-control-lg" value="abc.xyz@gmail.com">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" value="+9239876445">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" value="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>About Me</label>
                <textarea class="form-control form-control-lg text-editor" placeholder=""></textarea>
              </div>
              <h3 class="subheadline">Agent/Company Profile</h3>
              <div class="form-group">
                <label>Agent/Company Title</label>
                <input type="text" class="form-control form-control-lg">
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Street</label>
                    <input type="text" class="form-control form-control-lg" id="autocomplete" placeholder="Enter your Address">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Town</label>
                    <input type="text" class="form-control form-control-lg" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" id="locality">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" id="administrative_area_level_1">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" id="country">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Zipcode</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" id="postal_code">
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group action">
                <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>