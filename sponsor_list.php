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
$xcrud -> columns('sponsor_name, middle_man, Cases');
$xcrud -> subselect('Cases',"SELECT COUNT(student_id) FROM {$table_student} WHERE sponsor_id = {sponsor_id}");
$xcrud -> column_callback('Cases', 'sponsor_links');
$xcrud -> label(array(
    'sponsor_name'  =>  'Company Name',
    'middle_man'    =>  'Middle Man',
    'sponsor_notes' =>  'Notes'
));



?>

<body>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <?= $xcrud->render();?>
    </div>
</div>
</body>