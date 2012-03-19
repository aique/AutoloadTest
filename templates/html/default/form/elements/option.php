
<?php if($view['element']->getAttribute('selected')): ?>
				
	<option selected="selected" value="<?php echo $view['element']->getValue(); ?>"><?php echo $view['element']->getDisplay(); ?></option>
				
<?php else : ?>
				
	<option value="<?php echo $view['element']->getValue(); ?>"><?php echo $view['element']->getDisplay(); ?></option>
				
<?php endif; ?>