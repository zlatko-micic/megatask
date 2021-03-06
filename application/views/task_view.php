<div class="breadcrumb flat">
	<a href="<?=site_url('/')?>">Home</a>
	<a href="<?=site_url('/project/'. $task_info[0]->project_id)?>"><?=filter_data($task_info[0]->project)?></a>
	<a href="#" class="current"><?=filter_data($task_info[0]->title)?></a>
</div>

<?php
if (isset($error_message) && $error_message != '' ) {
	echo '<div class="infoerrornote"><em></em>'. $error_message .'</div>';
}
?>

<hr>

<div id="thirdLeftRow">
	<ul class="taskList">
		<li><h1><?=filter_data($task_info[0]->title)?></h1></li>
		
		<?php
		if ($task_info[0]->description != '') {
			echo "<li>".filter_data($task_info[0]->description)."</li>";
		}
		?>
		
		<li>created on <?=date('D j. M Y H:i',strtotime($task_info[0]->date_created));?> by <?=$task_info[0]->admin_name?> <?=$task_info[0]->admin_lastname?></li>
		<?php
		//closed details
		if ($task_info[0]->active == 0) {
			echo '<li>closed on '.date('D j. M Y H:i',strtotime($task_info[0]->date_finished)).' by '.$task_info[0]->done_name.' '.$task_info[0]->done_last_name.'</li>';
		}
		?>
		
		<li>
			Task assigned for user(s):<br>
			<?php
			$html = '';
			foreach ($task_info[0]->task_users as $row) {
				$html .= $row['name'] . ' ' . $row['last_name'] .' <br> ';
			}
			echo $html;
			?>
		</li>
		<?php
		if ($task_info[0]->active == 1) {
		?>
		<li>
			<a href="#" id="task_working" data-id="<?=$this->uri->segment(2)?>">Start working on this task</a> 

			<span id="ajax_working_activity"></span>
			<div id="respond_working"></div>
		</li>
		<?php } ?>
		
		<?php
		//close task - just for assigned users
		if (in_multiarray($session_data['user_id'],$task_info[0]->task_users,'id') && $task_info[0]->active == 1) {
			echo '<li><a href="#" id="close_task" data-id="'.$this->uri->segment(2).'">Close task</a><div id="respond_task_close"></div></li>';
		}
		
		?>

	</ul>
	
	<h1>Working hours</h1>
	<?php
	//list of users for filtering
	$html = '';
	if ($working_hours) {
		$html .= '<ul class="menuList" id="filter_working_hours">';
		$html .= '<li data-id="0" class="selected">All</li>' . "\n";
		foreach ($task_info[0]->task_users as $row) {
			$html .= '<li data-id="'.$row['id'] .'">' . "\n";
			$html .= $row['name'] .' '. $row['last_name'] . "\n";
			$html .= '</li>' . "\n";
			
		}
		$html .= '</ul>'. "\n";
	}
	echo $html;
	?>
	<br>
	total time: <span id="sumall">0</span>
	<hr>
	<?php
	//list of working hours
	$html = '';
	if ($working_hours) {
		$html .= '<ul class="taskList" id="working_hours_list">' . "\n";
		foreach ($working_hours as $row) {
			$html .= '<li data-user="'. $row->user_id .'" data-seconds="'. $row->seconds .'">' . "\n";
			
			$html .= '<em class="menu_dropdown tiptip" title="Toggle details"></em>' . "\n";
			
			//edit/delete options if owner and if task is finished
			if ($session_data['user_id'] == $row->user_id && $row->finished != "0000-00-00 00:00:00") {
				$html .= '<a href="'.site_url('/edit-work/'. $row->id).'"><em class="pencil_edit"></em></a>' . "\n";
				$html .= '<a href="#"><em class="delete"></em></a>' . "\n";
			}
			
			$html .= $row->name .' '. $row->surname .' ('. date('d. n. Y H:i',strtotime($row->started)).') ' . "\n";
			
			$html .= '<div class="hidden_details">' . "\n";
			
			if ($row->finished == "0000-00-00 00:00:00") {
				$html .= 'working right now!'. "\n";
			}
			else {
				$html .= 'started on <b>'.date('d. n. Y H:i',strtotime($row->started)).'</b> finished on <b>'.date('d. n. Y H:i',strtotime($row->finished)).'</b><br>'. "\n";
				$html .= 'total '.$row->time_done .'<br>'. "\n";
				
				//show description if exists
				if ($row->description != '') {
					$html .= $row->description . "\n";
				}
				else {
					$html .= '<i>No Description</i>' . "\n";
				}
				
			}
			$html .= '</div>' . "\n";
			$html .= '</li>' . "\n";
		}
		
		$html .= '</ul>' . "\n";
	}
	else {
		$html .=  '<div class="infonote"><em></em> No recodred works for this task</div>';
	}
	echo $html;
	
	
?>
</div>

<div id="thirdMiddleRow">
	<h1>Messages</h1>
	<?php
	$html = '';
	if ($messages) {
		$html .= '<ul class="taskList">' . "\n";
		foreach ($messages as $row) {
			$html .= '<li>' . "\n";
			$html .= '<b>'. $row->name .' '. $row->surname . '</b> on '. $row->date .'<br><br>'  . "\n";
			$html .=  filter_data($row->textmessage).'' . "\n";
			
			if ($row->original_file_name) {
				$html .= '<br><br>' . "\n";
				$html .=  '<a href="'.site_url('/file/'.$row->file_id).'"><em class="attachment"></em>'.$row->original_file_name.'</a>' . "\n";
			}
			
			$html .= '</li>' . "\n";
		}
		
		$html .= '</ul>' . "\n";
		
	}
	else {
		$html .= '<div class="infonote"><em></em> No messages in this task</div>';
	}
	echo $html;
	?>
</div>

<div id="thirdRightRow">
	<h1>Write message</h1>
	<?php
		//this user is admin
		$input_attributes = array('id' => 'messageForm');

		$html = '';
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

		echo $html;

	?>
</div>
