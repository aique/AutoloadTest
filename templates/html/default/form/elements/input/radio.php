
<?php if($view['element']->getAttribute('checked')) : ?>

	<input type="radio"
		   checked="checked"
		   value="<?php echo $view['element']->getValue(); ?>"
		   name="<?php echo $view['element']->getAttribute('name'); ?>"
		   id="<?php echo $view['element']->getAttribute('id'); ?>"
		   class="<?php echo $view['element']->getAttribute('fieldClass'); ?>">

<?php else : ?>

	<input type="radio"
		   value="<?php echo $view['element']->getValue(); ?>"
		   name="<?php echo $view['element']->getAttribute('name'); ?>"
		   id="<?php echo $view['element']->getAttribute('id'); ?>"
		   class="<?php echo $view['element']->getAttribute('fieldClass'); ?>">

<?php endif; ?>
	   
<label for="<?php echo $view['element']->getAttribute('name'); ?>" class="label_multioptions">

	<img src="<?php echo Library_Qframe_Manage_ResourceManager::getConfig()->getVar("resources.path"); ?>/img/icons/ico_help.png" title="<?php echo $view['element']->getAttribute('description'); ?>" />

	<?php echo $view['element']->getAttribute('label'); ?>

</label>