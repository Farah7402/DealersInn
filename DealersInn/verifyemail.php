<?php

include("/library/opencon.php");
$code = $_GET["code"];
$email=$_GET["email"];
$query="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($conn,$query);
while ($row=mysqli_fetch_assoc($result)) {
        $db_code=$row["confirmcode"];
        $db_email=$row["email"];
        if($email == $db_email){
        	if($code == $db_code){
             
             $aquery="UPDATE users SET confirmed ='1'";
             $aresult=mysqli_query($conn,$aquery);
             $bquery="UPDATE users SET confirmcode = '0'";
             $bresult=mysqli_query($conn,$bquery);
             echo "Account activated!Please Login <a href='http://localhost/youtubeVideo/index.php'>Login</a>";
        	}
        }
        else{
        	echo "Your email code is not matching";
        }
}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


</button>
</form>
</body>
</html>