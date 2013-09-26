<div class="connectWrap">
	<div class="connect">
		<h1>Login</h1>

		<?php
		if (validation_errors()) {
		   echo '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
		}
		
		if (isset($registration['message'])) {
		   echo '<div class="infooknote"><em></em>'. $registration['message'] .'</div>';
		}
		?>
		<?php echo form_open('login'); ?>

		<label for="email">E-mail address:</label><br/>
		<?php
		echo form_input(array(
			'name' => 'username',
			'placeholder' => 'E-mail'
		));
		?>
		<br/>
		<br/>

		<label for="password">Password:</label><br/>
		<?php
		echo form_input(array(
			'name' => 'password',
			'placeholder' => 'Password',
			'type' => 'password'
		));
		?>
		<br/>
		<br/>

		<input type="submit" value="Login"/>
		<?php echo form_close(); ?>
	</div>
</div>