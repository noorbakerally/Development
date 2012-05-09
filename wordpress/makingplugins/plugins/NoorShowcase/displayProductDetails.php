<?php
/*
Plugin Name: Display Product Details 
Plugin URI:
Description: Displays details of products
Version: 1.0
Author: Noor
Author URI: 
License: GPL
*/
require_once('activation.php');
function display_price()
{
	global $wpdb;
  	$postId=get_the_ID();
        $html="";	
	$customFields=get_post_custom($postId);
	
	if ($customFields['LinkToWebsite'])
	{
		$html.="Link To Website:".$customFields['LinkToWebsite'][0];
	}
	if ($customFields['Price'])
	{
		$html.=$customFields['Currency'][0]." ".$customFields['Price'][0];
	}
	return $html;
}
add_shortcode( 'displayPrice', 'display_price');
?>
