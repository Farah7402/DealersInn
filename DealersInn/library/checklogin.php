<?php
	session_start();
	if(!isset($_SESSION["UserID"]) || !isset($_SESSION["UserID"]))
	{
		header("Location: signin.php");
		exit;
	}
?>