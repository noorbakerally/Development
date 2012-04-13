<?php
/*
Plugin Name: Add Document Type Styles
Plugin URI: http://springthistle.com/wordpress/plugin_doctypes
Description: Detects URLs in your post and page content and applies
style to those that link to documents so as to identify the document
type. Includes support for: pdf, doc, mp3 and zip.
Version: 1.0
Author: April Hodge Silver
Author URI: http://springthistle.com
*/

function ahs_doctypes_regex($text) 
{
	 $types = ereg_replace(',[:space:]*','|',$types);
	 $text = ereg_replace('href=([\'|"][[:alnum:]|[:punct:]]*)\.(pdf|doc|mp3|zip)([\'|"])','href=\\1.\\2\\3 class="link \\2"',$text);
	 return $text;
}

function ahs_doctypes_styles()
{
	 echo "<!-- for the plugin Document Type Styles -->\n";
	 echo "<style>\n.link { background-repeat: no-repeat; padding: 2px0 2px 20px; }\n";
	 echo ".pdf { background-image: url('".WP_PLUGIN_URL."/ahs_doctypes_styles/pdf.png'); }\n";
	 echo ".doc { background-image: url('".WP_PLUGIN_URL."/ahs_doctypes_styles/doc.gif'); }\n";
}
function set_supportedtypes_options()
{
   add_option("ahs_supportedtypes","pdf,doc,mp3,zip");
}
function unset_supportedtypes_options ()
{
   delete_option("ahs_supportedtypes");
}
add_filter('the_content', 'ahs_doctypes_regex');
add_action('wp_head', 'ahs_doctypes_styles');
?>

