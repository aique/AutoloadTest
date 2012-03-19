
<div class="content_field <?php echo $view['element']->getAttribute('contentClass'); ?>">

	<label for="<?php echo $view['element']->getAttribute('name'); ?>" class="label_field <?php echo $view['element']->getAttribute('classLabel'); ?>" >

		<img src="<?php echo Library_Manage_ResourceManager::getConfig()->getVar("resources.path"); ?>/img/icons/ico_help.png" title="<?php echo $view['element']->getAttribute('description'); ?>" />

		<?php echo $view['element']->getAttribute('label'); ?>

	</label>

	<?php if($view['element']->getAttribute('name') && $view['element']->getAttribute('extraDescription')): ?>

		<p class="p_description"><?php echo $view['element']->getAttribute('extraDescription'); ?></p>
	
	<?php endif; ?>
					
	<div class="content_error">
		
		<input type="email" 
			   name="<?php echo $view['element']->getAttribute('name'); ?>" 
			   id="<?php echo $view['element']->getAttribute('id'); ?>"
			   class="<?php echo $view['element']->getAttribute('fieldClass'); ?>" 
			   value="<?php echo $view['element']->getValue(); ?>" />
		
		<p class="p_error <?php echo $view['element']->getAttribute('classLabelError'); ?>"><span></span></p>	
						
	</div>
	
</div>