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
</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

  <?php include("header.php") ?>

<!--searchh barr-->
<div class="home-search">
<div class="main search-form v2">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-12 col-lg-10">
        <!--div class="heading">
          <h2>Find your new property</h2>
          <h3>We will help you to find the best places to spend time in any city.</h3>
        </div-->
        <form action="main.php" method="POST">
          <div class="row justify-content-md-center">
            <div class="col-md-9 col-lg-8">
            <div class="input-group input-group-lg">

          <div class="form-control">
                <select class="form-control form-control-lg ui-select" name="city">
                <option value="selected">City</option>
                <option value="Sahiwal">Sahiwal</option>
                <option value="Lahore">Lahore</option>
                <option value="Okara">Okara</option>
                <option value="Larkana">Larkana</option>
                <option value="Karachi">Hyderabad</option>
                <option value="Faisalabad">Faisalabad</option>
                <option value="Karachi">Karachi</option>
                </select>
        </div>
      <span class="input-group-append">
      <button class="btn btn-white btn-lg" type="button"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
        <button type="submit" name="search" class="btn btn-primary btn-lg" type="button">Search!</button>
      </span>
    </div>
    <div class="search-in">

<div class="radio-box">
<input type="radio" name="sale_rent" value="rent" id="rent22">
<label class="radio-inline" for="rent22">For Rent</label>
</div>
<div class="radio-box">
<input type="radio" name="sale_rent" value="sale" id="sell22" checked="">
<label class="radio-inline" for="sell22">For Sell</label>
</div>
    </div>
    </div>
          </div>


          
      </div>
    </div>
  </div>
</div>

<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-10">
       
            <div class="clearfix"></div>
            <div class="item-listing list">

      <!-- populate table from mysql database -->

      <?php

