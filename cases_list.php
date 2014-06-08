<?php
/**
 * Created by PhpStorm.
 * User: yuerzx
 * Date: 8/06/14
 * Time: 9:29 PM
 */

include('config.php');

if (isset($_GET) and !empty($_GET)){
    if (!empty($_GET['agency_id'])){
        $agency_id = mysql_real_escape_string($_GET['agency_id']);
    }elseif(!empty($_GET['sponsor_id'])){
        $sponsor_id = mysql_real_escape_string($_GET['sponsor_id']);
    }else{
        echo "There is a error and please check it!";
        wp_redirect('/index.php', 302);
    }
}
get_header();
system_nav('home');

$xcrud ->table($table_student);
if(!empty($agency_id) and isset($agency_id)){
    $xcrud -> where("$table_student.agency_id = $agency_id ");
}elseif(!empty($sponsor_id) and isset($sponsor_id)){
    $xcrud -> where("$table_student.sponsor_id = $sponsor_id ");
}
$xcrud->relation('sponsor_id', $table_sponsor, 'sponsor_id', 'sponsor_name');
$xcrud->relation('agency_id', $table_agency, 'agency_id', 'agency_name');

?>
<body>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
<?=  $xcrud->render(); ?>
    </div>
</div>
</body>