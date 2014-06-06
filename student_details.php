<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 14-2-16
 * Time: 下午6:46
 */
require_once 'config.php';


function formsubmit(){
	if ( !isset($_POST['student_information_nonce']) || !wp_verify_nonce($_POST['student_information_nonce'],'add_student_information') ){
		return 0;
	}else{
		if(isset($_POST['student_name']) && !empty($_POST["student_name"])){return 1;}
	}
}
function formhide(){
	//function use to hide forms. 
	if(formsubmit()){return hidden;}else{ return visable;}}

if(formsubmit()){
	if(isset($_GET) && !empty($_GET['student_id'])){
		//if we have set the student id, then we need to update the record rather than creat one. 
		if(update_student($_POST)){
		echo "You have successful update students information. <br>";
		echo "Get back to submit more information.<a href='#'>Back</a>";
		wp_redirect('student_list.php',302);
		}else{
		echo "The students has been existed! Please do not re-add it! Thanks ";
		}
	}else{
		if(add_new_student($_POST)){
		echo "You have successful add students information. <br>";
		echo "Get back to submit more information.<a href='#'>Back</a>";
		wp_redirect('student_list.php',302);
		}else{
		echo "The students has been existed! Please do not re-add it! Thanks ";
		}
	}

};


if(isset($_GET) && !empty($_GET['student_id'])):
    global $wpdb;
    $table_students = $wpdb->prefix.'eazplus_students';
    $student_id = $_GET['student_id'];
    $student = $wpdb->get_row(
        "
        SELECT * FROM $table_students WHERE student_id = $student_id
        ", ARRAY_A
    );
else:
	$student = array();
endif;
	//get header and other information ready. 
	get_header();
	system_nav(); ?>
<div id="main" class="container-fluid">
	<div id="form" class="row">
    <div class="col-md-6 col-md-offset-2 text-center"><h2>学生信息详情页面</h2></div>
	<div class="col-md-6 col-md-offset-2">
	<form role="form" action="" method="post" class="form">
	<div class="form-group" style="display:none;">
    	<label for="student_id" class="control-label">Student ID</label>
    	<input type="muber" class="form-control" id="student_id" name="student_id" value="<?php echo $student['student_id'] ?>">
  	</div>
  	<div class="form-group">
    	<label for="student_name" class="control-label">Student Name (First Last)</label>
    	<input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo $student['student_name'] ?>" required>
  	</div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="student_email" value="<?php echo $student['student_email'] ?>">
  </div>
  <div class="form-group">
    <label for="student_phone">Phone Number</label>
    <input type="number" class="form-control" id="student_phone" value="<?php echo $student['student_phone'] ?>" name="student_phone">
  </div>
  <div class="radio-inline">
  <label>
    <input type="radio" name="student_visa" id="visa" value="187" <?php if($student['student_visa']=='187') echo "checked"; ?>>
    187 Visa
  </label>
</div>
  <div class="radio-inline">
  <label>
    <input type="radio" name="student_visa" id="visa" value="186" <?php if($student['student_visa']=='186') echo "checked"; ?>>
    186 Visa
  </label>
</div>
  <div class="radio-inline">
  <label>
    <input type="radio" name="student_visa" id="visa" value="457" <?php if($student['student_visa']=='457') echo "checked"; ?>>
    457 Visa
  </label>
</div>
     <div class="form-group">
      <label for="process">进度</label>
      <select name="process" id="process" class="form-control">
        <option value="1"  <?php if($student['student_process'] == 1) echo 'selected'; ?>>Start to prepare documents</option>
        <option value="2"  <?php if($student['student_process'] == 2) echo 'selected'; ?>>Publishing Ads</option>
        <option value="3"  <?php if($student['student_process'] == 3) echo 'selected'; ?>>Sporonship Prepare</option>
        <option value="4"  <?php if($student['student_process'] == 4) echo 'selected'; ?>>Sporonship Submitted</option>
        <option value="5"  <?php if($student['student_process'] == 5) echo 'selected'; ?>>Sporonship Docuemtns Required</option>
        <option value="6"  <?php if($student['student_process'] == 6) echo 'selected'; ?>>Sporonship Approval</option>
        <option value="7"  <?php if($student['student_process'] == 7) echo 'selected'; ?>>Sporonship Failed</option>
        <option value="8"  <?php if($student['student_process'] == 8) echo 'selected'; ?>>Nomination prepare</option>
        <option value="9"  <?php if($student['student_process'] == 9) echo 'selected'; ?>>Nomination submitted</option>
        <option value="10" <?php if($student['student_process'] == 10) echo 'selected'; ?>>Nomination Docuemtns Required</option>
        <option value="11" <?php if($student['student_process'] == 11) echo 'selected'; ?>>Nomination approval</option>
        <option value="12" <?php if($student['student_process'] == 12) echo 'selected'; ?>>Nomination Failed</option>
        <option value="13" <?php if($student['student_process'] == 13) echo 'selected'; ?>>Visa Application Prepare</option>
        <option value="14" <?php if($student['student_process'] == 14) echo 'selected'; ?>>Visa Application Submit</option>
        <option value="15" <?php if($student['student_process'] == 15) echo 'selected'; ?>>Visa Application Docuemtns Required</option>
        <option value="16" <?php if($student['student_process'] == 16) echo 'selected'; ?>>Visa Application Approval</option>
        <option value="17" <?php if($student['student_process'] == 17) echo 'selected'; ?>>Visa Application Failed</option>
        <option value="18" <?php if($student['student_process'] == 18) echo 'selected'; ?>>Deal Closed</option>
      </select>
      Process: <?php process_bar($student['student_process']) ?>
      </div>
      <div class="form-group">
      <label for="agency">中介</label>
      <select name="agency_id" id="agency" class="form-control">
          <option value="0">尚未指定</option>
          <?php 
          $agencies = get_list('agency'); 
          foreach ($agencies as $agency) {      	
          		?> <option value="<?php echo $agency['agency_id']; ?>" <?php if($student['agency_id'] == $agency['agency_id']) echo 'selected'; ?> > <?=$agency['agency_name']; ?> </option>
          <?php } ?>
      </select>
      </div>
      <div class="form-group">
      <label for="sponsor_id">雇主</label>
      <select name="sponsor_id" id="sponsor" class="form-control">
          <option value="0">尚未指定</option>
          <?php 
          $sponsors = get_list('sponsor'); 
          foreach ($sponsors as $sponsor) {      	
          		?> <option value="<?php echo $sponsor['sponsor_id']; ?>" <?php if($student['sponsor_id'] == $sponsor['sponsor_id']) echo 'selected'; ?>> <?= $sponsor['sponsor_name']; ?> </option>
          <?php } ?>
      </select>
      </div>
      <div class="form-group">
      <label for="date">Last Update:</label>
      <input type="date" name="date" id="date" class="form-control" value="<?= $student['process_date'];?>">
      </div>
      <div class="form-group">
      <label for="textarea">备注：</label>
      <textarea name="notes" id="textarea" class="form-control" rows="3"><?= $student['student_notes']?></textarea>
      </div>
      <?php wp_nonce_field('add_student_information','student_information_nonce'); ?>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
</div>

</div>

    </div>
