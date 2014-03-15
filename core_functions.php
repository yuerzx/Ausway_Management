<?php

define(SYSTEM_FRAME_WORK,'col-md-7 col-md-offset-2');


function process_bar($process){
    $value = $process*(100/18);
    $value = round($value);
    echo <<<END
    <div class="progress progress-striped active">
    <div class="progress-bar" role="progressbar" aria-valuenow="{$value}" aria-valuemin="0" aria-valuemax="100" style="width: {$value}%;">
    {$value}%
    </div>
    </div>
END;
}

function process_name($process){
    global $wpdb;
    $table_process = $wpdb->prefix.'eazplus_process';
    $process_name = $wpdb->get_var(
        "
        SELECT process_name FROM $table_process WHERE process_id = $process
        "
    );
        if($process_name){
            echo $process_name;
        }


    }

function system_nav($name=null){
    ?>
    <div id="nav" class="col-md-7 col-md-offset-2">
        <ul class="nav nav-pills">
            <li><a href="index.php">Home</a></li>
            <li class ="<?php if($name == 'student') echo 'active'; ?>" ><a href="index.php">Student List</a></li>
            <li class ="<?php if($name == 'agency') echo 'active'; ?>" ><a href="agency_list.php">Agency List</a></li>
            <li class ="<?php if($name == 'sponsor') echo 'active'; ?>" ><a href="sponsor_list.php">Sponsor List</a></li>
        </ul>
    </div>
<?php
}

function agency_name($id){
    if(is_numeric($id)){
        global $wpdb;
        $table_agency = $wpdb->prefix.'eazplus_agency';
        $agency_name = $wpdb -> get_var(
            "
            SELECT agency_name FROM $table_agency WHERE agency_id = $id
            "
        );
        return $agency_name;
    }else{
        echo "error!!";
    }
}
?>