
<div class="content_field <?php echo $view['element']->getAttribute('contentClass'); ?>">

	<input type="hidden" value="0" name="<?php echo $view['element']->getAttribute('name'); ?>">
	
	<?php if($view['element']->getAttribute('checked')) : ?>
					
	<input type="checkbox" 
		   checked="checked"
		   name="<?php echo $view['element']->getAttribute('name'); ?>" 
		   id="<?php echo $view['element']->getAttribute('id'); ?>"
		   class="<?php echo $view['element']->getAttribute('fieldClass'); ?>"
		   value="1" />
		   
	<?php else : ?>

	<input type="checkbox"
		   name="<?php echo $view['element']->getAttribute('name'); ?>"
		   id="<?php echo $view['element']->getAttribute('id'); ?>"
		   class="<?php echo $view['element']->getAttribute('fieldClass'); ?>"
		   value="1" />
	
	<?php endif; ?>
		   
	<label for="<?php echo $view['element']->getAttribute('name'); ?>" class="label_field <?php echo $view['element']->getAttribute('classLabel'); ?>" >

		<img src="<?php echo Library_Qframe_Manage_ResourceManager::getConfig()->getVar("resources.path"); ?>/img/icons/ico_help.png" title="<?php echo $view['element']->getAttribute('description'); ?>" />

		<?php echo $view['element']->getAttribute('label'); ?>

	</label>
				
	<p class="p_error <?php echo $view['element']->getAttribute('classLabelError'); ?>">
	
		<span><?php echo $view['element']->getError(); ?></span>
		
	</p>
	
</div>