<?php

function install()
{

}
function uninstall()
{

}
function create_post_type() {
	register_post_type( 'acme_product',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'products')
		)
	);
}

add_action( 'init', 'create_post_type' );
register_activation_hook(__FILE__,'install');
register_deactivation_hook( __FILE__, 'uninstall' );
?>
