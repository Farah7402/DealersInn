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



<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */


</style>

</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

<?php include("header.php") ?>

    
        <div class="row">

          <div class="column" style="float: left; width:68%; padding:30px; height:auto;">

              <h2 align="center">Friends</h2>
              <br><br>

                              

                                      <?php

                                      $sql= "
                                         SELECT

                                           users.fname,
                                           users.lname,
                                           friends_list.friend_id


                FROM friends_list 
                INNER JOIN users ON users.user_id=friends_list.friend_id

                WHERE friends_list.request_status='1' AND friends_list.user_id=".$_SESSION["UserID"]." ";
                              ;

                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>


                <div class="item">
                <div class="row">
                  <div class="col-md-8">
                    <!--div class="item-image"> <img src="img/demo/profile2.jpg" class="img-fluid" alt=""> </div-->
                     <h3 class="item-title"><a href="#">&nbsp&nbsp&nbsp<?php echo $row[0]; ?> &nbsp; <?php echo $row[1]; ?> </a></h3>
                  </div>
                 
                </div>
              </div>



                         <?php
                           }
                         ?>
                
                  
    
              </div>


        <div class="column" style="float: right; width:30%; padding:25px; height:auto; border: solid; border-width:1px ">
            
          <h2>Friend Requests</h2>
          <hr>
          <br>

              <?php


               $aquery = "SELECT 

               users.fname,
               users.lname,
               friends_list.friend_id


                FROM friends_list 
                INNER JOIN users ON users.user_id=friends_list.user_id

                WHERE friends_list.request_status='2' AND friends_list.friend_id=".$_SESSION["UserID"];
                $aresult=mysqli_query($Conn,$aquery);
                $numrows = mysqli_num_rows($aresult);
                 
                if ($numrows == 0) {
                 echo "<h4> You have no  friend request.</h4>";
             
                }
                else{
             

                while($arow = mysqli_fetch_array($aresult))
                {

                  echo " <h3>".$arow["fname"]."</h3> ".$arow["fname"]."  ".$arow["lname"]."  send you friend request.<br>";
                  
                  ?>
                  <div style=" display: inline-grid">
                  <form action='accept.php?id=<?php echo $arow['user_id'] ?>' method='post'>
                    <input type="submit" name="accept" value="Accept" class="btn btn-success" onclick="myFunctionaccept()  window.location.reload()">
                  </form>
                 </div>

                 <div style=" display: inline-grid">
                    <form action='accept.php?id=<?php echo $arow['friend_id'] ?>' method='post'>
                    <input type="submit" name="reject" value="Reject" class="btn btn-danger" onclick="myFunctionreject() window.location.reload()">
                  </form>
                </div>

                
                  <?php
                 
                
                 }
               }
               
                ?>
    
                                    
        </div>
     </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>


<?php include("footer.php"); ?>

<?php

      if (isset($_POST['accept'])) 
{
        
        $bquery ="UPDATE friends_list  SET  request_status='1' WHERE user_id=".$_GET["id"]." AND friend_id=".$_SESSION["UserID"]."";
        $bresult = mysqli_query($Conn,$bquery);
}

    
      if (isset($_POST['reject'])) 
{
  
  $bquery ="DELETE from friends_list  WHERE friend_id=".$_GET["id"]." AND user_id=".$_SESSION["UserID"]."";
  $bresult = mysqli_query($Conn,$bquery);
}
      
?>




 <script>
 

function myFunctionaccept() {
 confirm("Friend Request Accepted");
}
</script>
<script>

function myFunctionreject() {
 confirm("Friend Request Deleted");
}

</script>
