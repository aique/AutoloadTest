
<div class="content_form <?php echo $view['element']->getAttribute('contentClass'); ?>">

	<form id="<?php echo $view['element']->getAttribute('id'); ?>"
		  class="<?php echo $view['element']->getAttribute('class'); ?>"
		  method="<?php echo $view['element']->getAttribute('method'); ?>"
		  action="<?php echo $view['element']->getAttribute('action'); ?>"
		  enctype="<?php echo $view['element']->getAttribute('enctype'); ?>">
		  
		<fieldset>
		  
			<legend><?php echo $view['element']->getLegend(); ?></legend>
			
			<p class="p_error <?php echo $view['element']->getAttribute('classLabelError'); ?>">
			
				<span><?php echo $view['element']->getError(); ?></span>
					
			</p>
			  	
			<?php
			  	
				foreach($view['element']->getElements() as $element)
				{
					echo $element;
				}
					
			?>
			
			<div class="form-actions">
			
			<?php
				
				foreach($view['element']->getActions() as $action)
				{
					echo $action;
				}
			
			?>
				
			</div>
		  
		</fieldset>
		  
	</form>

</div>