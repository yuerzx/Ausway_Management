<?php
include $_SERVER['DOCUMENT_ROOT']."\\21cbb\wp-config.php";

global $wpdb;
$table_students = $wpdb->prefix.'eazplus_student';
$wpdb->show_errors();
 				$student_info = $wpdb->get_row("SELECT * FROM $table_students WHERE student_name = 'Han Sun' ",ARRAY_A);
				echo $student_info['student_name'];
				$fivesdrafts = $wpdb->get_results( 
				"
				SELECT student_name, phone 
				FROM $table_students
				WHERE process != 18
				"
			);

		foreach ( $fivesdrafts as $fivesdraft ) 
		{	
			echo $fivesdraft->student_name.'<br>';
			echo $fivesdraft->phone;

		}

?>
