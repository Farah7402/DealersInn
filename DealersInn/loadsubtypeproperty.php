<?php
	session_start();
	include("library/opencon.php");
?>
	<div class="radio radio-inline">
<?php
	$Query = "SELECT property_type, types FROM property_types WHERE property_subtype=".$_REQUEST["PropertyType"]." AND status=1";

	$rstRow = mysqli_query($Conn, $Query);
	if(mysqli_num_rows($rstRow) > 0)
	{
		while ($objRow = mysqli_fetch_object($rstRow)) 
		{
?>

<input id="SubType<?=$objRow->property_type;?>" type="radio"  name="rdoSubType" value="<?=$objRow->property_type;?>" class="product-list" <?php if($objRow->property_type == $_REQUEST["SubTypeSelected"]) echo("CHECKED") ?>>
<label for="SubType<?=$objRow->property_type;?>">
	<?=$objRow->types;?>
</label>
<?php
		}
	}
	else
	{
?>
<input type="hidden"  name="rdoSubType" value="0" >
<?php

	}
	
?>
</div>
