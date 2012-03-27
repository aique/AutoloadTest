<!DOCTYPE html>

<html>

	<head>
	
		<meta charset=utf-8 />
		
		<title>Autoload Test</title>
		
		<!-- <link rel="stylesheet" type="text/css" media="screen" href="/css/master.css" /> -->
		
		<link rel="stylesheet/less" type="text/css" media="screen" href="/lib/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet/less" type="text/css" media="screen" href="/lib/bootstrap/css/bootstrap-responsive.css" />
		
		<link rel="stylesheet/less" type="text/css" media="screen" href="/css/qframe/lists.less" />
		<link rel="stylesheet/less" type="text/css" media="screen" href="/css/qframe/forms.less" />
		<link rel="stylesheet/less" type="text/css" media="screen" href="/css/qframe/pagination.less" />
		
		<link rel="stylesheet/less" type="text/css" media="screen" href="/css/layout.less" />
		<link rel="stylesheet/less" type="text/css" media="screen" href="/css/menu.less" />
		
		<script type="text/javascript" src="/lib/less/less-1.3.0.js"></script>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	
	</head>

	<body>
	
		<?php echo Library_Qframe_I18n_I18n::getFileContent("menu.php", null, $view); ?>
	
		<div class="container">
	
			<?php include PROJECT_PATH . "/application/layouts/scripts/header.php"; ?>
				
			<?php echo $view['content']; ?>
				
			<?php include PROJECT_PATH . "/application/layouts/scripts/footer.php"; ?>
		
		</div>
	 
	</body>

</html>