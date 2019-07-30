<?php
   include("library/checklogin.php");
  include ("library/opencon.php");
$del=null;
 if(isset($_GET['del']))
 {
  $del=$_GET['del'];
if(mysqli_query($Conn,"delete from property_share where property_id='$del'"))
{
  if(mysqli_query($Conn,"delete from property_additional_features where property_id='$del'"))    
    {
      mysqli_query($Conn,"delete from property where property_id='$del'");
      ?>
      <div class="alert alert-success">
        <strong>Property has been deleted!</strong> <br>
        
      </div>
    <?php
}
}
}
?>
<?php

if(isset($_POST['search']))
{
   
    $name=$_POST['name'];
    $type=$_POST['type_home_plot'];
    $property_for=$_POST['property_for'];
    $city=$_POST['city'];
    $room=$_POST['room'];
    $pmin=$_POST['pmin'];
    $pmax=$_POST['pmax'];
    $location=$_POST['address'];
   

$from = date('Y-m-d', strtotime(str_replace('/', '-', $_POST["date_from"])));
    // search in all table columns
    // using concat mysql function
       if( $pmin != "" || $pmax != "" || $name != "" || $type != "" || $property_for != "" || $city != "" || $from != "" || $room != "" || $location != "" ){

    
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
                                          LEFT OUTER JOIN property_share ON property_share.property_id=property.property_id AND (property_share.user_id=".$_SESSION["UserID"]." OR property_share.friend_id=".$_SESSION["UserID"].") 
                                         

WHERE users.fname='$name' OR 
property_types.types='$type'  OR
 property.address LIKE '$location'  OR cities.city_name ='$city' AND  propert_sale_rent.type='$property_for' OR
property.date_time='$from' OR property.property_price BETWEEN '$pmin' AND '$pmax'


GROUP BY property.property_id
ORDER BY property.submit_date  DESC
    ";

    $search_result = filterTable($query);



}


}
 else {
    $query = "SELECT 
                                        /*0*/              property.property_id,
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
                                                /*13*/     property.submitted_by,
                                                /*14*/     property_types.property_type
/*15*/
,MAX(IF(addition_features.feature = 'Rooms', property_additional_features.feature, NULL)) as `View`
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
                                          INNER JOIN property_share ON (property_share.property_id=property.property_id 
                                            AND (property_share.user_id=".$_SESSION["UserID"]." OR property_share.friend_id=".$_SESSION["UserID"]." 
                                            OR property_share.friend_id=0))

GROUP BY property.property_id
ORDER BY property.date_time  DESC
                                          
     ";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "realestate_db");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#show').click(function() {
      $('.menu').toggle("slide");
    });
});
</script>

<script>
$(document).ready(function(){
    $('#show1').click(function() {
      $('.menu1').toggle("slide");
    });
});
</script>

<script type="text/javascript">
    function ShowHideDiv() {
        var ddlPassport = document.getElementById("ddlPassport");
        var dvPassport = document.getElementById("dvPassport");
        if(ddlPassport.value == "Plot")
          { dvPassport.style.display="none";}
        else if(ddlPassport.value == "House")
          { dvPassport.style.display="block";}   
        else if(ddlPassport.value == "Flat")
          { dvPassport.style.display="block";}   
        else if(ddlPassport.value == "Apartment")
          { dvPassport.style.display="block";}   
        else if(ddlPassport.value == "Upper Portion")
          { dvPassport.style.display="block";} 
        else if(ddlPassport.value == "Lower Portion")
          { dvPassport.style.display="block";}          
       /* dvPassport.style.display = ddlPassport.value == "Y" ? "block" : "none";*/
    }
</script>

</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

<?php include("header.php") ?>

        
        <form action="view_property.php" method="post">
        
<div id="main">
<div class="container">

