<?php
	include 'connect.php';
	
	$action=$_GET['action'];
	if ($action=="addComment")
	{
		$comment=$_GET['comment'];
		$userId=$_GET['userId'];
		$productId=$_GET['productId'];
		$SQL="INSERT INTO comments (comment,userId,date,productId) values ('$comment',$userId,NOW(),$productId)";
		echo mysql_query($SQL);
	}	

?>
