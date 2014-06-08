<?php
/**
 * Created by PhpStorm.
 * User: yuerzx
 * Date: 8/06/14
 * Time: 8:25 PM
 */

include_once('config.php');
get_header();
system_nav('agency');

$xcrud -> table($table_agency);
$xcrud -> table_name('中介列表');
$xcrud -> columns('agency_name, agency_company, agency_phone, agency_email, agency_notes, Cases');
$xcrud-> subselect('Cases',"SELECT COUNT(student_id) FROM {$table_student} WHERE agency_id = {agency_id}");
$xcrud->column_callback('Cases', 'agency_links');

function agency_links($value, $fieldname, $primary_key, $row, $xcrud){

    return '<a href="cases_list.php?agency_id='.$primary_key.'">'.$value.'</a>';
}

?>

<body>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
<?= $xcrud->render();?>
    </div>
</div>
</body>