if(isset($_POST['search']))
{
   
   $property_sale_rent=$_POST['sale_rent'];
    $location=$_POST['city'];
   


    // search in all table columns
    // using concat mysql function
       if(  $location != ""  || $property_sale_rent != "" ){

    
     $query = "SELECT 

                                            /*0*/          property.property_id,
                                            /*1*/          users.fname,
                                            /*2*/          property.property_title,
                                             /*3*/         property_types.types,
                                              /*4*/        property.property_price,
                                              /*5*/        property.area,
                                               /*6*/       meauring_units.unit_name,
                                              /*7*/        property.address,
                                               /*8*/       cities.city_name,
                                               /*9*/       property.property_description,
                                                /*10*/     property.date_time,
                                                /*11*/     property_share.user_id,
                                                /*12*/     propert_sale_rent.type,
                                              /*13*/       property.submitted_by,
                                             /*14*/        property_types.property_type
/*15*/
,MAX(IF(addition_features.feature = 'Rooms',property_additional_features.feature, NULL)) as `View`
/*16*/
,MAX(IF(addition_features.feature = 'Washrooms', property_additional_features.feature, NULL)) as `View`

    FROM property
                                          INNER JOIN users ON users.user_id=property.submitted_by 
                                          INNER JOIN property_types ON property_types.property_type=property.property_type 
                                          INNER JOIN property_additional_features ON property_additional_features.property_id=property.property_id
                                           INNER JOIN addition_features  ON addition_features.feature_id = property_additional_features.feature_id
                                           INNER JOIN meauring_units ON meauring_units.meauring_unit=property.meauring_unit 
                                           INNER JOIN propert_sale_rent ON propert_sale_rent.property_for=property.property_for
                                          INNER JOIN cities ON cities.city_id=property.city_id
                                          INNER JOIN property_share ON property_share.property_id=property.property_id AND (property_share.user_id=".$_SESSION["UserID"]." OR property_share.friend_id=".$_SESSION["UserID"].") 
                                         

WHERE  
cities.city_name='$location' AND propert_sale_rent.type='$property_sale_rent'

GROUP BY property.property_id
ORDER BY property.submit_date  DESC
    ";

  

                  $result=mysqli_query($Conn,$query);
                  while ($row=$result->fetch_array()){
?>
                                      
                <?php if($row[14] == 2){?>
                  <div class="item">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="item-image">

                   
                     <a href="property_details_plot.php?id=<?php echo $row['property_id']; ?>">
                      <img src="img/demo/property/2.jpg" class="img-fluid" alt="">
                      <div class="item-badges">
                     
                      <div class="item-badge-right">For <?php echo $row[12]; ?></div>
                      </div>
                 
                

                      
                      </a>
                  
                   </div>
                  </div>


                  <div class="col-lg-7">
                   <div class="item-info">
                    <h3 class="item-title"> <a href="property_details_plot.php?id=<?php echo $row['property_id']; ?>">Price:<?php echo $row[4]; ?><br/><?php echo $row[2]; ?>   </a>

                 <?php
                    if($row[13] == $_SESSION["UserID"])
                      {                  ?>
                  <div style="float: right;">
                   <a href="my_listing_add.php?id=<?php echo $row[0];?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 25px"></i></a>
                  <vl>
                    <a href="view_property.php?del=<?php echo $row[0];?>"><i class="fa fa-trash-o" aria-hidden="true" style="font-size: 25px; color:red"></i></a>
                  </div>
                  <?php
                    }
                  ?>

                     </h3>
                    <div class="item-location"><i class="fa fa-map-marker"></i><?php echo $row[8]; ?></div>
                    


                    <div class="item-details">
                      <ul>
                        <li><?php echo $row[6]; ?> <span><?php echo $row[5]; ?></span></li>
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
                    <?php
                      if($row[11] == $_SESSION["UserID"])
                      {
                    ?>
                    <div class="row">
                      <div class="col-md-12">
                      <?php
                        $Sperater = "";
                        $Query = "SELECT PS.friend_id, U.fname, U.lname 
                          FROM property_share AS PS INNER JOIN users AS U ON PS.friend_id=U.user_id
                          WHERE PS.user_id=".$_SESSION["UserID"]." AND PS.property_id=".$row[0];
                        //echo $Query;
                        $rstRow = mysqli_query($Conn, $Query);
                        if(mysqli_num_rows($rstRow) > 0)
                        {
                          echo "Shared With: ";
                          while ($objRow = mysqli_fetch_object($rstRow)) 
                          {
                            echo($Sperater." ".$objRow->fname." ".$objRow->lname);
                            $Sperater=",";
                          }
                        }
                        else
                        {
                          echo "Shared With: Only Me";
                        }
                      ?>
                        
                      </div>
                    </div>
                  <?php
                    }
                  ?>
                  </div>
                </div>
              </div>
            
                   <?php }
                    else{
                   ?>
        
                      <div class="item">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="item-image">

                   
                     <a href="property_details_home.php?id=<?php echo $row['property_id']; ?>">
                      <img src="img/demo/property/2.jpg" class="img-fluid" alt="">
                      <div class="item-badges">
                     
                      <div class="item-badge-right">For <?php echo $row[12]; ?></div>
                      </div>
                 
                

                      
                      </a>
                  
                   </div>
                  </div>


                  <div class="col-lg-7">
                   <div class="item-info">
                   <h3 class="item-title"> <a href="property_details_home.php?id=<?php echo $row['property_id']; ?>"> Price:<?php echo $row[4]; ?><br/><?php echo $row[2]; ?>   </a> </h3>
                    <div class="item-location"><i class="fa fa-map-marker"></i><?php echo $row[8]; ?></div>
                    <div class="item-details-i"> <span class="bedrooms" data-toggle="tooltip" title="Bedrooms"> <?php echo $row[15]; ?> <i class="fa fa-bed"></i></span> <span class="bathrooms" data-toggle="tooltip" title=" Bathrooms"> <?php echo $row[16]; ?> <i class="fa fa-bath"></i></span> </div>


                    <div class="item-details">
                      <ul>
                        <li><?php echo $row[6]; ?> <span><?php echo $row[5]; ?></span></li>
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
                    <?php
                      if($row[11] == $_SESSION["UserID"])
                      {
                    ?>
                    <div class="row">
                      <div class="col-md-12">
                      <?php
                        $Sperater = "";
                        $Query = "SELECT PS.friend_id, U.fname, U.lname 
                          FROM property_share AS PS INNER JOIN users AS U ON PS.friend_id=U.user_id
                          WHERE PS.user_id=".$_SESSION["UserID"]." AND PS.property_id=".$row[0];
                        //echo $Query;
                        $rstRow = mysqli_query($Conn, $Query);
                        if(mysqli_num_rows($rstRow) > 0)
                        {
                          echo "Shared With: ";
                          while ($objRow = mysqli_fetch_object($rstRow)) 
                          {
                            echo($Sperater." ".$objRow->fname." ".$objRow->lname);
                            $Sperater=",";
                          }
                        }
                        else
                        {
                          echo "Shared With: Only Me";
                        }
                      ?>
                        
                      </div>
                    </div>
                  <?php
                    }
                  ?>
                  </div>
                </div>
              </div>
             
                <?php }
                 }?>

                <?php
                }
              }
              ?>
               </form>
</div>
<?php include("footer.php"); ?>
</div>
</body>
</html>

