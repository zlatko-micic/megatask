<!doctype html>
<head>		
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>MegaTask</title>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/style.css') ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/fonts.css') ?>" media="all" />

<script type="text/javascript" src="<?php echo site_url('js/lib/jquery-1.9.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/noise.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/scripts.js') ?>"></script>
 
</head>

<body>
    <div id="header">
		megatask
		<?php
		
		if ($this->session->userdata('logged_in')) {
			echo "<div class=\"logout\"><a href=\"".site_url('/home/logout')."\">Logout ".$this->session->userdata('logged_in')['name']."</a></div>";
		}
		?>
    </div>
	
	<?php
	//echo "<pre>";
	//print_r($this->session);
	//echo "</pre>";
	?>
	
	
    
	        
    <div id="content">
		<?= $contents ?>
    </div>
    
    <div class="footer">
        page rendered in <strong>{elapsed_time}</strong> seconds
    </div>
</body>
</html>