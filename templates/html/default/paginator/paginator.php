
<?php

	$request = Library_Qframe_Manage_ResourceManager::getRequestData();
	$request->setParams(array());
	
?>

<div class="pagination">

	<ul>

		<li><a href="'.$request.'/page/1"><?php echo Library_Qframe_I18n_I18n::getText("screen_common_pagination_first"); ?></a></li>
		
		<?php if($view['helper']->getLeftArrowPage()): ?>
				
			<?php echo '<li><a href="'.$request.'/page/'.$view['helper']->getLeftArrowPage().'">&larr;</a></li>'; ?>
				
		<?php endif; ?>
		
		<?php foreach($view['helper']->getLeftPages() as $leftPage): ?>
		
			<?php echo '<li><a href="'.$request.'/page/'.$leftPage.'">'.$leftPage.'</a></li>'; ?>
		
		<?php endforeach; ?>
	
		<?php echo '<li class="active"><a href="'.$request.'/page/'.$view['helper']->getCurrentPage().'">'.$view['helper']->getCurrentPage().'</a></li>'; ?>
	
		<?php foreach($view['helper']->getRightPages() as $rightPage): ?>
		
			<?php echo '<li><a href="'.$request.'/page/'.$rightPage.'">'.$rightPage.'</a></li>'; ?>
		
		<?php endforeach; ?>
		
		<?php if($view['helper']->getRightArrowPage()): ?>
		
			<?php echo '<li><a href="'.$request.'/page/'.$view['helper']->getRightArrowPage().'">&rarr;</a></li>'; ?>
		
		<?php endif; ?>
				
		<?php echo '<li><a href="'.$request.'/page/'.$view['paginator']->getPagesNumber().'">'.Library_Qframe_I18n_I18n::getText("screen_common_pagination_last").'</a></li>'; ?>
			
	</ul>
	
	<form method="POST" action="#">
	
		<label for="items_per_page">Registros por página: </label>
		
		<input type="text" id="items_per_page" name="items_per_page" value="<?php echo $view['paginator']->getItemsPerPage(); ?>" />
		
		<input type="submit" value="Actualizar">
	
	</form>
	
</div>