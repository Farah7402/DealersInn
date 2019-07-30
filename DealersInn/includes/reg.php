

<?php

$server="localhost";
$user="root";
$pass="";
$dbname="real_estate";

$conn= new mysqli($server,$user,$pass,$dbname);

if($conn->connect_error){
	die("Connection failed".$connect_error);
}

$nameErr = "";

$email=mysqli_real_escape_string($conn,$_POST['email']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$confirmpassword=mysqli_real_escape_string($conn,$_POST['confirmpassword']);


$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$landline=mysqli_real_escape_string($conn,$_POST['landline']);
$address=mysqli_real_escape_string($conn,$_POST['address']);
$city=mysqli_real_escape_string($conn,$_POST['city']);
$zipcode=mysqli_real_escape_string($conn,$_POST['zipcode']);
$companyname=mysqli_real_escape_string($conn,$_POST['companyname']);
$faxnum=mysqli_real_escape_string($conn,$_POST['faxnum']);
$reggov=mysqli_real_escape_string($conn,$_POST['reggov']);
$registeredby=mysqli_real_escape_string($conn,$_POST['registeredby']);
$registrationnumber=mysqli_real_escape_string($conn,$_POST['registrationnumber']);
$dealswithsale=mysqli_real_escape_string($conn,$_POST['dealswithsale']);
$dealswithrent=mysqli_real_escape_string($conn,$_POST['dealswithrent']);


$sale=$_POST['sale'];
$b=implode($sale);

$rent=$_POST['rent'];
$c=implode($rent);



if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }

 $sql="INSERT INTO
registration(email,password,confirmpassword,firstname,lastname,phone,landline,address,city,zipcode,companyname,faxnum,reggov,registeredby,registrationnumber,dealswithsale,dealswithrent,sale,rent) 
 
VALUES('$email','$password','$confirmpassword','$firstname','$lastname','$phone','$landline','$address','$city','$zipcode','$companyname','$faxnum','$reggov','$registeredby','$registrationnumber','$dealswithsale',
   '$dealswithrent','$b','$c')";

if($conn->query($sql)===TRUE){
	
  alert("Your are successfully registered");
   window.open("signin.php");


}

else {
	echo "Error <br/>" .$sql. "<br/>" .$conn->error;
}

$conn->close();
?>