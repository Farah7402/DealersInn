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

  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
<div id="main">


<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-10">



              <?php
                
                $aquery = "SELECT * FROM users WHERE status='0' ";
                $aresult=mysqli_query($Conn,$aquery);
                $numrows = mysqli_num_rows($aresult);

                if($arow = mysqli_fetch_array($aresult))
                {

                  
                  ?>
                

                                      <?php

                                      $sql= "
                                         SELECT

                                      /*0*/   users.user_id,
                                      /*1*/   users.fname,
                                      /*2*/   users.lname,
                                      /*3*/   users.email,
                                      /*4*/   users.phone,
                                      /*5*/   users.address,
                                      /*6*/   users.company,
                                      /*7*/   cities.city_name,
                                      /*8*/   user_company_details.fax_number,
                                      /*9*/   user_company_details.registration_number,
                                    /*10*/    users.registration_date
                                              
                                           
                                                    
                                    FROM users
                                  
                                    INNER JOIN cities ON cities.city_id=users.city 
                                    INNER JOIN user_company_details ON user_company_details.user_id=users.user_id
                                    
                                    
                                    
                                    where user_company_details.user_id=".$_GET["id"]."
                                    
                              ";

                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>

        <div class="row has-sidebar">
          <div class="col-md-5 col-lg-4 col-xl-4 col-sidebar">
            <div id="sidebar" class="sidebar-left">
              <div class="sidebar_inner">
              <div class="agent-details mb-5"> 
              
                <h3 class="subheadline"> <?php echo $row[1];?> <?php echo $row[2]; ?> </h3>
                <ul class="list-unstyled">
                  <li><a href="tel:01502392905"><i class="fa fa-phone fa-fw" aria-hidden="true"></i> Call: <?php echo $row[4]; ?> </a></li>
                  <li><a href="#"><i class="fa fa-globe fa-fw" aria-hidden="true"></i> EmailId: <?php echo $row[3]; ?> </a></li>
                  <li><a href="#"><i class="fa fa-globe fa-fw" aria-hidden="true"></i> FaxNumber:<?php echo $row[8]; ?> </a></li>
                </ul>
                <label class="btn btn-lg btn-primary btn-block"> Contact Information </label> </div>
                </div>
            </div>
          </div>
          <div class="col-md-7 col-lg-8 col-xl-8">
            <div class="page-header mt-0">
            <h1>About <?php echo $row[1]; ?> <?php echo $row[2]; ?> <small><i class="fa fa-map-marker"></i><?php echo $row[5]; ?> &nbsp; <?php echo $row[7]; ?></small></h1>
            </div>
            <hr/>
           
           
            <div class="clearfix"></div>
            <div class="item-listing list">
              <div class="item">
                <div class="row">
              
                  <div class="col-lg-9">
                  <div class="item-info">
                    <h3 class="item-title"> Comapny Details </h3>
                   
                    <div class="item-details">
                      <ul>
                        <li>Company Name:<span> <?php echo $row[6]; ?></span></li>
                        <li>Registration Company Number:<span><?php echo $row[9]; ?></span></li>
                      </ul>
                     </div>
                 </div>
                    <div class="row">
                    <div class="col-md-12">
                     <div  style="float: left;">Account Creation On: <span>Date & Time &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row[10]; ?></span></div>

                    </div>
                    
                    </div>
                  </div>
                </div>
              </div>
       
        
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</div>


                         <?php
                           }
                         ?>
                
                  
                
                  <?php
             
      }
                ?>

</body></html>


<?php include("footer.php"); ?>