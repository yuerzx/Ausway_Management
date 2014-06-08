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

$table_student = $wpdb->prefix.'eazplus_student';
$table_attachments = $wpdb->prefix.'eazplus_attachments';
$table_sponsor = $wpdb->prefix.'eazplus_sponsor';
$table_agency = $wpdb->prefix.'eazplus_agency';
$table_process = $wpdb->prefix.'eazplus_process';
global $table_student;
global $table_agency;
global $table_sponsor;
?>


