<?php echo $this->render_table_name($mode); ?>
<div class="xcrud-top-actions btn-group">
    <?php 
    echo $this->render_button('save_return','save','list','btn btn-primary','','create,edit');
    echo $this->render_button('save_new','save','create','btn btn-default','','create,edit');
    //echo $this->render_button('save_edit','save','edit','btn btn-default','','create,edit');
    echo $this->render_button('return','list','','btn btn-warning'); ?>
</div>
<div class="xcrud-view">
<?php echo $mode == 'view' ? $this->render_fields_list($mode,array('tag'=>'table','class'=>'table')) : $this->render_fields_list($mode,'div','div','label','div'); ?>
</div>
<div class="xcrud-nav">
    <?php echo $this->render_benchmark(); ?>
</div>
<div class="row">
<div class="col-md-6" style="padding-top: 10px;">
	<?php 
	$row = $this->result_row;
	foreach ($row as $key => $value) {
		if(preg_match('/box_embed/', $key)){

			echo "<div>".html_entity_decode($value)."</div>";
		}
	}
	?>

</div>
<div class="col-md-6">
	<pre>box.net
	User: Ausway@1230.me
	Pass: ausway123</pre>
</div>
	
</div>
