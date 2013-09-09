home page

<hr>

   <h1>Create new project</h1>
   
   <?php
   if (validation_errors()) {
	   echo '<div class="infoerrornote"><em></em>'. validation_errors() .'</div>';
   }
   ?>
   <?php echo form_open('/'); ?>
   
    <label for="title">Project title:</label><br/>
    <?php
    echo form_input(array(
        'name' => 'title',
		'id' => 'title',
        'placeholder' => 'Project title',
        'onclick' => 'if(this.value == \'Project title\') this.value = \'\'', //IE6 IE7 IE8
        'onblur' => 'if(this.value == \'\') this.value = \'Project title\''       //IE6 IE7 IE8
    ));
    ?>
    <br/>
    <br/>
        
     <input type="submit" value="Create"/>
   </form>


