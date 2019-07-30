<?php
if(count($_POST)>0) {
	require_once("dbconnection.php");

	
$sale=$_POST['sale'];
$b=implode($sale);

$rent=$_POST['rent'];
$c=implode($rent);

	$sql = "INSERT INTO registration (email, password,confirmpassword, firstname,phone,landline,address,city,zipcode,companyname,faxnum,reggov,registeredby,registrationnumber,dealswithsale,dealswithrent,sale,rent,description) 

	   VALUES ('" . $_POST["email"] . "','" . $_POST["password"] . "','" . $_POST["confirmpassword"] . "','" . $_POST["firstname"] . "','" . $_POST["phone"] . "','" . $_POST["landline"] . "','" . $_POST["address"] . "','" . $_POST["city"] . "','" . $_POST["zipcode"] . "','" . $_POST["companyname"] . "','" . $_POST["faxnum"] . "','" . $_POST["reggov"] . "','" . $_POST["registeredby"] . "','" . $_POST["registrationnumber"] . "','" . $_POST["dealswithsale"] . "','" . $_POST["dealswithrent"] . "','$b ','$c','" . $_POST["description"] . "')";


if(isset($_POST['email']) == TRUE && empty($_POST['email'])== false)
{
	$email=$_POST['email'];

	if(filter_var($email,FILTER_VALIDATE_EMAIL)== TRUE)
	{
		echo "valid";
	}

	else
	{
		echo "invalid";
	}
}

if($conn->query($sql)===TRUE)
{

echo "<script>
window.location.href='signin.php';
alert('Successfully Registered');
</script>";

}

else {
	echo "Error <br/> " .$sql. "<br/>" .$conn->error;
}
}
?>