
<?php
include "config.php";
function add_new_agency($information){
	echo "I am the process<br>"; 
	/*
	Add new agencys into database.
	All the process is all done by wordpress in the safer ways.
	Add time filers
	*/
	echo $information["agency_name"];
    global $wpdb;
    $table_agency = $wpdb->prefix.'eazplus_agency';
    $agency_insert_pre = array(
		'agency_name' 	        => $information["agency_name"],
        'agency_nickname'       => $information["agency_nickname"],
		'agency_email'          => $information["agency_email"],
		'agency_phone'          => $information["agency_phone"],
		'agency_notes' 		    => $information["notes"]
	);
$agency_insert_format = array(
		'%s',
        '%s',
		'%s', 
		'%d',
		'%s'
	);
    $wpdb->show_errors();
    //If error what we return
    if(!$wpdb->insert( $table_agency,$agency_insert_pre,$agency_insert_format)) {return false;}else{return true;}

}
function formsubmit(){
	if ( !isset($_POST['agency_information_nonce']) || !wp_verify_nonce($_POST['agency_information_nonce'],'add_agency_information') ){
		return false;
	}else{
		if(isset($_POST['agency_name']) && !empty($_POST["agency_name"])){return true;}
	}
}
function formhide(){
	//function use to hide forms. 
	if(formsubmit()){return hidden;}else{ return visable;}}
?>
<?php if(formsubmit()){
    if(add_new_agency($_POST)){
    echo "You have successful submit agency information. <br>";
    echo "Get back to submit more information.<a href='#'>Back</a>";
    wp_redirect('agency_list.php',302);
    }else{
    echo "The agency has been existed! Please do not re-add it! Thanks ";
    }
	};?>
<?php get_header() ?>

<?php system_nav() ?>

<div id="form" class="row">
    <div class="<?php echo SYSTEM_FRAME_WORK; ?> text-center"><h1>中介信息登记</h1></div>
<div class="<?php echo SYSTEM_FRAME_WORK; ?>">
<form role="form" action="" method="post" class="form">
  <div class="form-group">
    <label for="agency_name" class="control-label">Agency Name (First Last)</label>
    <input type="text" class="form-control" id="agency_name" name="agency_name" placeholder="Enter Name" required>
  </div>
  <div class="form-group">
    <label for="agency_nickname" class="control-label">Nick Name</label>
    <input type="text" class="form-control" id="agency_nickname" name="agency_nickname" placeholder="Enter NickName" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="agency_email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="agency_phone">Phone Number</label>
    <input type="number" class="form-control" id="agency_phone" placeholder="Phone Number" name="agency_phone">
  </div>
  <div class="form-group">
      <label for="textarea">Notes：</label>
      <textarea name="notes" id="textarea" class="form-control" rows="3"></textarea>
      </div>
      <?php wp_nonce_field('add_agency_information','agency_information_nonce'); ?>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
</div>

</body>
</html>