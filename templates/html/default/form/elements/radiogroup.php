
<div class="content_field <?php echo $view['element']->getAttribute('contentClass'); ?>">

	<p class="p_error <?php echo $view['element']->getAttribute('classLabelError'); ?>">
	
		<span><?php echo $view['element']->getError(); ?></span>
		
	</p>
	
	<!-- <br class="clear"/> -->
				
	<?php if($view['element']->getAttribute('name') && $view['element']->getAttribute('extraDescription')): ?>

		<p class="p_description"><?php echo $view['element']->getAttribute('extraDescription'); ?></p>
	
	<?php endif; ?>
						
	<?php
		
		foreach($view['element']->getRadios() as $radio)
		{
			echo $radio;
		}
		
	?>
	
</div>