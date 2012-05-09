<?php
	$id=$_GET['id'];
	if (!apc_exists("clicks"))
	{
		$clicks[$id]=0;
	}
	else
	{
		$clicks=apc_fetch("clicks");
	}	
        $clicks[$id]++;
        apc_store("clicks", $clicks);
	
	//redirecting to the page
	include 'connect.php';
	$result=mysql_query("select href from ads where id=$id");
	$href=mysql_fetch_array($result);
	$href=$href['href'];
	 header( 'Location:'.$href ) ;
?>
