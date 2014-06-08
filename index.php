<?php
    include('config.php');
    $xcrud->table($table_student);
    $xcrud->table_name('澳途留学管理系统');
    $xcrud->columns('student_name, sponsor_id, agency_id, student_phone, student_email, student_visa, student_process, student_steps');
    // $xcrud->relation('student_process', $table_process, 'process_id', 'process_name');
    $xcrud->subselect('student_steps',"SELECT process_name FROM $table_process WHERE process_id = {student_process}");
    $xcrud->relation('sponsor_id', $table_sponsor, 'sponsor_id', 'sponsor_name');
    $xcrud->relation('agency_id', $table_agency, 'agency_id', 'agency_name');
    $xcrud->change_type('student_visa', 'select', '457','457, 186, 187, 186H' );
    $xcrud->change_type('process_date','timestamp');
    $xcrud->column_callback('student_process', 'process_bar');

get_header();
?>

<body>
<?php system_nav('home'); ?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
<?php
    echo $xcrud->render();
?>
    </div>
</div>
</body>
</html>