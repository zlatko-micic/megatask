<!doctype html>
<head>		
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>Title</title>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/style.css') ?>" media="all" />

<script type="text/javascript" src="<?php echo site_url('js/lib/jquery-1.9.1.min.js') ?>"></script>
 
</head>

<body>
    <div id="header">
		megatask
    </div>
    
	        
    <div id="content">
		<?= $contents ?>
    </div>
    
    <div class="footer">
        Page rendered in <strong>{elapsed_time}</strong> seconds
    </div>
</body>
</html>