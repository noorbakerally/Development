<?php
	include 'connect.php';
	$sqlCategory="select id,name from category";
	$allCats=mysql_query($sqlCategory);
	
?>
<html>
	<head>
		
		<script src="client/ajax.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
		<link rel="stylesheet" href="client/style.css" />
	</head>
	<body style="position:relative">
		<div id="mainSearchBox">
			<table style="background-color:#D8DFEA;"> 
				<tr>
					<td>Search</td>
					<td>Category</td>
					<td>Price:From</td>
					<td>To<td/>
					<td></td>
				</tr>
				<tr>
					<td><input type="text" size=25 /></td>
					<td>
					    <select>
						<option value="0">Select a category</option>
						<?php
							while ($row=mysql_fetch_array($allCats))
							{
								echo "<option value=".$row['id'].">".$row['name']."</option>";
							}
						?>

					    </select>
					</td>
					<td><input type="text" size=10/></td>
					<td><input type="text" size=10/></td>
					<td>
						<input type="button" id="mainSearch" style="width:150px" value="Search"/>
					</td>
				</tr>
			<table>    
                </div>     
		<div id="sidebar">
			<a href="#" onClick="showAddProductForm();" style="text-decoration:none"><div class="sidebarItems">Add Product</div></a>
			<?php
                                $allCats=mysql_query($sqlCategory);
				while ($row=mysql_fetch_array($allCats))
				{
					echo "<div class='sidebarItems'>".$row['name']."</div>";
				}
			?>			
		</div>
		<div id="content">
			<div id="titleContent"></div>
			<div id="mainContent"></div>
		</div>
	</body>
</html>
