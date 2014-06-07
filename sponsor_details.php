<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 14-2-16
 * Time: 下午6:46
 */
require_once 'config.php';


function formsubmit(){
	if ( !isset($_POST['sponsor_information_nonce']) || !wp_verify_nonce($_POST['sponsor_information_nonce'],'add_sponsor_information') ){
		return 0;
	}else{
		if(isset($_POST['sponsor_name']) && !empty($_POST["sponsor_name"])){return 1;}
	}
}


if(formsubmit()){
	if(isset($_GET) && !empty($_GET['sponsor_id'])){
		//if we have set the sponsor id, then we need to update the record rather than creat one.
        //TODO: Create functions for update_sponsor and add_new_sponsor
		if(update_sponsor($_POST)){
		echo "You have successful update sponsors information. <br>";
		echo "Get back to submit more information.<a href='#'>Back</a>";
		wp_redirect('sponsor_list.php',302);
		}else{
		echo "The sponsors has been existed! Please do not re-add it! Thanks ";
		}
	}else{
		if(add_new_sponsor($_POST)){
		echo "You have successful add sponsors information. <br>";
		echo "Get back to submit more information.<a href='#'>Back</a>";
		wp_redirect('sponsor_list.php',302);
		}else{
		echo "The sponsors has been existed! Please do not re-add it! Thanks ";
		}
	}

};


if(isset($_GET) && !empty($_GET['sponsor_id'])):
    global $wpdb;
    $table_sponsors = $wpdb->prefix.'eazplus_sponsors';
    $sponsor_id = $_GET['sponsor_id'];
    $sponsor = $wpdb->get_row(
        "
        SELECT * FROM $table_sponsors WHERE sponsor_id = $sponsor_id
        ", ARRAY_A
    );
else:
	$sponsor = array();
endif;
	//get header and other information ready. 
	get_header();
	system_nav(); ?>
<div id="main" class="container-fluid">
	<div id="form" class="row">
    <div class="col-md-6 col-md-offset-2 text-center"><h2>雇主信息详情页面</h2></div>
	<div class="col-md-6 col-md-offset-2">
	<form role="form" action="" method="post" class="form">
	<div class="form-group" style="display:none;">
    	<label for="sponsor_id" class="control-label">Sponsor ID</label>
    	<input type="muber" class="form-control" id="sponsor_id" name="sponsor_id" value="<?php echo $sponsor['sponsor_id'] ?>">
  	</div>
  	<div class="form-group">
    	<label for="sponsor_name" class="control-label">Sponsor Name (First Last)</label>
    	<input type="text" class="form-control" id="sponsor_name" name="sponsor_name" value="<?php echo $sponsor['sponsor_name'] ?>" required>
  	</div>
      <div class="form-group">
        <label for="sponsor_phone">Middle Person</label>
        <input type="text" class="form-control" id="middle_name" value="<?php echo $sponsor['middle_name'] ?>" name="middle_name">
      </div>
      <div class="form-group">
      <label for="textarea">备注：</label>
      <textarea name="notes" id="textarea" class="form-control" rows="3"><?= $sponsor['sponsor_notes']?></textarea>
      </div>
      <?php wp_nonce_field('add_sponsor_information','sponsor_information_nonce'); ?>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
</div>

</div>

    </div>
