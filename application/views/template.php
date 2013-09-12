<!doctype html>
<head>		
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>MegaTask</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/fonts.css') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/style.css') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/tipTip.css') ?>" media="all" />

<script type="text/javascript" src="<?php echo site_url('js/lib/jquery-1.9.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/jquery.tipTip.minified.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/noise.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/activity-indicator-1.0.0.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/scripts.js') ?>"></script>

<script type="text/javascript" src="<?php echo site_url('js/highcharts/js/highcharts.src.js') ?>"></script>

</head>

<body>
    <div id="header">
		<?php
		//left menu
		if ($this->session->userdata('logged_in')) {
			echo '<ul class="leftmenu">';
			echo '<li>';
			echo "<img class=\"tiptip createProjectTrigger\" title=\"create new project\" src=\"".site_url('/images/icons/32x32/edit.png')."\">";
			echo '</li>';
			echo '</ul>';
		}
		?>
		
		megatask
		
		<?php
		//right menu
		if ($this->session->userdata('logged_in')) {
			$html = '';
			$html .= '<ul class="rightmenu">' . "\n";
			$html .= '<li>' . "\n";
			$html .= "<a href=\"".site_url('/settings')."\"><img class=\"tiptip\" title=\"Settings\" src=\"".site_url('/images/icons/32x32/hire-me.png')."\"></a>" . "\n";
			$html .= '</li>' . "\n";
			$html .= '<li>' . "\n";
			$html .= "<a href=\"".site_url('/home/logout')."\"><img class=\"tiptip\" title=\"Logout ".$session_data['name']."\" src=\"".site_url('/images/icons/32x32/logout.png')."\"></a>" . "\n";
			$html .= '</li>' . "\n";
			$html .= '</ul>' . "\n";
			echo $html;
		}
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
	
    
	        
    <div id="content">
		<?= $contents ?>
    </div>
    
    <div class="footer">
        page rendered in <strong>{elapsed_time}</strong> seconds
    </div>
</body>
</html>