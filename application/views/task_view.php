id = <?php echo $this->uri->segment(2) ?><br>
user id = <?php echo $session_data['user_id'] ?><br>


<hr>

<h1>Info</h1>
<?php
echo '<pre>';
print_r($task_info);
echo '</pre>';
?>

<hr>

<h1>Write messages</h1>
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

<hr>

<h1>Messages</h1>
<?php
echo '<pre>';
print_r($messages);
echo '</pre>';
?>

<hr>

<h1>Working hours</h1>
<?php
echo '<pre>';
print_r($working_hours);
echo '</pre>';
?>