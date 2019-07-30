
<?php
session_start();
require "conn.php"; 
$email = $_POST["email"];
$password=$_POST["password"];
$query ="SELECT * FROM register WHERE email='$email'";
$result=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($result);
if($numrows != 0){
  while ($row = mysqli_fetch_assoc($result)) {
    $id=$row["id"];
    $useremail=$row["email"];
    $userpassword=$row["password"];
    $confirmed=$row["confirmed"];
    if($email == $useremail && $password == $userpassword){
      if($confirmed == 1){
        $_SESSION["USER"]=$id;
        header("Location:header1.php");
        exit();
      }
      else {
        # code...
        echo "Your account is not activted";
      }

    }
    else {
      # code...
      echo "Your password not match";
    }
  }
}
else{
  echo "You dont have an account please create new one";
}

?>