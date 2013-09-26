<div class="breadcrumb flat">
	<a href="<?=site_url('/')?>">Home</a>
	<a href="<?=site_url('/project/'. $task_info[0]->project_id)?>"><?=$task_info[0]->project?></a>
	<a href="#" class="current"><?=$task_info[0]->title?></a>
</div>

<?php
if (isset($error_message)) {
	echo '<div class="infoerrornote"><em></em>'. $error_message .'</div>';
}
?>

<hr>

<div id="thirdLeftRow">
	<h1><?=$task_info[0]->title?></h1>
	<?=$task_info[0]->description?><br>
	created on <?=date('D j. M Y H:i',strtotime($task_info[0]->date_created));?> by <?=$task_info[0]->admin_name?> <?=$task_info[0]->admin_lastname?><br>
	
	Task assigned for user(s):<br>
	<?php
	$html = '';
	foreach ($task_info[0]->task_users as $row) {
		$html .= $row['name'] . ' ' . $row['last_name'] .' <br> ';
	}
	echo $html;
	?>
	<?php
	echo '<pre>';
	//print_r($task_info);
	echo '</pre>';
	?>

	<hr>
<a class="tiptip" title="Start working on this task" href="#" id="task_working" data-id="<?=$this->uri->segment(2)?>"><img src="<?php echo base_url('images/icons/32x32/old-versions.png'); ?>" /></a>

<span id="ajax_working_activity"></span>
<div id="respond_working"></div>

	<hr>
	<h1>Working hours</h1>
	<?php
	if ($working_hours) {
		$html = '';
		$html .= '<ul class="taskList">' . "\n";
		foreach ($working_hours as $row) {
			$html .= '<li>' . "\n";
			$html .= $row->name .' '. $row->surname . '<br>' . "\n";
			if ($row->finished == "0000-00-00 00:00:00") {
				$html .= 'working right now!'. "\n";
			}
			else {
				$html .= 'started on'.$row->started.' finished on '.$row->finished.'<br>'. "\n";
				$html .= 'total '.$row->time_done . "\n";
			}
			$html .= '</li>' . "\n";
		}
		
		$html .= '</ul>' . "\n";
		
		echo $html;
	}
?>
</div>

<div id="thirdMiddleRow">
	<h1>Messages</h1>
	<?php
	
	if ($messages) {
		$html = '';
		$html .= '<ul class="taskList">' . "\n";
		foreach ($messages as $row) {
			$html .= '<li>' . "\n";
			$html .= '<b>'. $row->name .' '. $row->surname . '</b> on '. $row->date .'<br><br>'  . "\n";
			$html .=  $row->textmessage.'' . "\n";
			
			if ($row->original_file_name) {
				$html .= '<br> <hr>' . "\n";
				$html .=  'attached file: <a href="'.site_url('/file/'.$row->file_id).'">'.$row->original_file_name.'</a>' . "\n";
			}
			
			
			$html .= '</li>' . "\n";
		}
		
		$html .= '</ul>' . "\n";
		
		echo $html;
	}
	?>
</div>

<div id="thirdRightRow">
	<h1>Write message</h1>
	<?php
		//this user is admin
		$input_attributes = array('id' => 'messageForm');

		$html = '';
		$html .= '<div class="inviteUsers">'. "\n";
		if (validation_errors()) {
			$html .= '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
		}
		$html .= form_open_multipart(uri_string(), $input_attributes) . "\n";
		$html .= '<label for="message">Message</label><br/>'. "\n";

		$textarea_data = array('id' => 'message',
								'name' => 'message',
								'placeholder' => 'Your message');

		$html .= form_textarea($textarea_data). "\n"; 

		$html .= '<br/>'. "\n";
		$html .= '<input type="file" name="upload_file" id="upload_file" />'. "\n";

		$html .= form_hidden('task', $this->uri->segment(2));
		$html .= '<br/><br/>'. "\n";
		$html .= '<input type="submit" value="Send message"/>'. "\n";
		$html .= form_close() . "\n";
		$html .= '</div>'. "\n";

		echo $html;

	?>
</div>
