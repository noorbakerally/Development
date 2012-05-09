<?php
/*
Plugin Name: Ads Display 
Plugin URI:
Description: Ads Display
Version: 1.0
Author: Noor
Author URI:
License: GPL
*/
function getURL($id)
{
        extract(shortcode_atts(array('id' => 'id'), $id));
        $URL="http://localhost/adsmgt/getAdd.php";
        if ($id!="id")
        {
           $hit=apc_exists("id");
           if (!$hit)
           {
                $URL.="?id=".$id;
                $content=file_get_contents($URL);
                
		$content=explode("<href>",$content);

		$currentId=array("img"=>$content[0],"href"=>$content[1]);
		$ids[$id]=$currentId;	

		apc_store("id", $ids);

		//create an index on array to store impr and store set num time to 0
		if (!apc_exists("impr"))
		{
			$impr[$id]=0;
			apc_store("impr", $impr);
		}
		$content=$content[0];
	   }
           else
           {

                $ids=apc_fetch("id");
		if (empty($ids[$id]))
		{
			$content=file_get_contents($URL);
                	$content=explode("<href>",$content);
                	$ids[$id]=array("img"=>$content[0],"href"=>$content[1]);
			apc_store("id", $ids);
			$content=$content[0];
		}
		else
		{
			$idContent=$ids[$id];
			$content=$idContent['img'];
		}
		
		if (apc_exists("impr"))
                {
                        $impr=apc_fetch("impr");
                        if (!empty($impr[$id])) $impr[$id]++;
			else $impr[$id]=1;
			apc_store("impr", $impr);
                }
		else
		{	
			$impr[$id]=0;
                        apc_store("impr", $impr);
		}
           }
        }
        else
        {
                $content=explode("<href>",file_get_contents($URL));
		$content=$content[0];
        }
        return $content;
}
add_shortcode( 'getImg', 'getURL');
?>
