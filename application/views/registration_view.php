<h1>Registration</h1>

<?php echo validation_errors(); ?>
<?php echo form_open('registration'); ?>

    <label for="name">Name:</label><br/>
    <?php
    echo form_input(array(
        'name' => 'name',
        'value' => $post_string['s_name'],
        'placeholder' => 'Name',
        'onclick' => 'if(this.value == \'Name\') this.value = \'\'', //IE6 IE7 IE8
        'onblur' => 'if(this.value == \'\') this.value = \'Name\''       //IE6 IE7 IE8
    ));
    ?>
    <br/>
    <br/>
    
    <label for="surname">Surame:</label><br/>
    <?php
    echo form_input(array(
        'name' => 'surname',
        'value' => $post_string['s_surname'],
        'placeholder' => 'Surname',
        'onclick' => 'if(this.value == \'Surname\') this.value = \'\'', //IE6 IE7 IE8
        'onblur' => 'if(this.value == \'\') this.value = \'Surname\''       //IE6 IE7 IE8
    ));
    ?>
    <br/>
    <br/>
    
    <label for="email">E-mail address:</label><br/>
    <?php
    echo form_input(array(
        'name' => 'email',
        'value' => $post_string['s_email'],
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
    <label for="captcha">Captcha:</label><br/>
    <?php
    echo form_input(array(
        'name' => 'captcha',
        'placeholder' => 'Captcha',
        'onclick' => 'if(this.value == \'Captcha\') this.value = \'\'', //IE6 IE7 IE8
        'onblur' => 'if(this.value == \'\') this.value = \'Captchae\''       //IE6 IE7 IE8
    ));
    ?>
    <br/>
    <br/><br/>
    
    
    <input type="submit" value="Register"/>
</form>


