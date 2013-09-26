<div id="leftRow">

<h1><?=$project_details[0]->title?></h1>
<h2>created by <?=$project_details[0]->owner_name?> <?=$project_details[0]->last_name?></h2>
<br>
users in this project:<br>
<?php
foreach ($project_details[0]->users as $row) {
	echo $row['name'].' '.$row['last_name'].'<br>';
}
?>
<hr>

<a class="tiptip" title="Project statistics" href="<?php echo site_url('project-details/'. $this->uri->segment(2) ) ?>"><img src="<?php echo base_url('images/icons/32x32/statistics.png'); ?>" /></a>
 
<a class="tiptip" title="Create a task for this project" href="<?php echo site_url('task-create/'. $this->uri->segment(2) ) ?>"><img src="<?php echo base_url('images/icons/32x32/future-projects.png'); ?>" /></a>
<br>
<hr>
<?php
//admins form for inviting users into this project
if ($session_data['user_id'] == $project_details[0]->owner_id ) {
	//this user is admin
	$input_attributes = array('id' => 'inviteUsersForm');
	
	$html = '';
	$html .= '<div class="inviteUsers">'. "\n";
	
	if (isset($invitation_sending['message'])) {
		$msg_type = $invitation_sending['success'] == true ? 'infooknote' : 'infoerrornote';
		$html .= '<div class="'.$msg_type.'"><em></em>'. $invitation_sending['message'] .'</div>';
	}
	
	if (validation_errors()) {
		$html .= '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
	}
	$html .= form_open(uri_string(), $input_attributes) . "\n";
	$html .= '<label for="title">Invite people in project</label><br/>'. "\n";
	$html .= form_input(array(
						'name' => 'email',
						'placeholder' => 'E-mail address',
						'onclick' => 'if(this.value == \'E-mail address\') this.value = \'\'', //IE6 IE7 IE8
						'onblur' => 'if(this.value == \'\') this.value = \'E-mail address\''  //IE6 IE7 IE8
						));
	$html .= form_hidden('project', $this->uri->segment(2));
	$html .= '<br/><br/>'. "\n";
	$html .= '<input type="submit" value="Send invitation"/>'. "\n";
	$html .= form_close() . "\n";
	$html .= '</div>'. "\n";
	
	echo $html;
}
?>
</div>

<div id="rightRow">
	<h2>Project tasks</h2>
		
	<?php
	$html = '';
	
	if ($project_tasks) {
		$html .= '<hr>' . "\n";
		$html .= '<ul class="menuList" id="showHideAll">' . "\n";
		$html .= '<li data-id="1" class="selected">Show all task</li>' . "\n";
		$html .= '<li data-id="2">Show just my tasks</li>' . "\n";
    	$html .= '</ul>' . "\n";

		$html .= '<ul class="taskList">';
	
		foreach ($project_tasks as $row) {
			//css for my tasks
			$mine_taks = $row->admin == 1 ? 'mineTask' : '';
			$html .= '<li class="'.$mine_taks.'"><a class="tiptip" title="'.$row->description.'" href="'.site_url('task/'. $row->id ).'">'.$row->title.'</a></li>'."\n";
		}
		$html .= '</ul>';
	}
	else {
		$html .= '<div class="infonote"><em></em>There are no tasks for this project</div>';
	}

	echo $html;
	?>
</div>