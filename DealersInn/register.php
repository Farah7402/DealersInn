<?php

  ob_start();
  session_start();
  include("library/opencon.php");
  include("library/functions.php");
if(isset($_POST["submit"]))
 {



$sale=$_POST['sale'];
$b=implode($sale);

$rent=$_POST['rent'];
$c=implode($rent);


if(empty($_POST["username"]))
{
  echo "Please enter unique name <br>";
}
else
{
  $username=$_POST["username"];
}

if(empty($_POST["firstname"]))
{
  echo "Please enter first name <br>";
}
else
{
  $firstname=$_POST["firstname"];
}

if(empty($_POST["lastname"]))
{
  echo "Please enter last name <br>";
}
else
{
  $lastname=$_POST["lastname"];
}



if(empty($_POST["email"]))
{
  echo "Please enter email <br>";
}
else
{
  $email=$_POST["email"];
}

if(empty($_POST["mobile"]))
{
  echo "Please enter mobile number <br>";
}
else
{
  $mobile=$_POST["mobile"];
}

if(empty($_POST["address"]))
{
  echo "Please enter address <br>";
}
else
{
  $address=$_POST["address"];
}

if(empty($_POST["city"]))
{
  echo "Please enter city <br>";
}
else
{
  $city=$_POST["city"];
}

if(empty($_POST["zipcode"]))
{
  echo "Please enter zipcode <br>";
}
else
{
  $zipcode=$_POST["zipcode"];
}

if(empty($_POST["company"]))
{
  echo "Please enter company name <br>";
}
else
{
  $company=$_POST["company"];
}

if(empty($_POST["fax"]))
{
  echo "Please enter fax <br>";
}
else
{
  $fax=$_POST["fax"];
}

if(empty($_POST["reggov"]))
{
  echo "Please select one<br>";
}
else
{
  $reggov=$_POST["reggov"];
}


if(empty($_POST["password"]))
{ 
  echo "Please enter password <br>";
}
else
{
  $password=$_POST["password"];
}


if(empty($_POST["repeatpassword"]))
{ 
  echo "Please confirm password <br>";
}
else
{
  $repeatpassword=$_POST["repeatpassword"];
}

$bquery = "SELECT * FROM register WHERE username='$username'";
$bresult = mysqli_query($conn,$bquery);
while($brow = mysqli_fetch_assoc($bresult)){
  $dbusername = $brow["username"];
}

if($username == $dbusername){
  echo "User Already exists";
}

else{

$cquery = "SELECT * FROM register WHERE email='$email'";
$cresult = mysqli_query($conn,$cquery);
while($crow = mysqli_fetch_assoc($cresult))
{
  $dbemail = $crow["email"];
}

if($email == $dbemail){
  echo "Email Already exists";
}

else{
if($password == $repeatpassword)
  {
  if($username && $firstname && $lastname && $email && $password)
  {
    $confirmcode=rand();
    $query = "INSERT INTO register (username,firstname,lastname,email,password,confirmed,confirmcode,mobile,address,city,zipcode,company,fax,reggov,registeredby,registrationnumber,dealswithsale,dealswithrent,sale,rent)
     VALUES ('$username','$firstname','$lastname','$email','$password','0','$confirmcode','$mobile','$address','city','zipcode','$company','$fax','$reggov','" . $_POST["registeredby"] . "',
    '" . $_POST["registrationnumber"] . "','" . $_POST["dealswithsale"] . "','" . $_POST["dealswithrent"] . "','$b ','$c')";

    $result=mysqli_query($conn,$query);

    if($result)
    {
     $base_url = "http://localhost/youtubeVideo/verifyemail.php/";  //change this baseurl value as per your file path
      $mail_body = 
      "
         
            <html>
            <head>
              <title></title>
            </head>
            <body>
            Dear $firstname <br> Your account has been created.Now please verify your account <br> Click on below link to activate your account <br> 
      <p>Please Open this link to verified your email address -  .$base_url. verifyemail.php?code=$confirmcode&email=$email
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
      $mail->Username = "farahjabeen024@gmail.com";
      $mail->Password = "78624011997FARAH@J";

      $mail->From = "farahjabeen024@gmail.com";     //Sets the From email address for the message
      $mail->FromName = 'DealersInn';         //Sets the From name of the message
      $mail->AddAddress($_POST['email'], $_POST['firstname']);    //Adds a "To" address     
      $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);              //Sets message type to HTML       
      $mail->Subject = 'Email Verification';      //Sets the Subject of the message
      $mail->Body = $mail_body;             //An HTML or plain text message body
      if($mail->Send())               //Send an Email. Return true on success or false on error
      {
              echo "sent";  
      }
    }
    else
    {
      echo "Error <br/> " .$query. "<br/>" .$conn->error;
    }
  }
  }

  else
  {
    echo "Your password are not matching";
  }
  
  }
 }
}
?>

