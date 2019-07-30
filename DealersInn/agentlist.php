<?php
  include("library/checklogin.php");
  include("library/opencon.php");
  include("library/functions.php");

 if(isset($_POST["btnType"]))
  {
    if($_POST["btnType"] == 0 || $_POST["btnType"] == 1 || $_POST["btnType"] == 2)
    {
      $Query = "DELETE FROM friends_list WHERE friend_id=".$_REQUEST["FriendID"]." AND user_id=".$_SESSION["UserID"];
    }
    else if($_POST["btnType"] == 3)
    {
      $Query = "INSERT INTO friends_list(user_id, friend_id, request_status) 
        VALUES (".$_SESSION["UserID"].",".$_REQUEST["FriendID"].",2)"; 
      $Notification = "Sent you Friend request.<a href=\"accept.php?id=".$_REQUEST["FriendID"]."\">Friend Request</a>";

      MakeNotification($_REQUEST["FriendID"], $_SESSION["UserID"], $Notification); 
    }
    mysqli_query($Conn, $Query);
    header("Location: agentlist.php");
    exit();
}
?>
<?php
 if(isset($_POST['search']))
{
   
    $name=$_POST['name'];
    $lastname=$_POST['lname'];
    $city=$_POST['city'];

   
    // search in all table columns
    // using concat mysql function
       if($name != ""  || $city != "" || $lastname != "" )
       {

    
    
     $query = "

     SELECT                     
                                            /*0*/          users.user_id,
                                            /*1*/          users.fname,
                                            /*2*/          users.lname,
                                             /*3*/         users.email,
                                              /*4*/        users.phone,
                                              /*5*/        users.address,
                                               /*6*/       cities.city_name,
                                              /*7*/        users.company,
                                              /*8*/        friends_list.request_status

                                               FROM users
                                         
                                          INNER JOIN cities ON cities.city_id=users.city
                                          LEFT OUTER  JOIN friends_list ON users.user_id=friends_list.friend_id AND friends_list.user_id=".$_SESSION["UserID"]." 
      

WHERE 
(users.fname='$name' OR users.lname='$lastname' )AND cities.city_name ='$city' 



ORDER BY users.registration_date  DESC

";

    $search_result = filterTable($query);




}


}
 else 

 {
    $query = "SELECT                     
                                            /*0*/          users.user_id,
                                            /*1*/          users.fname,
                                            /*2*/          users.lname,
                                             /*3*/         users.email,
                                              /*4*/        users.phone,
                                              /*5*/        users.address,
                                               /*6*/       cities.city_name,
                                              /*7*/        users.company,
                                              /*8*/        friends_list.request_status

                                               FROM users
                                         
                                          INNER JOIN cities ON cities.city_id=users.city
                                          LEFT OUTER  JOIN friends_list ON users.user_id=friends_list.friend_id AND friends_list.user_id=".$_SESSION["UserID"]." 
                                         
 WHERE users.user_id !=".$_SESSION["UserID"]." AND users.status=1

ORDER BY users.registration_date  DESC

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
<script>
  function btnStatus(FriendID, actionType)
  {
    document.Form.FriendID.value = FriendID;
    //alert(document.Form.FriendID.value);
    document.Form.btnType.value = actionType;
    //alert(document.Form.btnType.value);
    document.Form.submit();
    return false;
  }
</script>
</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

<?php include("header.php") ?>




<form action="agentlist.php" method="post">
  <div id="main">
<div class="container">

<!-----------------------SEARCH------------>
<div class="container">
  <div class="search-form">
    <div class="card">

      <div class="row">
        
          <div class="col-lg-5">
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

        <div class="col-lg-7">
          <div class="row">
           
            <div class="col-sm-4">
              <div class="form-group">
             <input type="text" class="form-control form-control-lg" placeholder="First Name" name="name">
              </div>
            </div>

          <div class="col-sm-4">
              <div class="form-group">
             <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lname">
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
</div>
</div>
</form>

<form method="POST" name="Form">





<!--------------------Detail Search----------------->

<div id="main">


<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-10">

            <div class="clearfix"></div>
            <div class="item-listing list">

                <?php while($row = mysqli_fetch_array($search_result)):?>
                <?php {?>
                <div class="item">
                <div class="row">
                  <div class="col-md-3">
                    <!--div class="item-image"> <img src="img/demo/profile2.jpg" class="img-fluid" alt=""> </div-->
                     <h3 class="item-title"><a href="#">&nbsp&nbsp&nbsp<?php echo $row[1]; ?> &nbsp; <?php echo $row[2]; ?> </a></h3>
                     <div  class="col-sm-3"><small>City:<?php echo $row[6]; ?></small></div><br>
                     <div class="col-md-12">
                      <?php
                        if($row[8] == 2)
                        {
                      ?>
                        <small>Request Already Sent!</small>
                        <br><br>
                    <button type="button" class="btn btn-lg btn-danger btn-success" onclick="return btnStatus(<?=$row[0];?>,2);">Cancel Request</button>


                      <?php
                        }
                        else if($row[8] == 1)
                        {
                      ?>
                        <button type="button" class="btn btn-lg btn-danger btn-block" onclick="return btnStatus(<?=$row[0];?>,1);">UnFriend</button>
                      <?php
                        }
                        else if($row[8] == 0 && $row[8] != NULL)
                        {
                      ?>
                        <small>User is blocked!
                          <small>You can't send request to this person!</small></small>
                          <br><br>
                        <button type="button" class="btn btn-lg btn-danger btn-block" onclick="return btnStatus(<?=$row[0];?>,0);">Un Block</button>
                      <?php
                        }
                        else
                        {
                      ?>

                        <small>If you are friends, you can share data!</small>
                        <br><br>
                    <button type="button" class="btn btn-lg btn-primary btn-block" onclick="return btnStatus(<?=$row[0];?>,3);">Add Friend</button>
                      <?php
                        }
                      ?>
                   
                  </div>
                  </div>
                 
                </div>
              </div>

 <?php } endwhile;?>
                   <input type="hidden" name="FriendID" value="">
                   <input type="hidden" name="btnType" value="">



           
           
         
       
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact Agent Modal -->

</form>
<?php include("footer.php"); ?>

</body>
</html>

