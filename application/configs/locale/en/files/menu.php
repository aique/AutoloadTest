<div class="navbar navbar-fixed-top">

	<div class="navbar-inner">
	
		<div class="container">
		
			<div class="nav-collapse">

				<ul class="nav">
				
					<li><a href="/">Home</a></li>
					<li><a href="/cms/user/list">Users list</a></li>
					<li><a href="/cms/user/insert">Users insertion</a></li>
					
				</ul>
			
			</div>
			
			<?php if(isset($view['logged_user']) && $view['logged_user'] != null) : ?>
			
				<div class="user_menu">
			
					<p class="user_name">
					
						<?php echo 'Hellow ' . $view['logged_user']->getName(); ?>
					
					</p>
				
					<ul class="nav">
						
						<li><a href="/logout">Logout</a></li>
							
					</ul>
					
				</div>
				
			<?php endif; ?>
		
		</div>
	
	</div>
	
</div>