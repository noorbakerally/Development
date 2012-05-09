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
        $URL="http://localhost/adsManagement/getAdd.php";
        if ($id!="id")
        {
           $hit=apc_exists($id);
           if (!$hit)
           {
                $URL.="?id=".$id;
                $content=file_get_contents($URL);
                apc_store($id, $content);
           
		//create an index on array to store impr and store set num time to 0
		if (!apc_exists("impr"))
		{
			$impr[$id]=0;
			apc_store("impr", new ArrayObject($impr));
		}
	   }
           else
           {

                $content=apc_fetch($id);
		if (apc_exists("impr"))
                {
                        $impr=apc_fetch("impr");
                        $impr[$id]=$impr[$id]+1;
			apc_store("impr", new ArrayObject($impr));
                }
           }
        }
        else
        {
                $content=file_get_contents($URL);
        }
        return $content;
}
add_shortcode( 'getImg', 'getURL');
?>
