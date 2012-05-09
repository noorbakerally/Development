<?php
        include 'connect.php';
        //getting all ads from the database
        $result=mysql_query("select * from ads");
        if ($_POST['UploadAdds'])
        {
                $name=$_POST['name'];
		$href=$_POST['href'];
                if ($_FILES["file"]["error"] > 0)
                {
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                }
                else
                {
                        $url="ads/" . $_FILES["file"]["name"];
                        move_uploaded_file($_FILES["file"]["tmp_name"],$url);
                }
		
                $SQL="INSERT INTO ads (name,url,href,clicks,impr) values ('$name','$url','$href',0,0)";
		mysql_query($SQL,$con);
        }
        else if ($_POST['removeAdds'])
        {
                $id=$_POST['id'];
		$SQL="select url from ads where id=$id";
		
		$result=mysql_query($SQL);
		$row=mysql_fetch_array($result);
		unlink($row['url']);		
		$SQL="DELETE FROM ads where id=$id;";
                mysql_query($SQL,$con);
        }
?>
<html>
	<head>
		<title>K7 adds Management</title>
	</head>
	<body>
		<table width="500px" border="1">
			<tr>
				<th>id</th>
				<th>name</th>
				<th>url</th>
				<th>href</th>
				<th>clicks</th>
				<th>impr</th>
			</tr>
			<tr>
				
				<form method="post" enctype="multipart/form-data" action="">	
					<td></td>
					<td><input type="text" name="name"/></td>
					<td><input type="file" name="file"></td>
					<td><input type="text" name="href"/></td>
					<td></td>
					<td></td>
					<td><input type="submit" name="UploadAdds" value="Upload Ads"></td>
				</form>
			</tr>
			<?php while ($row=mysql_fetch_array($result)) { ?>
				<tr>
					<form method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['url']; ?></td>
						<td><?php echo $row['href']; ?></td>
						<td><?php echo $row['clicks']; ?></td>
						<td><?php echo $row['impr']; ?></td>
						<td><input type="submit" name="removeAdds" value="delete" style="width:86px"></td>
					</form>
                        	</tr>
			<?php } ?>
		</table>
	</body>
</html>
