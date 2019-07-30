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



<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */


</style>

</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

<?php include("headerAdmin.php") ?>

    
        <div class="row">

          <div class="column" style="float: left; width:60%; padding: 40px; height: auto;">

              <h2 align="center">List Of All Accpeted Accounts</h2>
              <br><br>

              <?php
                
                $aquery = "SELECT * FROM users WHERE status='0' ";
                $aresult=mysqli_query($Conn,$aquery);
                $numrows = mysqli_num_rows($aresult);

                while($arow = mysqli_fetch_array($aresult))
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
                                    
                                    
                                    
                                    where users.status='1';
                                    
                              ";

                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>

        <div class="row has-sidebar">
          <div class="col-md-5 col-lg-4 col-xl-4 col-sidebar">
            <div id="sidebar" class="sidebar-left">
              <div class="sidebar_inner">
              <div class="agent-details mb-6"> 
              
                <h3 class="subheadline"> <?php echo $row[1];?> <?php echo $row[2]; ?> </h3>
                <ul class="list-unstyled">
                  <li><a href="tel:01502392905"><i class="fa fa-phone fa-fw" aria-hidden="true"></i> Call: <?php echo $row[4]; ?> </a></li>
                  <li><a href="#"><i class="fa fa-globe fa-fw" aria-hidden="true"></i> EmailId: <?php echo $row[3]; ?> </a></li>
                  <li><a href="#"><i class="fa fa-globe fa-fw" aria-hidden="true"></i> FaxNumber:<?php echo $row[8]; ?> </a></li>
                </ul>
               <label> <h3 class="btn btn-lg btn-primary btn-block"> Contact Information </h3></label>
                            &nbsp;

           </div>
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




                         <?php
                           }
                         ?>
                
                  
                
                  <?php
             
      }
                ?>
              </div>


        <div class="column" style="float: right; width:35%; padding: 30px; height:auto; border: solid; border-width:1px ">
            
          <h2>Account Requests For Activation</h2>
          <hr>
          <br>

              <?php


               $aquery = "SELECT * FROM users WHERE status='0' ";
                $aresult=mysqli_query($Conn,$aquery);
                $numrows = mysqli_num_rows($aresult);
                 
                if ($numrows == 0) {
                 echo "<h5> You have no  requests to activate account.</h5>";
             
                }
                else{
             

                while($arow = mysqli_fetch_array($aresult))
                {

                  echo " <h3>".$arow["email"]."</h1> ".$arow["fname"]."  ".$arow["lname"]."  sent you request to activate an account <br> </h3>";
                  
                  ?>
                  <div style=" display: inline-grid">
                  <form action='adminCheck.php?id=<?php echo $arow['user_id'] ?>' method='post'>
                    <input type="submit" name="accept" value="Accept" class="btn btn-success" onclick="myFunctionaccept()">
                  </form>
                 </div>

                 <div style=" display: inline-grid">
                    <form action='adminCheck.php?id=<?php echo $arow['user_id'] ?>' method='post'>
                    <input type="submit" name="reject" value="Reject" class="btn btn-danger" onclick="myFunctionreject()">
                  </form>
                </div>

                 <div style=" display: inline-grid">
                   <form action='viewprofile.php?id=<?php echo $arow['user_id'] ?>' method='post'>
                    <input type="submit" name="profile" value="View Profile" class="btn btn-success">
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
        
        $bquery ="UPDATE users  SET  status='1' , confirmcode='0' WHERE user_id=".$_GET["id"]." ";
        $bresult = mysqli_query($Conn,$bquery);
        if($bquery)
        {
       
          //javascript
          //function myFunctionaccept()confirm

        $equery ="SELECT * FROM  users WHERE user_id=".$_GET["id"]." ";
        $eresult = mysqli_query($Conn,$equery);
        $numrows = mysqli_num_rows($eresult);

          if ($numrows == 0) 
          {
                 echo "<h1> No email send</h1>";
             
          }

         while($arow = mysqli_fetch_array($eresult)){

              $mail_body = 
              "
             
                    <html>
                    <head>
                      <title></title>
                    </head>
                    <body>
                    Dear User <br>Thankyou for using our platform.We believe you will deal easily by using our platform. Your account has been Activated.<br>
                    Now,you can Login here http://localhost/FYP%20with%20Database/DealersInn/DealersInn/signin.php
                    <br> 
              
                    <p>Best Regards,<br/>DealersInn</p>
                    </body>
                    </html>
              ";


              require 'class/class.phpmailer.php';
              $mail = new PHPMailer;
                    
              $mail->IsSMTP();
              $mail->Host = "smtp.gmail.com";

              $mail->SMTPAuth = true;
              $mail->SMTPSecure = "ssl";
              $mail->Port = 465;
              $mail->Username = "farah011997@gmail.com";
              $mail->Password = "bwA7GdqSHQefg53";

              $mail->From = "farah011997@gmail.com";     //Sets the From email address for the message
              $mail->FromName = 'DealersInn';         //Sets the From name of the message


              $mail->AddAddress($arow["email"]);    //Adds a "To" address     
              $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
              $mail->IsHTML(true);              //Sets message type to HTML       
              $mail->Subject = 'Email Verification';      //Sets the Subject of the message
              $mail->Body = $mail_body;             //An HTML or plain text message body
              if($mail->Send())               //Send an Email. Return true on success or false on error
              {
                      //javascript
                //function myFunctionaccept()confirm
              }
          }
                
    }

}

    
      if (isset($_POST['reject'])) 
{
        
         $bquery ="SELECT email  FROM  users WHERE user_id=".$_GET["id"]." ";
         $bresult = mysqli_query($Conn,$bquery);
        //$bquery ="DELETE FROM  users  WHERE user_id=".$_GET["id"]." ";
        //$bresult = mysqli_query($Conn,$bquery);
        if($bquery)
        {
        //javascript myFunctionreject

        $equery ="DELETE FROM  users  WHERE user_id=".$_GET["id"]." ";
        $eresult = mysqli_query($Conn,$equery);
          
        //$equery ="SELECT email  FROM  users WHERE user_id=".$_GET["id"]." ";
        //$eresult = mysqli_query($Conn,$equery);
        $numrows = mysqli_num_rows($bresult);

          if ($numrows == 0) 
          {
                 echo "<h1> No email send</h1>";
             
          }

         while($arow = mysqli_fetch_array($bresult)){


              $mail_body = 
              "
             
                    <html>
                    <head>
                      <title></title>
                    </head>
                    <body>
                    Dear User 
                     <br>
                    Sorry for this inconvenience your account is not accpeted due to some wrong information you have entered.<br>
                    Try again and enter correct information of you.
                    <br> 
             
                    <p>Best Regards,<br/>DealersInn</p>
                    </body>
                    </html>
              ";


              require 'class/class.phpmailer.php';
              $mail = new PHPMailer;
                    
              $mail->IsSMTP();
              $mail->Host = "smtp.gmail.com";

              $mail->SMTPAuth = true;
              $mail->SMTPSecure = "ssl";
              $mail->Port = 465;
              $mail->Username = "farah011997@gmail.com";
              $mail->Password = "bwA7GdqSHQefg53";

              $mail->From = "farah011997@gmail.com";     //Sets the From email address for the message
              $mail->FromName = 'DealersInn';         //Sets the From name of the message


              $mail->AddAddress($arow["email"]);    //Adds a "To" address     
              $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
              $mail->IsHTML(true);              //Sets message type to HTML       
              $mail->Subject = 'Email Verification';      //Sets the Subject of the message
              $mail->Body = $mail_body;             //An HTML or plain text message body
              if($mail->Send())               //Send an Email. Return true on success or false on error
              {
                    //javascript
                //function myFunctionreject()confirm
 
              }
          }
                
    }

}
      
?>




 <script>
function myFunctionaccept() {
 confirm("Account activate.Account activation email has been sent to the user.")
}
</script>
<script>

function myFunctionreject() {
 confirm("Account Deleted.Account deletion email has been sent to the user.")
}

</script>
