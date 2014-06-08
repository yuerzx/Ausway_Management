<?php

define(SYSTEM_FRAME_WORK,'col-md-7 col-md-offset-2');
security_check();



function security_check(){
	if(is_user_logged_in()){
		global $current_user;
		get_currentuserinfo();
		switch ($current_user->user_login) {
			case 'yuerzx':
			case 'patrick':
			case 'howard':
			case 'yuer':
			break;
			default:
				wp_die('Sorry, you must first <a href="'.get_site_url().'/wp-login.php">log in</a> to view this page. 
				You need to have a access to this page.');
			break;
		}
	}else{
		wp_die('Sorry, you must first <a href="'.get_site_url().'/wp-login.php">log in</a> to view this page. 
			You need to have a access to this page.');
}
}


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
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <div id="nav" class="col-md-7 col-md-offset-2">
        <ul class="nav nav-pills">
            <li class ="<?php if($name == 'home') echo 'active'; ?>"><a href="index.php">Home</a></li>
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

function get_name($id,$category){
    /* TODO finish up this part */
    if(is_numeric($id)){
        global $wpdb;
        $table = $wpdb->prefix.'eazplus_'.$category;
        $cat_id = $category."_id";
        $name = $category."_name";
        $result_name = $wpdb -> get_var(
            "
            SELECT $name FROM $table WHERE $cat_id = $id
            "
        );
        return $result_name;
    }else{
        echo "error!!";
    }
}

function get_list($category){
    global $wpdb;
    $table = $wpdb->prefix.'eazplus_'.$category;
    $id = $category."_id";
    $name = $category."_name";
    $results = $wpdb->get_results(
        "
        SELECT $id, $name
        FROM $table
        ", ARRAY_A
        );
        return $results;
}

function add_new_student($information){
    echo "I am the process<br>"; 
    /*
    Add new students into database. 
    All the process is all done by wordpress in the safer ways.
    Add time filers
    */
    echo $information["student_name"];
    if(empty($information['date'])) {$date = date('Y-m-d');}else{
        $date = date_create($information["date"]);
        $date = date_format($date, 'Y-m-d');
    }
    global $wpdb;
    global $table_student;
    $student_insert_pre = array(
        'student_name'          => $information["student_name"],
        'student_email'         => $information["student_email"],
        'student_phone'         => $information["student_phone"],
        'student_visa'          => $information["student_visa"],
        'student_process'       => $information["process"],
        'process_date'          => $date,
        'agency_id'             => $information["agency_id"],
        'sponsor_id'            => $information["sponsor_id"],
        'student_notes'         => $information["notes"]
    );
    $student_insert_format = array( 
        '%s', 
        '%s', 
        '%d',
        '%d',
        '%d',
        '',
        '%d',
        '%d',
        '%s'
    );
    $wpdb->show_errors();
    //If error what we return
    if(!$wpdb->insert( $table_student,$student_insert_pre,$student_insert_format)) {return false;}else{return true;}

}

function update_student($information){
    /*
    Update students information in database. 
    All the process is all done by wordpress in the safer ways.
    Add time filers
    */
    if(empty($information['date'])) {$date = date('Y-m-d');}else{
        $date = date_create($information["date"]);
        $date = date_format($date, 'Y-m-d');
    }
    global $wpdb;
    global $table_student;
    $student_id = $information["student_id"];
    
    $student_insert_pre = array(
        'student_name'          => $information["student_name"],
        'student_email'         => $information["student_email"],
        'student_phone'         => $information["student_phone"],
        'student_visa'          => $information["student_visa"],
        'student_process'       => $information["process"],
        'process_date'          => $date,
        'agency_id'             => $information["agency_id"],
        'sponsor_id'            => $information["sponsor_id"],
        'student_notes'         => $information["notes"]
    );
    $student_insert_format = array( 
        '%s', 
        '%s', 
        '%d',
        '%d',
        '%d',
        '',
        '%d',
        '%d',
        '%s'
    );
    $wpdb->show_errors();
    //If error what we return
    if(!$wpdb->update( 
        $table_student,
        $student_insert_pre,
        array('student_id' => $student_id),
        $student_insert_format, 
        array( '%d' )))
        {return false;
    }else{
        return true;}

}

?>