<?php

  include("library/checklogin.php");
  include("library/opencon.php");
  include("library/functions.php");
  if(isset($_POST["btnType"]))
  {
    //INSERT INTO friends_list(user_id, friend_id, request_status) VALUES ([value-1],[value-2],[value-3])
    //DELETE FROM friends_list WHERE 1
    //UPDATE friends_list SET user_id=[value-1],friend_id=[value-2],request_status=[value-3] WHERE 1
    if($_POST["btnType"] == 0 || $_POST["btnType"] == 1 || $_POST["btnType"] == 2)
    {
      $Query = "DELETE FROM friends_list WHERE friend_id=".$_REQUEST["FriendID"]." AND user_id=".$_SESSION["UserID"];
    }
    else if($_POST["btnType"] == 3)
    {
      $Query = "INSERT INTO friends_list(user_id, friend_id, request_status) 
        VALUES (".$_SESSION["UserID"].",".$_REQUEST["FriendID"].",2)";  
    }
    //echo($Query);
    //die();
    mysqli_query($Conn, $Query);
    header("Location: agentlist1.php");
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



<form method="POST" name="Form">
<div id="main">


<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-10">
        <div class="row has-sidebar">
          <div class="col-md-5 col-lg-4 col-xl-4 col-sidebar">  
                                    <?php

                                      $sql= "

                                      SELECT 

                                            /*0*/          users.user_id,
                                            /*1*/          users.fname,
                                            /*2*/          users.lname,
                                             /*3*/         users.email,
                                              /*4*/        users.phone,
                                              /*5*/        users.address,
                                               /*6*/       cities.city_name,
                                              /*7*/        users.company,
                                              friends_list.request_status  
                                               
                                          FROM users
                                         
                                          INNER JOIN cities ON cities.city_id=users.city
                                          LEFT OUTER JOIN friends_list ON users.user_id=friends_list.friend_id AND friends_list.user_id=".$_SESSION["UserID"]." WHERE users.user_id !=".$_SESSION["UserID"]." AND users.status=1";
                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>
                  <div id="sidebar" class="sidebar-left">
                <div class="sidebar_inner">
                  <div class="agent-details mb-5"> 
                    <div class="text-center">
                      <img class="img-fluid img-rounded agent-thumb" src="img/demo/profile.jpg" alt="">

              </div>
                     <h3 class="subheadline"><a href="#"><?php echo $row[1]; ?> &nbsp; <?php echo $row[2]; ?> </a></h3>
                     <div class="col-md-9">
                      
                      <?php

                        if($row[8] == 2)
                        {
                      ?>
                        <small>Request Already Sent!</small>
                    <button type="button" class="btn btn-lg btn-danger btn-block" onclick="return btnStatus(<?=$row[0];?>,2);">Cancel Request</button>
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
                        <small>User is blocked!</small>
                        <button type="button" class="btn btn-lg btn-primary btn-block" onclick="return btnStatus(<?=$row[0];?>,0);">Un Block</button>
                      <?php
                        }
                        else
                        {
                      ?>
                        <small>If you are friend you can share data!</small>
                    <button type="button" class="btn btn-lg btn-primary btn-block" onclick="return btnStatus(<?=$row[0];?>,3);">Add Friend</button>
                      <?php
                        }
                      ?>
                   
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
                                      ?><input type="hidden" name="FriendID" value="">
                   <input type="hidden" name="btnType" value="">




           
           
         
       
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

</form>
<?php include("footer.php"); ?>

</body>
</html>

