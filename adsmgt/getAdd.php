<?php
        include 'connect.php';
        $id=$_GET['id'];
        $prefix="http://localhost/adsmgt/";
        if (empty($id))
        {
                $SQL="select url,id,href from ads ORDER BY RAND() LIMIT 1";
        }
        else
        {
                $SQL="select url,id,href from ads where id=$id";
        }
        $result=mysql_query($SQL);
        $row=mysql_fetch_array($result);
        $id=$row['id'];

	//incrementing impr for the first time from here
        $SQL_Update_impr="UPDATE ads SET impr=impr+1 where id=".$id;
        mysql_query($SQL_Update_impr);

        $href=$prefix."exec.php?id=".$id;
        $url=$row['url'];
        $img_src=$prefix.$row[0];
        echo "<a href=$href><img id='noortest' src='$img_src' width='300' height='250'/></a><href>".$row['href'];
?>