<!DOCTYPE>
<html>
<head>
  <title>Login/Registration</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width , initial-scale=1">

<link href="css/font.css" rel="stylesheet">
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate.css" rel="stylesheet">
<link href="lib/selectric/selectric.css" rel="stylesheet">
<link href="lib/aos/aos.css" rel="stylesheet">
<link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/reg_form.css" rel="stylesheet">


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/selectric/jquery.selectric.js"></script>
<script src="lib/aos/aos.js"></script>
<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="lib/sticky-sidebar/ResizeSensor.min.js"></script>
<script src="lib/sticky-sidebar/theia-sticky-sidebar.min.js"></script>
<script src="lib/lib.js"></script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery/min/js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.js"></script>



<body>

   
      
        

  <form method="post" action="" autocomplete="off">
  

<div class="container">


  <div class="row">


     <div class="subhead font_s ros subhead1" style="margin-top: 50px;"><h4 style="font-weight: bold; font-size: 25px;">SignUp</h4></div>

     <br> <br> <br>

    <div class="col-sm-6 col-md-6 col-lg-6" >

      <fieldset>
        <br> <br>
         <div class="subhead font_s ros subhead1">Registration</div>
   
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="username" placeholder="Name">
    </div>

         <div class="form-group">
      <label for="name">First Name</label>
      <input type="text" class="form-control" name="firstname" placeholder="First Name">
    </div>

    <div class="form-group">
      <label for="name">Last Name</label>
      <input type="text" class="form-control" name="lastname" placeholder="Last Name">
    </div>

    <div class="form-group">
      <label for="email">Enter email</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
    </div>

    <div class="form-group">
      <label for="pwd">Enter Password</label>
      <input type="password" class="form-control" name="password"  placeholder="Password">
    </div>

    <div class="form-group">
      <label for="pwd">Confirm Password</label>
      <input type="password" class="form-control" name="repeatpassword"  placeholder="Confirm Password">
    </div>
      </fieldset>


      <fieldset>

