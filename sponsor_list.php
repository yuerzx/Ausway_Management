<?php
/**
 * Created by PhpStorm.
 * User: yuerzx
 * Date: 8/06/14
 * Time: 8:42 PM
 */

include_once('config.php');
get_header();
system_nav('sponsor');

$xcrud -> table($table_sponsor);
$xcrud -> table_name('雇主列表');
$xcrud -> columns('sponsor_name, middle_man, sponsor_notes, Cases');
$xcrud-> subselect('Cases',"SELECT COUNT(student_id) FROM {$table_student} WHERE sponsor_id = {sponsor_id}");
$xcrud->column_callback('Cases', 'sponsor_links');

function sponsor_links($value, $fieldname, $primary_key, $row, $xcrud){

    return '<a href="cases_list.php?sponsor_id='.$primary_key.'">'.$value.'</a>';
}

?>

<body>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <?= $xcrud->render();?>
    </div>
</div>
</body>