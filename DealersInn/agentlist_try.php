<?php
  include("library/checklogin.php");
  include("library/opencon.php");
  include("library/functions.php");
  if(isset($_POST['btnAddFriend']))
  {
    $Query="INSERT INTO friends_list(user_id,friend_id,request_status)
      VALUES(".$_SESSION["UserID"].", ".$_REQUEST["FriendID"].", 2)";
    mysqli_query($Conn, $Query);
    header("Location: agentlist_try.php?ID=".$_REQUEST["FriendID"]);
    exit();
  }
  if(isset($_POST['btnRequestCancel']) || isset($_POST["btnUnfriend"]))
  {
    $Query = "DELETE FROM friends_list 
      WHERE user_id=".$_SESSION["UserID"]." AND friend_id=".$_REQUEST["FriendID"];
    mysqli_query($Conn, $Query);
    header("Location: agentlist_try.php?ID=".$_REQUEST["FriendID"]);
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
<title>Real Estate</title>

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




<div id="main">


<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-10">
        <!--div class="row has-sidebar">
          <div class="col-md-5 col-lg-4 col-xl-4 col-sidebar">
            <div id="sidebar" class="sidebar-left">
              <div class="sidebar_inner">
              <div class="agent-details mb-5"> 
              <div class="text-center">
              <img class="img-fluid img-rounded agent-thumb" src="img/demo/profile.jpg" alt="">
              </div>
                <h3 class="subheadline">John Doe</h3>
                <ul class="list-unstyled">
                  <li><a href="tel:01502392905"><i class="fa fa-phone fa-fw" aria-hidden="true"></i> Call: 01502 392905</a></li>
                  <li><a href="#"><i class="fa fa-globe fa-fw" aria-hidden="true"></i> johnagent.com</a></li>
                </ul>
                <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#leadform">Contact John</a> </div>
                </div>
            </div>
          </div-->
          <!--div class="col-md-7 col-lg-8 col-xl-8">
            <div class="page-header mt-0">
            <h1>About John Doe <small><i class="fa fa-map-marker"></i> Kirkstone Road, Middlesbrough TS3</small></h1>
            </div>
            <p>This is about the Agent section, agent himself can add this from his edit profile section. They can write about their experience in RealEstate market.</p>
            <hr/>
            <div class="lead">Recent properties by John Doe</div>
            <div class="sorting">
              <div class="row justify-content-between">
              <div class="col-sm-5 col-md-5 col-lg-4 col-xl-4">
              <div class="form-group">
                  <select class="form-control ui-select">
                    <option selected="selected">Most recent</option>
                    <option>Most reduced</option>
                    <option>Most popular</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
              <div class="btn-group float-right" role="group"> <a href="property_grid.html" class="btn btn-light"><i class="fa fa-th"></i></a> <a href="property_listing.html" class="btn btn-light active"><i class="fa fa-bars"></i></a> </div>
              </div>
              </div>                
            </div-->
            <div class="clearfix">
              
            </div>
            <div class="item-listing list">
                                      <?php
                                      $Query= "
                                      SELECT 

                                            /*0          users.user_id,*/
                                            /*1*/          U.fname,
                                            /*2*/          U.lname,
                                             /*3*/         U.email,
                                              /*4*/        U.phone,
                                              /*5*/        U.address,
                                               /*6*/       U.city_name,
                                              /*7*/        U.company  FROM users INNER JOIN cities ON cities.city_id=U.city";
                                     $result = mysqli_query($Conn, $Query);
                                     $row=mysqli_fetch_array($result) or die();
                                     while ($row=mysqli_fetch_array($result)) {
                                      
                                      ?>
                                      <div id="sidebar" class="sidebar-left">
                                     
                <div class="sidebar_inner">
                  <div class="agent-details mb-5"> 
                    <div class="text-center">
                      <img class="img-fluid img-rounded agent-thumb" src="img/demo/profile.jpg" alt="">
                    </div>
                    <h3 class="subheadline"><?php echo $row[1]; ?> &nbsp; <?php echo $row[2]; ?> </h3>
                    <ul class="list-unstyled">
                    <?php
                      if($row->request_status == 1)
                      {
                    ?>
                      <li>
                        <a href="tel:<?=$objRow->phone;?>">
                          <i class="fa fa-phone fa-fw" aria-hidden="true"></i> 
                          Call: <?php echo $row[4]; ?>
                        </a>
                      </li>
                    <?php
                      }
                    ?>
                      <li>
                        <a href="mailto:<?=$objRow->email;?>">
                          <i class="fa fa-globe fa-fw" aria-hidden="true"></i> 
                          <?php echo $row[3]; ?>
                        </a>
                      </li>
                    </ul>
                  <?php
                    if($row->request_status == 1)
                    {
                  ?>
                    <button class="btn btn-lg btn-danger btn-block" name="btnUnfriend">UnFriend</button>
                  <?php
                    }
                    else if($row->request_status == 2)
                    {
                  ?>
                    <small>Request Already Sent!</small>
                    <button class="btn btn-lg btn-danger btn-block" name="btnRequestCancel">Cancel Request</button>
                  <?php
                    }
                    else if($row->request_status == 0 && $row->request_status != NULL)
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
                  <?php
                     }
                    ?>
                                    </div>
                              </div>
                            </div>
                          </div>
                        
                    <input type="hidden" name="FriendID" value="<?=$_REQUEST["ID"];?>">

                <!--div class="item">
                <div class="row">
                  <div class="col-md-3">
                    <div class="item-image"> <img src="img/demo/profile2.jpg" class="img-fluid" alt=""> </div>
                     <h3 class="item-title"><a href="#"><?php echo $row[1]; ?> &nbsp; <?php echo $row[2]; ?> </a></h3>
                     <div class="col-md-9"> <a href="#" class="btn btn-primary float-right">Add Friend</a>
                   
                   
                  </div>
                  </div>
                 
                </div>
              </div-->


                                      




           
           
         
       
            
            <!--nav aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </nav-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact Agent Modal -->


<?php include("footer.php"); ?>

</body>
</html>
