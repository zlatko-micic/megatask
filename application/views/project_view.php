<div class="breadcrumb flat">
	<a href="<?=site_url('/')?>">Home</a>
	<a href="<?=site_url('/project/'. $this->uri->segment(2))?>"><?=filter_data($project_details[0]->title)?></a>
</div>

<hr>

<div id="leftRow">
	<ul class="taskList">
		<li><h1><?=filter_data($project_details[0]->title)?></h1></li>
		<li><h2>created by <?=$project_details[0]->owner_name?> <?=$project_details[0]->last_name?></h2></li>
		<li>
			users in this project:<br>
			<?php
			foreach ($project_details[0]->users as $row) {
				echo $row['name'].' '.$row['last_name'].'<br>';
			}
			?>
		</li>
		<li><a href="<?php echo site_url('project-details/'. $this->uri->segment(2) ) ?>">Project statistics</a></li>
	</ul>

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
	<h1>Project tasks</h1>
	<a class="accept" href="<?php echo site_url('task-create/'. $this->uri->segment(2) ) ?>">Create new task</a>
	<?php
	//list of tasks for this project
	$html = '';
	if ($project_tasks) {
		$html .= '<hr>' . "\n";
		$html .= '<ul class="menuList" id="showHideAll">' . "\n";
		$html .= '<li data-id="1" class="selected">Show all task</li>' . "\n";
		$html .= '<li data-id="2">Show just my tasks</li>' . "\n";
    	$html .= '</ul>' . "\n";

		$html .= '<ul class="taskList" id="project_tasks">';
	
		foreach ($project_tasks as $row) {
			//css for my tasks
			$mine_taks = $row->admin == 1 ? 'mineTask' : '';
			//css for done tasks
			$done_taks = $row->active == 0 ? 'doneTask' : '';
			
			$html .= '<li class="'.$mine_taks.' '.$done_taks.'">'."\n";
			if ($row->active == 0) {
				$html .= '<em class="checked"></em>'."\n";
			}
			$html .= '<a class="tiptip" title="'.  htmlentities(filter_data($row->description)).'" href="'.site_url('task/'. $row->id ).'">'.filter_data($row->title).'</a>'."\n";
			$html .= '</li>'."\n";
		}
		$html .= '</ul>';
	}
	else {
		$html .= '<div class="infonote"><em></em>There are no tasks for this project</div>';
	}

	echo $html;
	?>
</div>