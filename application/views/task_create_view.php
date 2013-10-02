<div class="breadcrumb flat">
	<a href="<?=site_url('/')?>">Home</a>
	<a href="<?=site_url('/project/'. $this->uri->segment(2))?>"><?=$project_info[0]->title?></a>
	<a href="#" class="current">Create task</a>
</div>

<hr>
<?php
if (isset($error_message)) {
	echo '<div class="infoerrornote"><em></em>'. $error_message .'</div>';
}
if (validation_errors()) {
	echo '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
}
$input_attributes = array('id' => 'inviteUsersForm');
echo form_open(uri_string(), $input_attributes) ;
?>
<div id="leftRow">
	<h1>Create task</h1>

	<?php
	//this user is admin
	

	$html = '';
	
	$html .= '<label for="title">Task title</label><br/>'. "\n";
	$html .= form_input(array('id' => 'title',
						'name' => 'title',
						'placeholder' => 'Task title',
						'value' => $post_string['s_title'],
						));
	//project id
	$html .= form_hidden('project', $this->uri->segment(2));
	$html .= '<br/><br/>'. "\n";

	//description
	$html .= '<label for="description">Task description</label><br/>'. "\n";
	$html .= form_textarea(array('id' => 'description',
								'name' => 'description',
								'placeholder' => 'Task description',
								'value' => $post_string['s_description'],
								)). "\n";
	$html .= '<br/><br/>'. "\n";


	//due date
	$html .= '<label for="due_date">Due date</label><br/>'. "\n";
	$html .= form_input(array('id' => 'due_date',
						'name' => 'due_date',
						'placeholder' => 'Due date',
						'value' => $post_string['s_due_date'],
						));
	$html .= '<br/><br/>'. "\n";

	$html .= '<hr>'. "\n";

	echo $html;
	
	?>
	
</div>

<div id="rightRow">
	<?php

	//users list
	$html = '';
	$html .= '<h1>Assign task to user(s)</h1>'. "\n";
	$html .= '<ul>'. "\n";
	foreach ($project_users as $project_user) {
		
		$checked = in_array($project_user->id, $post_string['a_task_user']) ? TRUE : FALSE;
		
		$html .= '<li>'. "\n";
		$html .= form_checkbox(array(
						'name' => 'task_user[]',
						'value' => $project_user->id,
						'checked'     => $checked,
						'id' => 'taskUser'. $project_user->id ,
						));
		
		$html .= '<label for="taskUser'. $project_user->id .'">'.$project_user->name.' '.$project_user->surname.'</label><br/>'. "\n";
		//$html .= $project_user->name.' '.$project_user->surname.' '. "\n";
		
		$html .= '</li>'. "\n";
	}
	$html .= '</ul>'. "\n";

	$html .= '<hr>'. "\n";

	$html .= '<input type="submit" value="Create"/>'. "\n";

	echo $html;
	?>
</div>
<?php
echo form_close();
?>