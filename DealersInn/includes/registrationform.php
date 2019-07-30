<?php
if(count($_POST)>0) {
	require_once("db.php");
	$sql = 

	"INSERT INTO registration (email, password,confirmpassword, firstname, lastname,phone,landline,address,city,zipcode,companyname,faxnum,reggov,registeredby,registrationnumber,dealswithsale,dealswithrent) 

	   VALUES ('" . $_POST["email"] . "','" . $_POST["password"] . "','" . $_POST["confirmpassword"] . "','" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $_POST["phone"] . "','" . $_POST["landline"] . "','" . $_POST["address"] . "','" . $_POST["city"] . "','" . $_POST["zipcode"] . "','" . $_POST["companyname"] . "','" . $_POST["faxnum"] . "','" . $_POST["reggov"] . "','" . $_POST["registeredby"] . "','" . $_POST["registrationnumber"] . "','" . $_POST["dealswithsale"] . "','" . $_POST["dealswithrent"] . "',)";
	mysqli_query($conn,$sql);
	$current_id = mysqli_insert_id($conn);
	if(!empty($current_id)) {
		$message = "New User Added Successfully";
	}
}
?>