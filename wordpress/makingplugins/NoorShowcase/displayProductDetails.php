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
  	

	//getting the price of the product
	$SQL="select meta_value from wp_postmeta where post_id=$postId and meta_key='Price'";
	$results=$wpdb->get_results($SQL);
	$Price=$results['0'];
	$Price=$Price->meta_value;	

	//getting the currency of the price
	$SQL="select meta_value from wp_postmeta where post_id=$postId and meta_key='Currency'";
        $results=$wpdb->get_results($SQL);
        $Currency=$results['0'];
        $Currency=$Currency->meta_value; 

	$WholePrice= $Currency." ".$Price;
	return $WholePrice;
}
add_shortcode( 'displayPrice', 'display_price');

function display_contact_details()
{


}


?>
