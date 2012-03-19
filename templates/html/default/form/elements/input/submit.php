
<div class="content_field <?php echo $view['element']->getAttribute('contentClass'); ?>">	
				
	<input type="submit" 
		   name="<?php echo $view['element']->getAttribute('name'); ?>"
		   id="<?php echo $view['element']->getAttribute('id'); ?>"
		   class="<?php echo $view['element']->getAttribute('fieldClass'); ?>"
		   value="<?php echo $view['element']->getValue(); ?>" />
</div>