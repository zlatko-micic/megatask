<div class="breadcrumb flat">
	<a href="<?=site_url('/')?>">Home</a>
	<a href="<?=site_url('/project/'. $working_details[0]->project_id)?>"><?=filter_data($working_details[0]->project_title)?></a>
	<a href="<?=site_url('/task/'. $working_details[0]->task_id)?>"><?=filter_data($working_details[0]->task_title)?></a>
	<a href="<?=site_url('/edit-work/'. $this->uri->segment(2))?>">Edit working time</a>
</div>

<hr>

<div id="leftRow">
	<?php
	
	if (isset($change['message']) && $change['message'] != '') {
		$css = $change['suscces'] ? 'infooknote' : 'infoerrornote';
		echo '<div class="'.$css.'"><em></em>'. $change['message'] .'</div>';
	}
	?>
	
	<?php echo form_open(uri_string()); ?>
	
	<label for="started">Started:</label><br/>
	<?php
	echo form_input(array(
		'name' => 'started',
		'id' => 'started',
		'value' => $working_details[0]->started,
		'placeholder' => 'Started'
	));
	?>
	<br><br>
	
	<label for="ended">Ended:</label><br/>
	<?php
	echo form_input(array(
		'name' => 'ended',
		'id' => 'ended',
		'value' => $working_details[0]->finished,
		'placeholder' => 'Ended'
	));
	?>
	<br><br>
	
	<label for="name">Description:</label><br/>
	<?php
	echo form_textarea(array(
		'name' => 'description',
		'id' => 'description',
		'value' => $working_details[0]->description,
		'placeholder' => 'Description'
	));
	?>
	
	<br/>
	<br/>
	<input type="submit" value="Change"/>
	<?php echo form_close(); ?>

</div>

<div id="rightRow">

</div>