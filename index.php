<?php
    include('config.php');
    $xcrud->table($table_student);
    $xcrud->table_name('澳途留学管理系统');
    $xcrud->columns('student_name, student_eng, sponsor_id, agency_id, student_phone, student_visa, student_process, student_steps');
    $xcrud->relation('student_process', $table_process, 'process_id', 'process_name');
    $xcrud->subselect('student_steps',"{student_process}");
    $xcrud->relation('sponsor_id', $table_sponsor, 'sponsor_id', 'sponsor_name');
    $xcrud->relation('agency_id', $table_agency, 'agency_id', 'agency_name');
    $xcrud->change_type('student_visa', 'select', '457','457, 186, 187, 186H' );
    $xcrud->change_type('process_date','date');
    $xcrud->column_callback('student_steps', 'process_bar');
    $xcrud->pass_var('process_date', date('Y-m-d'), 'edit');
    $xcrud->disabled_on_edit('process_date');
    $xcrud->where("$table_student.student_process != 18 ");
    $xcrud->label(array(
        'student_steps'=>'Process',
        'student_name'  =>  'Name',
        'student_eng'   =>  'Eng Name',
        'sponsor_id'    =>  'Sponsor',
        'agency_id'     =>  'Agency',
        'student_phone' =>  'Phone',
        'student_email' =>  'Email',
        'student_visa'  =>  'Visa',
        'student_process'=> 'Steps',
        'student_address'=> 'Address'
    ));

function process_bar($process){
    $value = $process*(100/18);
    $value = round($value);
    return '
    <div class="progress progress-striped active">
    <div class="progress-bar" role="progressbar" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$value.'%;">
    '.$value.'%
    </div>
    </div>';
}

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