<?php
include 'config.php';

get_header();

Global $wpdb;
$table_agency = $wpdb->prefix.'eazplus_agency';
$agencys = $wpdb->get_results(
    "
	SELECT *
	FROM $table_agency
	", ARRAY_A
);
?>

<div class="row">
    <?php system_nav(agency); ?>
</div>
<div clas="row">

    <div class="<?php echo SYSTEM_FRAME_WORK; ?>">
        <table class="table table-striped">
            <tr class="success">
                <td>中介姓名</td>
                <td>电话</td>
                <td>邮箱</td>
                <td>详情</td>

            </tr>
            <?php if($agencys):
                foreach($agencys as $agency):?>
                    <tr>
                        <td><a href="agency_details.php?agency_id=<?php echo $agency['agency_id'] ?>"><?php echo $agency['agency_name'] ?></a></td>
                        <td><?php echo $agency['agency_phone'] ?></td>
                        <td><?php echo $agency['agency_email'] ?></td>
                        <td></td>
                    </tr>


                <?php endforeach; endif; ?>
        </table>
        <a href="agency_form.php"><button type="button" class="btn btn-primary">Add Agency</button></a>
    </div></div>
