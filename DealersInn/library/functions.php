<?php
	function UrlString($UrlString)
	{
		$UrlString = strtolower(stripslashes(stripslashes($UrlString)));
		$UrlString = str_replace("&","and",$UrlString);
		$UrlString = str_replace("-"," ",$UrlString);
		$UrlString = str_replace("_"," ",$UrlString);
		$UrlString = str_replace(" ","_",$UrlString);
		$UrlString = TrimText($UrlString,0);
		$UrlString = str_replace(",","",$UrlString);
		$UrlString = str_replace(".","",$UrlString);
		$UrlString = str_replace("*","",$UrlString);
		$UrlString = str_replace("%","",$UrlString);
		$UrlString = str_replace("/","",$UrlString);
		$UrlString = str_replace("\\","",$UrlString);
		$UrlString = str_replace("'","",$UrlString);
		$UrlString = str_replace("(","",$UrlString);
		$UrlString = str_replace(")","",$UrlString);
		$UrlString = str_replace("+","",$UrlString);
		$UrlString = str_replace("!","",$UrlString);
		$UrlString = str_replace("","",$UrlString);
		$UrlString = trim($UrlString);
		$UrlString = str_replace(" ","_",$UrlString);
		return($UrlString);
	}
	function UCString($String)
	{
		$String = ucwords(strtolower(stripslashes($String)));
		$Value  = "";
		for ($i = 0; $i < strlen($String); $i++)
		{
			if ($String{$i} == "(" || $String{$i} == "-" || $String{$i} == "." || $String{$i} == "/" || $String{$i} == "&")
			{
				$Value = $Value . $String{$i} . strtoupper($String{$i+1});
				$i++;
			}
			else
				$Value = $Value . $String{$i};
		}
		return($Value);
	}
	function TrimText($Text,$Slashes)
	{
		$Text = str_replace("\r"," ",trim($Text));
		while (strpos($Text,"  ") > 0)
		{
			$Text = str_replace("  "," ",$Text);
		}
		if ($Slashes == 0)
			return(stripslashes($Text));
		else
			return(addslashes($Text));
	}
	function GetValue($Field,$Table,$Condition)
	{
		$FieldValue = "";
		$Query = "SELECT ".$Field." FROM ".$Table." WHERE ".$Condition;
		$rstRow = mysqli_query($GLOBALS["Conn"],$Query);
		if (substr($Field,0,1) == "@")
		{
			echo $Query;
			echo mysql_error();
			die;
		}
		if (mysqli_num_rows($rstRow) > 0)
		{
			$objRow = mysqli_fetch_array($rstRow);
			$FieldValue = $objRow[0];
		}
		return($FieldValue);
	}
	function GetMax($Field,$Table)
	{
		$Max = "1";
		$Query = "SELECT MAX(".$Field." + 1) AS Max FROM ".$Table;
		$rstRow = mysqli_query($GLOBALS["Conn"],$Query);
		if (mysqli_num_rows($rstRow) > 0)
		{
			$objRow = mysqli_fetch_array($rstRow);
			$Max = $objRow[0];
		}
		if($Max == NULL || $Max == 0)
			$Max = 1;
		return($Max);
	}
	function GetStars($Star)
	{
		$Star = ''.$Star;
		$Stars = "";
		if($Star > 0)
		{
			list($whole, $decimal) = explode('.', $Star);
			for ($i=0; $i < $whole; $i++) 
			{ 
				$Stars .= "<span class=\"fa fa-star\"></span>";
			}
			if($i < 5)
			{
				if($decimal <= 3)
				{
					$i++;
					$Stars .= "<span class=\"far fa-star\"></span>";
				}
				else if($decimal > 3 && $decimal <=7)
				{
					$i++;
					$Stars .= "<span class=\"fa fa-star-half-alt\"></span>";
				}
				else if($decimal > 7)
				{
					$i++;
					$Stars .= "<span class=\"fa fa-star\"></span>";	
				}
				for ($i; $i < 5; $i++) 
				{ 
					$Stars .= "<span class=\"far fa-star\"></span>";
				}
			}
		}
		else
		{
			$Stars = "Not Rated Yet!";
		}
		return($Stars);
	}
	function MakeNotification($For, $By, $Notification)
	{
		$ID = GetValue("MAX(notification_id+1)","notifications","notice_for=".$For);
		if($ID < 0 || $ID == NULL)
		{
			$ID = 1;
		}
		$Query = "INSERT INTO notifications(notification_id, notice_for, notice_by, notification, notification_time, status)
			VALUES (".$ID.", ".$For.", ".$By.", '".$Notification."', NOW(), 0)";
			
		mysqli_query($GLOBALS["Conn"], $Query);


	}



	
?>