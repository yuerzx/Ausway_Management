<?php
/*
 * Template Name: Student List Page
 * This is the enter page for student management system.
 */
include "config.php";
get_header();

Global $wpdb;
$table_sporonship = $wpdb->prefix.'eazplus_sponsor';
$sponsors = $wpdb->get_results(
    "
	SELECT *
	FROM $table_sporonship
	", ARRAY_A
);

?>

<div class="row">
    <?php system_nav('sponsor'); ?>
</div>
<div clas="row">

<div class="<?php echo SYSTEM_FRAME_WORK; ?>" style="margin-bottom: 20px;">
    <table class="table table-striped">
            <tr class="success">
                <td>雇主姓名</td>
                <td>Agency</td>
                <td>Student</td>
            </tr>
<?php if(isset($sponsors) && !empty($sponsors)):
    foreach($sponsors as $sponsor):?>
            <tr>
                <td><a href="sponsor_details.php?sponsor_id=<?php echo $sponsor['sponsor_id'] ?>"><?php echo $sponsor['sponsor_name'] ?></a></td>
                <td><?php echo get_name($sponsor['agency_id'], 'agency') ?></td>
                <td><?php echo get_name($sponsor['student_id'], 'student') ?></td>
            </tr>
    <?php endforeach; endif; ?>
</table>
    <a href="sponsor_details.php"><button type="button" class="btn btn-primary">Add Spsonsor</button></a>
</div></div>
<?php get_footer();?>


