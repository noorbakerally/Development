<?php
	include 'connect.php';
        include 'countryList.php';
	$sqlCategory="select id,name from category";
        $allCats=mysql_query($sqlCategory);

?>
<form action="addProduct.php" method="POST" onsubmit="return addProduct()" target="ifrmAddProd" enctype="multipart/form-data">
<table style="height:400px">
	<tr>
		<td>Name</td>
		<td><input type="text" name="name" id="name"/></td>
	</tr>
	<tr>
		<td>Category</td>
		<td>
			<select id="category" name="category">
				<option value="0">Select a category</option>
				<?php
					while ($row=mysql_fetch_array($allCats))
					{
						echo "<option value=".$row['id'].">".$row['name']."</option>";
					}
				?>
                        </select>
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;">Description</td>
		<td>
			<textarea name="description" style="width:350px;height:150px"/>
			</textarea>

		</td>
	</tr>
	<tr>	
		<td>Country</td>
		<td>
			<select id="country" name="country">
				<option value="Mauritius">Mauritius</option>
				<?php
					foreach ($countries as $country)
					{
						echo "<option value='$country'>$country</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Currency</td>
		<td>
			<select id="currency" name="currency">
			<?php
				$sqlCurrency="select currency from currency";
        			$resultCurrency=mysql_query($sqlCurrency);
				while ($row=mysql_fetch_array($resultCurrency))
				{	
			?>
				<option value="<?php echo $row['currency'];?>"><?php echo $row['currency'];?></option>

			<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Price</td>
		<td><input type="text" id="price" name="price" style="width:100px"/></td>
	</tr>
	<tr>
	</tr>
	<tr>
		<td colspan=2>You can upload max 3 pictures</td>
	</tr>
	<tr>
		<td style="vertical-align: top;">Pictures:</td>
		<td><input type="file" name="file1" /><br/><input type="file" name="file2" /><br/><input type="file" name="file3" /></td>
	</tr>
	<tr>
		<td style="text-align:center" colspan=2>
			<br/><br/>
			<input type="submit" value="Save Product" style="font-weight:bold;height: 30px;width: 200px;cursor:pointer">
		</td>
	<tr>
	
</table>
</form>
<iframe name="ifrmAddProd" style="display:none"></iframe>
