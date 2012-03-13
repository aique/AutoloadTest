<!DOCTYPE html>

<html>

	<head>
	
		<meta charset=utf-8 />
		
		<title>Autoload Test</title>
		
		<link rel="stylesheet" type="text/css" media="screen" href="/css/master.css" />
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	
	</head>

	<body>
	
		<?php echo Library_I18n_I18n::getFileContent("menu.php"); ?>
	
		<div class="container">
	
			<?php include PROJECT_PATH . "/application/layouts/scripts/header.php"; ?>
				
			<?php echo $content; ?>
				
			<?php include PROJECT_PATH . "/application/layouts/scripts/footer.php"; ?>
		
		</div>
	 
	</body>

</html>