<?php
function install()
{
}
function uninstall()
{
}
register_activation_hook(__FILE__,'install');
register_deactivation_hook( __FILE__, 'uninstall' );
?>
