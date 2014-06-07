<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 14-2-16
 * Time: 下午6:46
 */
require_once 'config.php';

function get_student_list($agency_id){
    global $wpdb;
    global $table_student;
    $agency = $wpdb->get_results(
        "
        SELECT student_id, sponsor_id FROM $table_student WHERE agency_id = $agency_id
        ", ARRAY_A
    );
    return $agency;
}


function formsubmit(){
	if ( !isset($_POST['agency_information_nonce']) || !wp_verify_nonce($_POST['agency_information_nonce'],'add_agency_information') ){
		return 0;
	}else{
		if(isset($_POST['agency_name']) && !empty($_POST["agency_name"])){return 1;}
	}
}
function formhide(){
	//function use to hide forms. 
	if(formsubmit()){return hidden;}else{ return visable;}}

if(formsubmit()){
	if(isset($_GET) && !empty($_GET['agency_id'])){
		//if we have set the agency id, then we need to update the record rather than creat one. 
		if(update_agency($_POST)){
		echo "You have successful update agencys information. <br>";
		echo "Get back to submit more information.<a href='#'>Back</a>";
		wp_redirect('agency_list.php',302);
		}else{
		echo "The agencys has been existed! Please do not re-add it! Thanks ";
		}
	}else{
		if(add_new_agency($_POST)){
		echo "You have successful add agencys information. <br>";
		echo "Get back to submit more information.<a href='#'>Back</a>";
		wp_redirect('agency_list.php',302);
		}else{
		echo "The agencys has been existed! Please do not re-add it! Thanks ";
		}
	}

};


if(isset($_GET) && !empty($_GET['agency_id'])):
    global $wpdb;
    global $table_agency;
    $agency_id = $_GET['agency_id'];
    $agency = $wpdb->get_row(
        "
        SELECT * FROM $table_agency WHERE agency_id = $agency_id
        ", ARRAY_A
    );
else:
	$agency = array();
endif;
	//get header and other information ready. 
	get_header();
	system_nav(); ?>
<div id="main" class="container-fluid">
	<div id="form" class="row">
    <div class="col-md-6 col-md-offset-2 text-center"><h2>中介信息详情页面</h2></div>
	<div class="col-md-6 col-md-offset-2">
	<form role="form" action="" method="post" class="form">
	<div class="form-group" style="display:none;">
    	<label for="agency_id" class="control-label">Agency ID</label>
    	<input type="muber" class="form-control" id="agency_id" name="agency_id" value="<?php echo $agency['agency_id'] ?>">
  	</div>
  	<div class="form-group">
    	<label for="agency_name" class="control-label">Agency Name (First Last)</label>
    	<input type="text" class="form-control" id="agency_name" name="agency_name" value="<?php echo $agency['agency_name'] ?>" required>
  	</div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="agency_email" value="<?php echo $agency['agency_email'] ?>">
  </div>
  <div class="form-group">
    <label for="agency_phone">Phone Number</label>
    <input type="number" class="form-control" id="agency_phone" value="<?php echo $agency['agency_phone'] ?>" name="agency_phone">
  </div>
  <div class="form-group">
      <label for="textarea">备注：</label>
      <textarea name="notes" id="textarea" class="form-control" rows="3"><?= $agency['agency_notes']?></textarea>
  </div>
      <?php wp_nonce_field('add_agency_information','agency_information_nonce'); ?>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div></div>
    <div class="col-md-6 col-md-offset-2" style="padding-top: 15px;">
        <div><h4>Cases</h4>
        <table class="table table-hover">
        <thead><tr><td>Student Name</td><td>Sponsor Name</td></tr></thead>
        <?php $student_lists = get_student_list($_GET['agency_id']);
        foreach ($student_lists as $student_list){ ?>
         <tr><td><a href="student_details.php?student_id=<?= $student_list['student_id'] ?>">
                 <?= get_name($student_list['student_id'], 'student'); ?></a> </td>
             <td><a href="sponsor_details.php?sponsor_id=<?= $student_list['student_id'] ?>">
                 <?= get_name($student_list['sponsor_id'], 'sponsor'); ?></a></td>
         </tr>
        <?php } ?>
        </table>
        </div>
    </div>
</div>


