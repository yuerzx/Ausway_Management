<?php
$wordpress_config = dirname(dirname(__FILE__))."/wp-config.php";
require_once($wordpress_config);
require_once 'core_functions.php';


add_action('wp_enqueue_scripts', 'remove_unused_css'); 
function remove_unused_css(){
	wp_deregister_style('avia-base');
	wp_deregister_style('avia-scs' );
	wp_dequeue_style('avia-base');
	wp_dequeue_style( 'avia-scs');
}
?>


