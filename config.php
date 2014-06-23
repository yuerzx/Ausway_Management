<?php
$wordpress_config = dirname(dirname(__FILE__))."/wp-config.php";
require_once($wordpress_config);
require_once('core_functions.php');
include('xcrud/xcrud.php');

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
global $table_process;



$xcrud = Xcrud::get_instance();
$xcrud->unset_csv();
#hide edit button for Howard and Patrick
global $current_user;
get_currentuserinfo();
if(!($current_user->user_login == "yuerzx" or $current_user->user_login == "yuer" or $current_user->user_login == "ausway")) {
	$xcrud->unset_remove();
}
?>


