<?php
/*
Plugin Name: Display a form to add a product 
Plugin URI:
Description: 
Version: 1.0
Author: Noor
Author URI:
License: GPL
*/


$url=WP_PLUGIN_DIR.'/nextgen-gallery/admin/functions.php';
include $url;

function show_add_Product()
{

	global $wpdb, $ngg, $nggdb;
	if(!empty($_POST['submit'])) 
	{
		$_POST['galleryselect']=1;
		nggAdmin::upload_images();
	 	//$imagefiles = $_FILES['imagefiles'];

		/*	
		$title=$_POST['productName'];
		$content=$_POST['description']."<br/>[displayPrice]";
		$linkToWebSite=$_POST['linkWebSite'];
		$currency=$_POST['currency'];
		$price=$_POST['price'];
		$Image1=$_FILES['image1'];
		$Image2=$_FILES['image2'];
		$Image3=$_FILES['image3'];
		$Image4=$_FILES['image4'];
		$postType='post';
		$post = array('post_title' =>$title,'post_content' =>$content,'post_type' => $postType,'post_status' =>'publish' );
         	$newPostId=wp_insert_post( $post, $wp_error );
		if (!empty($linkToWebSite)) add_post_meta($newPostId, 'LinkToWebsite', $linkToWebSite);
		add_post_meta($newPostId, 'Price', $price, false);
		add_post_meta($newPostId, 'Currency', $currency, false);
		*/
		//creating gallery
		/*
       			$defaultpath = $ngg->options['gallerypath'];
        		$newgallery = esc_attr("Test");
        		nggAdmin::create_gallery($newgallery, $defaultpath);
			nggAdmin::upload_images();
	

		*/
	} 
	else {?>
	<form enctype="multipart/form-data" action="" method="POST">
		Product Name: <br/><input type="text" name="productName" size="60"/><br/>
		<br/>Description:<br/>
		<textarea name="description" rows="10" cols="70"></textarea><br/>

		<br/>
		Link to Website: <br/><input type="text" name="linkWebSite" size="60"/><br/>
			
		<br/>
		Price: 
		<br/>
			<select name="currency">
				<option value="Rs.">Rs</option>
			</select>
			<input type="text" name="price" size="10"/>
		<br/>	
		<br/>Upload Featured Image: <input name="imagefiles[]" type="file" /><br/>
		<br/>Upload Gallery Image 1: <input name="imagefiles[]" type="file" /><br/>
		<br/>Upload Gallery Image 2: <input name="imagefiles1" type="file" /><br/>
		<br/>Upload Gallery Image 3: <input name="imagefiles1" type="file" /><br/>
		
		<br/>

		<br/>
		<select name="category0">
			<option></option>
		</select>

		<?php wp_list_categories(); ?>

		<br/><input type="submit" name="submit" value="Add Product" />

	</form>

<?php
}
	return "";
}
add_shortcode( 'addProduct', 'show_add_Product');
?>

