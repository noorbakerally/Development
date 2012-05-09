<?php
	include 'connect.php';
        $sqlCategory="select id,name from category";
        $allCats=mysql_query($sqlCategory);

?>
<form action="" method="POST" onsubmit="return addProduct()">
<table style="height:400px">
	<tr>
		<td>Name</td>
		<td><input type="text" name="name" id="name"/></td>
	</tr>
	<tr>
		<td>Category</td>
		<td>
			<select id="category">
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
			<textarea name="Description" style="width:350px;height:150px"/>
			</textarea>

		</td>
	</tr>
	<tr>
		<td>Currency</td>
		<td>
			<select id="currency">
				<option value="rs">Rs.</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Price</td>
		<td><input type="text" id="price" name="Price" style="width:100px"/></td>
	</tr>
	<tr>
	</tr>
	<tr>
		<td colspan=2>You can upload max 3 pictures for this product</td>
	</tr>
	<tr>
		<td style="vertical-align: top;">Pictures:</td>
		<td><input type="file" /><br/><input type="file" /><br/><input type="file" /></td>
	</tr>
	<tr>
		<td style="text-align:center" colspan=2>
			<br/><br/>
			<input type="submit" value="Save Product" style="font-weight:bold;height: 30px;width: 200px;cursor:pointer">
		</td>
	<tr>
	
</table>
</form>
