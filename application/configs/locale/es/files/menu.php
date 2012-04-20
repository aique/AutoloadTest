<div class="navbar navbar-fixed-top">

	<div class="navbar-inner">
	
		<div class="container">
		
			<div class="nav-collapse">

				<ul class="nav">
				
					<li><a href="/">Inicio</a></li>
					<li><a href="/cms/user/list">Lista de usuarios</a></li>
					<li><a href="/cms/user/insert">Inserción de usuarios</a></li>
					
				</ul>
				
			</div>
			
			<?php if($view->getContent('logged_user') != null) : ?>
			
				<div class="user_menu">
			
					<p class="user_name">
					
						<?php echo 'Hola ' . $view->getContent('logged_user')->getName(); ?>
					
					</p>
				
					<ul class="nav">
						
						<li><a href="/logout">Logout</a></li>
							
					</ul>
					
				</div>
				
			<?php endif; ?>
			
		</div>
		
	</div>
	
</div>