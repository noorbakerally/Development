<?php
	include 'connect.php';
	$search=$_GET['search'];
	$category=$_GET['category'];
	$from=$_GET['from'];
	$to=$_GET['to'];
	$country=$_GET['country'];

	$SQL="SELECT id,name,price,currency,description FROM product WHERE name LIKE '%$search%'";
	
	if ($category)
	{
		//$SQL.=" and catId=$category";
	}

	if ($from)
	{
		$SQL.=" and price >= $from";
	}
	
	if ($to)
	{
		$SQL.=" and price <= $to";
	}

	if (!empty($country))
	{
		$SQL.=" and country='$country'";
	}
	//echo $SQL;
	$resultProduct=mysql_query($SQL);
?>

<table border=1 style="width:550px">
	<tr>
		<th></th>
		<th>Product Details</th>
		<th>Price</th>
	</tr>
	
	<?php while ($row=mysql_fetch_array($resultProduct)) {?>
	<tr>
		<td style="width:102px">
			<?php
                                $SQLPic="select url from pics where productId=".$row['id'];
                                $resultPic=mysql_query($SQLPic);
                                if (mysql_num_rows($resultPic))
                                {
                                        $pic1=mysql_fetch_array($resultPic);
                                        echo "<img src='".$pic1['url']."' style='width:100px;height:100px' />";
                                }
                        ?>

		</td>
		<td style="vertical-align:top;">
			<?php 
				echo "<a onClick='showProduct(".$row['id'].")' href='#showProduct=".$row['id']."'>".$row['name']."</a><br/>".substr($row['description'],0,100)."..."; 
			?>
		</td>
		<td style="vertical-align:top;text-align:right">
			<?php echo $row['currency'].$row['price']; ?>
		</td>
	</tr>
	<?php }?>
</table>
