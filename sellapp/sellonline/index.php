<?php
	include 'connect.php';
	include 'countryList.php';
	$sqlCategory="select id,name from category";
	$allCats=mysql_query($sqlCategory);	
?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script src="client/ajax.js"></script>
		<link rel="stylesheet" href="client/style.css" />
		<link rel="stylesheet" href="client/fancy/source/jquery.fancybox.css?v=2.0.6" type="text/css" media="screen" />
		<script type="text/javascript" src="client/fancy/source/jquery.fancybox.pack.js?v=2.0.6"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				showProduct(30);
			});

		</script>


	</head>
	<body style="position:relative">
		Choose your country:
		<select name="country" id="country">
			<option value="Mauritius">Mauritius</option>
			<?php
				foreach ($countries as $country)
				{
					echo "<option value='$country'>$country</option>";
				}
			?>
		</select>	
		<br/><br/>
		<div id="mainSearchBox">
			<table style="background-color:#D8DFEA;"> 
				<tr>
					<td>Search</td>
					<td>Category</td>
					<td>Price:From</td>
					<td>To</td>
					<td></td>
				</tr>
				<tr>
					<td><input id="search" name="search" type="text" size=35 /></td>
					<td>
					    <select name="category" id="category">
						<option value="0">Category</option>
						<?php
							while ($row=mysql_fetch_array($allCats))
							{
								echo "<option value=".$row['id'].">".$row['name']."</option>";
							}
						?>

					    </select>
					</td>
					<td><input type="text" size=10 name="from" id="from"/></td>
					<td><input type="text" size=10 name="to" id="to" /></td>
					<td colspan='5' style="text-align:center">
						<input type="button" id="mainSearch" style="width:100px" value="Search" onClick="showProducts();"/>
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
					echo "<div class='sidebarItems' onClick='showCatProduct(\"".$row["id"]."\")'>".$row['name']."</div>";
				}
			?>			
		</div>
		<div id="content">
			<div id="titleContent"></div>
			<div id="mainContent"></div>
		</div>
	</body>
</html>
