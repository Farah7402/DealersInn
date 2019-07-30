<?php
  include("library/checklogin.php");
  include("library/opencon.php");
  include("library/functions.php");
  $PropertyID = $_REQUEST["PropertyID"];
  if(isset($_POST['btnSubmit']))
  {
    //SELECT `property_id`, `feature_id`, `feature` FROM `property_additional_features` WHERE 1
    $Query = "DELETE FROM property_additional_features WHERE property_id=".$PropertyID;
    mysqli_query($Conn, $Query);
    $Query = "SELECT feature_id, data_type FROM addition_features 
      WHERE property_type=".$_REQUEST["PropertyType"];
    $rstRow = mysqli_query($Conn, $Query);
    if(mysqli_num_rows($rstRow) > 0)
    {
      while ($objRow = mysqli_fetch_object($rstRow)) 
      {
        if($objRow->data_type == 3)
        {
          $i = "input".$objRow->feature_id;
          $Value = implode(",", $_REQUEST[$i]);
        }
        else
        {
          $Value = $_REQUEST["input".$objRow->feature_id];
        }
        if($Value != "")
        {
          $Query = "INSERT INTO property_additional_features(property_id, feature_id, feature) 
            VALUES (".$PropertyID.", ".$objRow->feature_id.", '".$Value."');";
          mysqli_query($Conn, $Query);
        }
      }
    }
    header("Location: sharewith.php?PropertyID=".$PropertyID);
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
<title>Dealer's INN</title>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

<script src="lib/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
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
                  <h1>Additional Features</h1>
                </div>
                <form action="additionalfeatures.php" method="POST">
                <?php
                  $Query = "SELECT feature_id, feature, data_type 
                    FROM addition_features WHERE property_type=".$_REQUEST["Type"];
                  $rstRow = mysqli_query($Conn, $Query);
                  if(mysqli_num_rows($rstRow) > 0)
                  {
                    while ($objRow = mysqli_fetch_object($rstRow)) 
                    {
                ?>
                <div class="form-group">
                  <label for="input<?=$objRow->feature_id;?>"><?=$objRow->feature;?></label>
                <?php
                  if($objRow->data_type == 1)
                  {
                    $Value = "";
                    $Value = GetValue("feature","property_additional_features"," property_id=".$PropertyID." AND feature_id=".$objRow->feature_id);
                ?>
                  <input type="text" name= "input<?=$objRow->feature_id;?>" class="form-control form-control-lg" id="input<?=$objRow->feature_id;?>" value="<?=$Value;?>" placeholder="<?=$objRow->feature;?>">
                <?php
                  }
                  else
                  {
                    $Query = "SELECT option_id, optionvalue FROM addition_features_options 
                      WHERE feature_id=".$objRow->feature_id." ORDER BY option_id";
                    $rstPro = mysqli_query($Conn, $Query);
                    if(mysqli_num_rows($rstPro) > 0)
                    {
                      if($objRow->data_type == 2)
                      {
                        $Value = "";
                        $Value = GetValue("feature","property_additional_features"," property_id=".$PropertyID." AND feature_id=".$objRow->feature_id);
                ?>
                  <select name="input<?=$objRow->feature_id;?>" id="input<?=$objRow->feature_id;?>" class="form-control form-control-lg">
                    <option value="" selected="">Choose Option</option>
                  <?php
                    while ($objPro = mysqli_fetch_object($rstPro)) 
                    {
                ?>
                    <option value="<?=$objPro->optionvalue;?>" <?php if($objPro->optionvalue == $Value) echo("SELECTED"); ?>><?=$objPro->optionvalue;?></option>
                <?php
                    }
                  ?>
                  </select>
                <?php
                      }
                      else if($objRow->data_type == 3)
                      {
                        $Value = "";
                        $Value = GetValue("feature","property_additional_features"," property_id=".$PropertyID." AND feature_id=".$objRow->feature_id);
                        $FeatureValue = explode(",", $Value);
                  while ($objPro = mysqli_fetch_object($rstPro)) 
                    {
                      $Checked = "";
                      for($i=0;$i<sizeof($FeatureValue);$i++)
                      {
                        if($objPro->optionvalue == $FeatureValue[$i])
                        {
                          $Checked = "CHECKED";
                          break;
                        }
                      }
                ?>
                  <div class="checkbox">
                    <input  name="input<?=$objRow->feature_id;?>[]" type="checkbox" id="input<?=$objRow->feature_id."-".$objPro->option_id;?>" value="<?=$objPro->optionvalue;?>" <?=$Checked;?>>
                    <label for="input<?=$objRow->feature_id."-".$objPro->option_id;?>"><?=$objPro->optionvalue;?></label>
                  </div>
                <?php
                    }
                      }
                    }
                ?>
                <?php
                  }
                ?>
                </div>
              <?php
                  }
                }
              ?>
                <hr>
                <div class="form-group">
                  <input type="hidden" name="PropertyID" value="<?=$_REQUEST["PropertyID"];?>">
                  <input type="hidden" name="PropertyType" value="<?=$_REQUEST["Type"];?>">

                <?php
                  if(isset($_REQUEST["Edit"]))
                  {
                ?>
                  <button type="submit" name="btnSubmit" value="SEND" class="btn btn-lg btn-primary">Edit Property </button>
                <?php
                  }
                  else
                  {
                ?>
                  <button type="submit" name="btnSubmit" value="SEND" class="btn btn-lg btn-primary">Share Property</button>

                <?php
                  }
                ?>
                  
                  
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
    $("#SubType").load("loadsubtypeproperty.php?PropertyType="+PropertyType);
    $("#additionalFeatures").load("additionalfeatures.php?PropertyType="+PropertyType);
    //return false;
  }
  function loadCities(ProvinceID)
  {
    $("#Cities").load("loadcities.php?ProvinceID="+ProvinceID);
    return false;
  }
</script>
</body>
</html>