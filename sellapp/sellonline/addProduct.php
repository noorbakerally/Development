<?php
	include 'connect.php';
	$name=$_POST['name'];
	$category=$_POST['category'];
	$description=$_POST['description'];
	$currency=$_POST['currency'];
	$price=$_POST['price'];
	$country=$_POST['country'];
	$SQL="INSERT into product (name,description,price,catId,currency,country) values ('$name','$description',$price,$category,'$currency','$country')";
	$query=mysql_query($SQL);

	$newId=mysql_insert_id();
	if ($_FILES["file1"]["tmp_name"]) 
	{
		
		$filename="products/".$newId.$_FILES["file1"]["name"];
		move_uploaded_file($_FILES["file1"]["tmp_name"],$filename);
		mysql_query("INSERT INTO pics (url,productId) values ('$filename',$newId)");
	}
	if ($_FILES["file2"]["tmp_name"]) 
	{
		$filename="products/".$newId.$_FILES["file2"]["name"];
		move_uploaded_file($_FILES["file2"]["tmp_name"],$filename);
		mysql_query("INSERT INTO pics (url,productId) values ('$filename',$newId)");
	}
	if ($_FILES["file3"]["tmp_name"]) 
	{
		$filename="products/".$newId.$_FILES["file3"]["name"];
		move_uploaded_file($_FILES["file3"]["tmp_name"],$filename);
		mysql_query("INSERT INTO pics (url,productId) values ('$filename',$newId)");
	}
	if ($query)
	{_
?>
	<script type="text/javascript">
		parent.confirmAddProduct(1);
	</script>
	<?php 
	}
	?>
