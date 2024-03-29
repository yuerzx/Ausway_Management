<?php
/*
 * Template Name: Student List Page
 * This is the enter page for student management system.
 */
include "config.php";
get_header();

Global $wpdb;
global $table_student;
$students = $wpdb->get_results(
    "
	SELECT *
	FROM $table_student
	WHERE student_process != 18
	", ARRAY_A
);
?>

<div class="row">
    <?php system_nav('student'); ?>
</div>
<div clas="row">

<div class="<?php echo SYSTEM_FRAME_WORK; ?>" style="margin-bottom: 20px;">
    <table class="table table-striped">
            <tr class="success">
                <td>学生姓名</td>
                <td>电话</td>
                <td>邮箱</td>
                <td>签证</td>

                <td>Agency</td>
                <td>Sponsor</td>
                <td>Process</td>
                <td>Last Update</td>
            </tr>
<?php if(isset($students) && !empty($students)):
    foreach($students as $student):?>
            <tr>
                <td><a href="student_details.php?student_id=<?php echo $student['student_id'] ?>"><?php echo $student['student_name'] ?></a></td>
                <td>0<?php echo $student['student_phone'] ?></td>
                <td><?php echo $student['student_email'] ?></td>
                <td><?php echo $student['student_visa'] ?></td>
                <td><a href="agency_details.php?agency_id=<?php echo $student['agency_id'] ?>"><?php echo agency_name($student['agency_id']) ?></a></td>
                <td><?php $sponsor_name = get_name($student['sponsor_id'], 'sponsor'); if(!$sponsor_name) echo '<span style="color:red;">尚未分配<span>';else echo $sponsor_name; ?></td>
                <td><?php process_bar($student['student_process']) ?></td>
                <td><?php echo $student['process_date'] ?></td>
            </tr>


    <?php endforeach; endif; ?>
</table>
    <a href="student_details.php"><button type="button" class="btn btn-primary">Add Student</button></a>
</div></div>



<?php get_footer();?>