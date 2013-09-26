<div class="connectWrap">
	<div class="connect">
		<h1>Registration</h1>

		<?php
		if (validation_errors()) {
		   echo '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
		}
		?>
		<?php echo form_open('registration'); ?>

			<label for="name">Name:</label><br/>
			<?php
			echo form_input(array(
				'name' => 'name',
				'value' => $post_string['s_name'],
				'placeholder' => 'Name'
			));
			?>
			<br/>
			<br/>

			<label for="surname">Surame:</label><br/>
			<?php
			echo form_input(array(
				'name' => 'surname',
				'value' => $post_string['s_surname'],
				'placeholder' => 'Surname'
			));
			?>
			<br/>
			<br/>

			<label for="email">E-mail address:</label><br/>
			<?php
			echo form_input(array(
				'name' => 'email',
				'value' => $post_string['s_email'],
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

			<label for="password2">Repeat password:</label><br/>
			<?php
			echo form_input(array(
				'name' => 'password2',
				'placeholder' => 'Repeat password',
				'type' => 'password'
			));
			?>
			<br/>
			<br/>

			<?php echo $captcha['image']; ?><br/>
			<label for="captcha">Captcha (case-insensitive):</label><br/>
			<?php
			echo form_input(array(
				'name' => 'captcha',
				'placeholder' => 'Captcha'
			));
			?>
			<br/>
			<br/><br/>


			<input type="submit" value="Register"/>
		<?php echo form_close(); ?>

	</div>
</div>