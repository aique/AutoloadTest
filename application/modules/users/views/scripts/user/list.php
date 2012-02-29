<h2><?php echo Library_I18n_I18n::getText("screen_user_list_title"); ?></h2>

<ul>

	<?php
	
		$page = Library_Manage_URLManager::getURLData()->getParam("page");
		$firstItemPosOnPage =  $view["paginator"]->getFirstItemPosOnPage($page);
		$lastItemPosOnPage = $firstItemPosOnPage + $view["paginator"]->getItemsPerPage() - 1;
	
	?>

	<?php for($i = $firstItemPosOnPage - 1 ; $i < $lastItemPosOnPage ; $i++)  : ?>
		
		<?php if(isset($view["users"][$i])) : ?>
		
			<li>Id : <?php echo $view["users"][$i]->id; ?> / Name: <?php echo $view["users"][$i]->name; ?></li>
			
		<?php endif; ?>
		
	<?php endfor; ?>
	
	<?php echo $view["paginator"]->showPagination(); ?>
	
</ul>