<?php

   include("library/checklogin.php");
  include ("library/opencon.php");

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
            <div class="clearfix"></div>
            <div class="item-listing list">
             





                                      <?php

                                      $sql= "

                                      SELECT

                                            /*0*/         property.property_id,
                                            /*1*/         users.fname,
                                            /*2*/         property.property_title,
                                             /*3*/         property_types.types,
                                              /*4*/        property.property_price,
                                              /*5*/        property.area,
                                               /*6*/       meauring_units.unit_name,
                                              /*7*/        property.address,
                                               /*8*/       cities.city_name,
                                               /*9*/       property.property_description,
                                                /*10*/      property.submit_date
                                                    
                                          FROM property
                                          INNER JOIN users ON users.user_id=property.submitted_by 
                                          INNER JOIN property_types ON property_types.property_type=property.property_type 
                                           INNER JOIN meauring_units ON meauring_units.meauring_unit=property.meauring_unit 
                                          INNER JOIN cities ON cities.city_id=property.city_id 
                                          
                                         WHERE property.submitted_by= ".$_SESSION["UserID"]."
                              ";

                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>

              <div class="item">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="item-image"> <a href="property_single.html"><img src="img/demo/property/2.jpg" class="img-fluid" alt="">
                      <!--div class="item-badges">
                      <div class="item-badge-left">Sponsored</div>
                      <div class="item-badge-right">For Sale</div>
                      </div-->
                      <div class="item-meta">
                      <div class="item-price">PropertyNumber:<?php echo $row[0]; ?><br>
                      <small>
                              Price: <?php echo $row[4]; ?> <br>
                              Area:  <?php echo $row[5]; ?> &nbsp; &nbsp;
                              Unit <?php echo $row[6]; ?>
                           </small>
                      </div>
                      </div>
                      </a>
                      <a href="#" class="save-item"><i class="fa fa-star"></i></a> </div>
                  </div>


                  <div class="col-lg-7">
                  <div class="item-info">
                    <h3 class="item-title"><a href="property_single.html"> <?php echo $row[2]; ?>  </a></h3>
                    <div class="item-location"><i class="fa fa-map-marker"></i><?php echo $row[7]; ?> &nbsp; &nbsp;  <?php echo $row[8]; ?></div>
                    <div class="item-details-i"> <span class="bedrooms" data-toggle="tooltip" title="3 Bedrooms">3 <i class="fa fa-bed"></i></span> <span class="bathrooms" data-toggle="tooltip" title="2 Bathrooms">2 <i class="fa fa-bath"></i></span> </div>
                    <div class="item-details">
                      <ul>
                        <li>Sq Ft <span><?php echo $row[5]; ?></span></li>
                        <li>Type <span>  <?php echo $row[3]; ?> </span></li>
                      </ul>
                    </div>
                 </div>
                    <div class="row">
                    <div class="col-md-6">
                                        <div class="added-on"><?php echo $row[10]; ?></div>

                    </div>
                    <div class="col-md-6">
                                         <a href="#" class="added-by"><?php echo $row[1]; ?>
                                                                                            </a>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
             


                                      <?php
                                      }
                                      ?>




           
           
         
       
            </div>
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

