<?php

	include 'connect.php';
	$clicks=apc_fetch("clicks");
	$imprs=apc_fetch("impr");
	$ids=apc_fetch("id");
	
	if ($imprs)
	{
		foreach ($imprs as $key => $value)
		{
			$SQL_Update="UPDATE ads SET impr=impr+$value where id=$key";
			mysql_query($SQL_Update);
		}
	}

	//updating clicks
	if ($clicks)
	{
		foreach ($clicks as $key=>$value)
		{
			$SQL_Update="UPDATE ads SET clicks=clicks+".$value."  where id=".$key;
			mysql_query($SQL_Update);
		}
	}
	apc_delete("id");
	apc_delete("impr");
	apc_delete("clicks");
?>