<!-----------------------SEARCH------------>
<div class="container">
  <div class="search-form">
    <div class="card">
      <div class="row">
        
        <div class="col-lg-4">
          <div class="form-group">
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
        </div>

        <div class="col-lg-8">
          <div class="row">
            <div class="col-sm-7">
              <div class="form-group">
             <!--input type="text" class="form-control form-control-lg" placeholder="Location" 
             name="address"-->
              <div class="input-group input-group-lg">
             <input type="text" name="address" class="form-control" placeholder="Enter location, dealer or project">
      <span class="input-group-append">
      <button class="btn btn-white btn-lg" type="button"><i class="fa fa-map-marker" aria-hidden="true"></i></button></span>
    </div>
              </div>
            </div>
           
            <!--div class="col-sm-4">
              <div class="form-group">
             <button type="submit" name="search" class="btn btn-lg btn-primary btn-block">Search</button>
              </div>
            </div-->
            
            <div class="col-sm-4">
            <div class="form-group">
            <select class="form-control form-control-lg ui-select" data-placeholder="Property Type" name="property_for">
            <option>Purpose</option>
            <option value="sale">Sale</option>
            <option value="rent">Rent</option>
             <option value="Sold out">Sold out</option> 
             <option value="Rent out">Rent out</option>
            </select>
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">
                <select class="form-control form-control-lg ui-select" name="type_home_plot" select id = "ddlPassport" onchange = "ShowHideDiv()">
                <option value="selected">Type</option>
                <option value="Plot">Plot</option>
                <option value="Flat">Flat</option>
                <option value="Apartment">Apartment</option>
                <option value="Home">House</option>
                <option value="Upper Portion">Upper Portion</option>
                <option value="Lower Portion">Lower Portion</option>
                </select>
              </div>
        </div>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
             <input type="number" class="form-control form-control-lg" placeholder="Minimum Price" name="pmin">
              </div>
            </div>
           
            <div class="col-sm-4">
              <div class="form-group">
             <input type="number" class="form-control form-control-lg" placeholder="Maximum Price" name="pmax">
              </div>
            </div>

             <div class="col-sm-4">
              <div class="form-group">
             <button type="submit" name="search" class="btn btn-lg btn-primary btn-block">Search</button>
              </div>
            </div>

          </div>
        </div>

</div>
      </div>
    </div>
  </div>
<!--/div-->



<!--------------------Detail Search----------------->

<div class="col-sm-2">
<div id="show1"><input type="button" value="Detail Search" class="btn btn-lg btn-primary btn-block"></div>
</div>
<br>
  <div class="menu1" style="display: none;">
  <div class="container">
  <div class="search-form">
    <div class="card">
      <div class="row">

        <div class="col-lg-12">
          <div class="row">


            <div class="col-sm-4">
              <div class="form-group">
             <input type="date" class="form-control form-control-lg" name="date_from">
              </div>
            </div>
           
            <div class="col-sm-4">
              <div class="form-group">
             <input type="text" class="form-control form-control-lg" placeholder="Added By" name="name">
              </div>
            </div>


            <div class="col-sm-3">
            <div class="form-group">
            <div id="dvPassport" style="display: none">
            <select class="form-control form-control-lg ui-select" data-placeholder="Property Type" name="room">
            <option>Bed</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="5+">5+</option>
            </select>
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


  
  

<!-----------------------SEARCH------------>
<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-10">
       
            <div class="clearfix"></div>
            <div class="item-listing list">

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <?php if($row[14] == 2){?>
                  <div class="item">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="item-image">

                   
                     <a href="property_details_plot.php?id=<?php echo $ppid=$row['property_id']; ?>">
                       <?php
                      $s=mysqli_query($Conn,"select * from p_images where property_id='$ppid'");
                      $s1=mysqli_fetch_array($s);
                    ?>
                      <img src="img/property/<?php echo $s1['images']; ?>" class="img-fluid" alt="">

                      <div class="item-badges">
                     
                      <div class="item-badge-right"><?php echo $row[12]; ?></div>
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
                    <div class="item-location"><i class="fa fa-map-marker"></i>   <?php echo $row[8]; ?></div>
                    


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
                        $rstRow = mysqli_query($Conn, $Query);
                        if(mysqli_num_rows($rstRow) > 0)
                        {
                          echo "Shared With: ";
                          while ($objRow = mysqli_fetch_object($rstRow)) 
                          {
                            if($objRow->friend_id == 0)
                            {
                              echo("All Friends");
                            }
                            else if($objRow->friend_id == $_SESSION["UserID"])
                            {
                              echo("Only Me");
                            }
                            else
                            {
                              echo($Sperater." ".$objRow->fname." ".$objRow->lname);
                              $Sperater=",";  
                            }
                            
                          }
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
                     
                      <div class="item-badge-right"> <?php echo $row[12]; ?></div>
                      </div>
                 
                

                      
                      </a>
                  
                   </div>
                  </div>


                  <div class="col-lg-7">
                   <div class="item-info">
                   <h3 class="item-title"> <a href="property_details_home.php?id=<?php echo $row['property_id']; ?>"> Price:<?php echo $row[4]; ?><br/><?php echo $row[2]; ?>   </a>
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
                  ?> </h3>
                    <div class="item-location"><i class="fa fa-map-marker"></i><?php echo $row[7]; ?> &nbsp; &nbsp;  <?php echo $row[8]; ?></div>
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
                            if($objRow->friend_id == 0)
                            {
                              echo("All");
                            }
                            else if($objRow->friend_id == $_SESSION["UserID"])
                            {
                              echo("Only Me");
                            }
                            else
                            {
                              echo($Sperater." ".$objRow->fname." ".$objRow->lname);
                              $Sperater=",";  
                            }
                            
                          }
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
             
                <?php } endwhile;?>
      
        </form>

</div>
</div>
</div>
</div>
</div>
</div>

      
<?php include("footer.php"); ?>       
    </body>
</html>
