
<?php
include "config.php";
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
    $table_students = $wpdb->prefix.'eazplus_students';
    $student_insert_pre = array(
		'student_name' 	        => $information["student_name"],
		'student_email'         => $information["student_email"],
		'student_phone'         => $information["student_phone"],
		'student_visa' 	        => $information["student_visa"],
		'student_process'       => $information["process"],
		'process_date' 	        => $date,
		'agency_id' 		    => $information["agency_id"],
		'sponsor_id' 		    => $information["sponsor_id"],
		'student_notes' 		=> $information["notes"]
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
    if(!$wpdb->insert( $table_students,$student_insert_pre,$student_insert_format)) {return false;}else{return true;}

}
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
?>
<?php if(formsubmit()){
    if(add_new_student($_POST)){
    echo "You have successful submit students information. <br>";
    echo "Get back to submit more information.<a href='#'>Back</a>";
    wp_redirect('student_list.php',302);
    }else{
    echo "The students has been existed! Please do not re-add it! Thanks ";
    }
	};?>
<?php get_header() ?>

<?php system_nav() ?>

<div id="form" class="row">
    <div class="col-md-6 col-md-offset-3 text-center"><h1>学生信息登记</h1></div>
<div class="col-md-6 col-md-offset-3">
<form role="form" action="" method="post" class="form">
  <div class="form-group">
    <label for="student_name" class="control-label">Student Name (First Last)</label>
    <input type="text" class="form-control" id="student_name" name="student_name" placeholder="Enter Name" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="student_email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="student_phone">Phone Number</label>
    <input type="number" class="form-control" id="student_phone" placeholder="Phone Number" name="student_phone">
  </div>
  <div class="radio-inline">
  <label>
    <input type="radio" name="student_visa" id="visa" value="187" checked>
    187 Visa
  </label>
</div>
  <div class="radio-inline">
  <label>
    <input type="radio" name="student_visa" id="visa" value="186">
    186 Visa
  </label>
</div>
  <div class="radio-inline">
  <label>
    <input type="radio" name="student_visa" id="visa" value="457">
    457 Visa
  </label>
</div>
     <div class="form-group">
      <label for="process">进度</label>
      <select name="process" id="process" class="form-control">
        <option value="1">Start to prepare documents</option>
        <option value="2">Publishing Ads</option>
        <option value="3">Sporonship Prepare</option>
        <option value="4">Sporonship Submitted</option>
        <option value="5">Sporonship Docuemtns Required</option>
        <option value="6">Sporonship Approval</option>
        <option value="7">Sporonship Failed</option>
        <option value="8">Nomination prepare</option>
        <option value="9">Nomination submitted</option>
        <option value="10">Nomination Docuemtns Required</option>
        <option value="11">Nomination approval</option>
        <option value="12">Nomination Failed</option>
        <option value="13">Visa Application Prepare</option>
        <option value="14">Visa Application Submit</option>
        <option value="15">Visa Application Docuemtns Required</option>
        <option value="16">Visa Application Approval</option>
        <option value="17">Visa Application Failed</option>
        <option value="18">Deal Closed</option>
      </select></div>
      <div class="form-group">
      <label for="agency">中介</label>
      <select name="agency_id" id="agency" class="form-control">
          <option value="0">尚未指定</option>
      </select>
      </div>
      <div class="form-group">
      <label for="sponsor_id">雇主</label>
      <select name="sponsor_id" id="sponsor" class="form-control">
          <option value="0">尚未指定</option>
      </select>
      </div>
      <div class="form-group">
      <label for="date">Last Update:</label>
      <input type="date" name="date" id="date" class="form-control">
      </div>
      <div class="form-group">
      <label for="textarea">备注：</label>
      <textarea name="notes" id="textarea" class="form-control" rows="3"></textarea>
      </div>
      <?php wp_nonce_field('add_student_information','student_information_nonce'); ?>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
</div>

</body>
</html>