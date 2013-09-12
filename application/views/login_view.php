
   <h1>Login</h1>
   
   <?php
   if (validation_errors()) {
	   echo '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
   }
   ?>
   <?php echo form_open('login'); ?>
   
    <label for="email">E-mail address:</label><br/>
    <?php
    echo form_input(array(
        'name' => 'username',
        'placeholder' => 'E-mail',
        'onclick' => 'if(this.value == \'E-mail\') this.value = \'\'', //IE6 IE7 IE8
        'onblur' => 'if(this.value == \'\') this.value = \'E-mail\''       //IE6 IE7 IE8
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
   </form>