<br> <br>
 <div class="subhead font_s ros subhead1">Personal Details</div>

    <div class="form-group">
      <label for="mobile">Mobile</label>
      <input type="number" class="form-control" name="mobile"  placeholder="Mobile">
    </div>

    <div class="form-group">
      <label for="address">Address </label>
      <input type="text" class="form-control" name="address"  placeholder="Address ">
    </div>

    <div class="form-group">
      <label for="city">City </label>
      <input type="text" class="form-control" name="city"  placeholder="City">
    </div>

    <div class="form-group">
      <label for="zipcode">Zipcode</label>
      <input type="number" class="form-control" name="zipcode"  placeholder="Zipcode">
    </div>

  </fieldset>

     
    </div>


    <div class="col-sm-6 col-md-6 col-lg-6">

      <fieldset>
        
        <br> <br>
 <div class="subhead font_s ros subhead1">Business Details</div>

    <div class="form-group">
      <label for="company">Company Name</label>
      <input type="text" class="form-control" name="company"  placeholder="Company">
    </div>

    <div class="form-group">
      <label for="fax">Fax Number</label>
      <input type="number" class="form-control" name="fax"  placeholder="Fax number">
    </div>


    <div class="form-group">
      
      
 <label for="company">Registered As</label> <br/>
       <input type="radio" id="yesCheck" value="Government Registered" name="reggov"
        onclick="javascript:yesnoCheck();"> <label for="Government Registered">Government Registered</label>

        &nbsp; &nbsp;
 
       <input type="radio" id="yesCheck" value="Not Government Registered" name="reggov" 
       onclick="javascript:yesnoCheck();"> <label for="N_Government Registered">Not Government Registered
       </label>

             <div id="ifYes" style="visibility:hidden ; color: black; font-size: 18px;">
              
              <select name="registeredby" class="regby"> 
              <option selected="">Select one.... </option>
              <option value="Government" style="color: black;">Government</option>
              <option value="Fedral" style="color: black;">Fedral</option>
              <option value="Local" style="color: black;">Local</option>
              <option value="Province" style="color: black;">Province</option>
              </select>
            <br> <br>
              <input type='number' id='registrationnumber' name='registrationnumber' placeholder="Enter Registered Number"/></div>

<script >
        function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

}
</script>

    </div>

      </fieldset>

      <div class="subhead font_s ros subhead1">Deals with</div> 

  <div class="sale">
   <input type="checkbox" id="saleyesCheck" value="sale" name="dealswithsale" onclick="javascript:Checksale();"> <label for="sale">Sale</label>
 </div>
  
<div class="sale">
   <input type="checkbox" id="rentyesCheck" value="rent" name="dealswithrent" onclick="javascript:Checkrent();"> <label for="rent">Rent</label>
</div>


   
<div id="saleYes" style="visibility:hidden">

<div class="saleyes">
  
   <input type="checkbox" id="yes" name="sale[]" value="house"> <label for="house">House</label>
 
   <input type="checkbox" id="yes" name="sale[]" value="plot"> <label for="house">Plots</label>

   <input type="checkbox" id="yes" name="sale[]" value="flat"> <label for="house">Flats</label>
  
   <input type="checkbox" id="yes" name="sale[]" value="apartment"> <label for="house">Apartments</label></div>
       
 </div> 

 <div  id="rentYes" style="visibility:hidden;">

  <div class="saleyes">
   <input type="checkbox" id="yes"  name="rent[]" value="house"> <label for="house">House</label>
 
   <input type="checkbox" id="yes"  name="rent[]" value="plot"> <label for="house">Plots</label>

   <input type="checkbox" id="yes"  name="rent[]" value="flat"> <label for="house">Flats</label>
  
   <input type="checkbox" id="yes"  name="rent[]" value="apartment"> <label for="house">Apartments</label> </div>
       
 </div> 



 <!--------------------------------------------------------------------------------------------------------------->
<script >


function Checksale() {
    if (document.getElementById('saleyesCheck').checked) {
        document.getElementById('saleYes').style.visibility = 'visible';
    }
    else document.getElementById('saleYes').style.visibility = 'hidden';}


     function Checkrent() {
    if (document.getElementById('rentyesCheck').checked) {
        document.getElementById('rentYes').style.visibility = 'visible';
       }
     
     else 
      document.getElementById('rentYes').style.visibility = 'hidden';}

        
</script>
</fieldset>
<br> <br>

<div class="form-group" style="float: right; margin-right:10px; " >
    <button type="submit" class="" name="submit" class="btn btn-primary btn-lg">Register</button> <br/><br/>
    <a href="signin.php">Already have a account?Login here</a><br/>
    </div>
  
  </div>
  </form>   
      
    </div>
    
  </div>
</div>

</body>
</html>