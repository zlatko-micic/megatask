project id = <?php echo $this->uri->segment(2) ?><br>
creator id = <?php echo $project_details[0]->owner_id ?><br>
my id = <?php echo $session_data['user_id'] ?><br>
<?php
//admins form for inviting users into this project
if ($session_data['user_id'] == $project_details[0]->owner_id ) {
	//this user is admin
	$input_attributes = array('id' => 'inviteUsersForm');
	
	$html = '';
	$html .= '<div class="inviteUsers">'. "\n";
	$html .= validation_errors() . "\n";
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
<?php
echo "<pre>";
print_r($project_details);
echo "</pre>";
?>