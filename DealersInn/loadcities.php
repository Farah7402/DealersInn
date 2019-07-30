<?php
	session_start();
	include("library/opencon.php");
?>
<label>City</label>
<select  id="Unit" name="cboCity" class="form-control form-control-lg ui-select" required="">
	<option value="" selected disabled>Select City</option>
<?php
	$Query = "SELECT city_id, city_name FROM cities WHERE province_id=".$_REQUEST["ProvinceID"]." AND status=1";
	$rstRow = mysqli_query($Conn, $Query);
	if(mysqli_num_rows($rstRow) > 0)
	{
		while ($objRow = mysqli_fetch_object($rstRow)) 
		{
?>
	<option value="<?=$objRow->city_id;?>" <?php if($objRow->city_id == $_REQUEST["SelectedCity"]) echo("SELECTED"); ?>><?=$objRow->city_name;?></option>
<?php
		}
	}
?>
</select>