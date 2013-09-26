<!doctype html>
<head>		
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>MegaTask</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/fonts.css') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/style.css?v=2') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/jquery-ui-timepicker-addon.css') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/tipTip.css') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/ui-lightness/jquery-ui-1.10.3.custom.min.css') ?>" media="all" />

<script type="text/javascript" src="<?php echo site_url('js/lib/jquery-1.9.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/lib/jquery-ui-1.10.3.custom.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/jquery-ui-timepicker-addon.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/jquery.tipTip.minified.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/noise.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/activity-indicator-1.0.0.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/jquery.stopwatch.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/scripts.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/highcharts/js/highcharts.src.js') ?>"></script>
<?php
/* load scripts for particular page
 * 
 */
if (isset($page_details['id'])) {
	if ($page_details['id'] == 3) {
		echo '<script type="text/javascript" src="'. site_url('js/page_home.js').'"></script>';
	}
	if ($page_details['id'] == 4) {
		echo '<script type="text/javascript" src="'. site_url('js/page_project.js').'"></script>';
	}
	if ($page_details['id'] == 5) {
		echo '<script type="text/javascript" src="'. site_url('js/page_task.js').'"></script>';
	}
	if ($page_details['id'] == 6) {
		echo '<script type="text/javascript" src="'. site_url('js/page_task_create.js').'"></script>';
	}
	
}

?>
</head>

<body>
    <div id="header">
		<?php
		//left menu
		if ($this->session->userdata('logged_in')) {
			$html = '';
			$html .= '<ul class="leftmenu">' . "\n";
			$html .= '<li>' . "\n";
			$html .= '<a href="'.site_url('/').'"><img class="tiptip" title="Home" src="'.site_url('/images/icons/32x32/home.png').'"></a>' . "\n";
			$html .= '</li>' . "\n";
			$html .= '<li>' . "\n";
			$html .= '<img class="tiptip createProjectTrigger" title="Create new project" src="'.site_url('/images/icons/32x32/edit.png').'">' . "\n";
			$html .= '</li>' . "\n";
			$html .= '<li>' . "\n";
			$html .= '<img class="tiptip myProjectsTrigger" title="My projects" src="'.site_url('/images/icons/32x32/categoty.png').'">' . "\n";
			$html .= '</li>' . "\n";
			$html .= '</ul>' . "\n";
			echo $html;
		}
		?>
		
		megatask
		
		<?php
		//right menu
		$html = '';
		$html .= '<ul class="rightmenu">' . "\n";
		if ($this->session->userdata('logged_in')) {
			$html .= '<li>' . "\n";
			$html .= '<a href="'.site_url('/settings').'"><img class="tiptip" title="Settings" src="'.site_url('/images/icons/32x32/my-account.png').'"></a>' . "\n";
			$html .= '</li>' . "\n";
			$html .= '<li>' . "\n";
			$html .= '<a href="'.site_url('/home/logout').'"><img class="tiptip" title="Logout '.$session_data['name'].'" src="'.site_url('/images/icons/32x32/sign-out.png').'"></a>' . "\n";
			$html .= '</li>' . "\n";
		}
		else {
			$html .= '<li>' . "\n";
			$html .= '<a href="'.site_url('/login').'"><img class="tiptip" title="Login" src="'.site_url('/images/icons/32x32/login.png').'"></a>' . "\n";
			$html .= '</li>' . "\n";
			$html .= '<li>' . "\n";
			$html .= '<a href="'.site_url('/registration').'"><img class="tiptip" title="Registration" src="'.site_url('/images/icons/32x32/customers.png').'"></a>' . "\n";
			$html .= '</li>' . "\n";
		}
		$html .= '</ul>' . "\n";
		echo $html;
		?>
    </div>

	<?php
	// create new project form if user is logged in
	if ($this->session->userdata('logged_in')) {
		$input_attributes = array('id' => 'createProjectForm');
		$html = '';
		$html .= '<div class="createProjectBox">'. "\n";
		$html .= form_open('/', $input_attributes) . "\n";
		$html .= '<label for="title">Create new project</label><br/>'. "\n";
		$html .= form_input(array(
							'name' => 'title',
							'id' => 'project_title',
							'placeholder' => 'Project title',
							'onclick' => 'if(this.value == \'Project title\') this.value = \'\'', //IE6 IE7 IE8
							'onblur' => 'if(this.value == \'\') this.value = \'Project title\''  //IE6 IE7 IE8
							));
		$html .= '<br/><br/>'. "\n";
		$html .= '<input type="submit" value="Create"/>'. "\n";
		$html .= '</form>'. "\n";
		$html .= '<div id="createProjectRespond"></div>'. "\n";
		$html .= '</div>'. "\n";
		echo $html;
	}
    
	?>
	
	<?php
	// list of all projects
	if (isset($my_projects)) {
		$html = '';
		$html .= '<div class="listProjectBox">'. "\n";
		if (!empty($my_projects)) {
			foreach ($my_projects as $my_project ) {
				$html .= '<a href="'.site_url('/project/'.$my_project->id).'">'.$my_project->title.'</a><br>';
			}	
		}
		else {
			$html .= '<i>You have no projects at the moment</i>';
		}
		
		$html .= '</div>'. "\n";
		echo $html;
	}
    
	?>
	
	<?php
	//active working task
	if (isset($now_woring_task) && !empty($now_woring_task)) {
		$html = '';
		$html .= '<div id="show_working_stopwatch_details">'. "\n";
		$html .= 'Working on <b>'.$now_woring_task[0]->title.'</b>'. "\n";
		$html .= '<div id="show_working_stopwatch" data-seconds="'.intval($now_woring_task[0]->diff).'">&nbsp;</div>'. "\n";
		$html .= '<div id="stop_working_task" class="submitForm">Stop working</div>'. "\n";
		
		$html .= '</div>'. "\n";
		
		echo $html;
	}
	?>
	
    
	        
    <div id="content">
		<?= $contents ?>
    </div>
    
    <div class="footer">
        page rendered in <strong>{elapsed_time}</strong> seconds<br>
		&COPY; Zlatko Micic, Dominique Eardly, Karl Huber
    </div>
</body>
</html>