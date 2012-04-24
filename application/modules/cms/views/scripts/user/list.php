<h2><?php echo Library_Qframe_I18n_I18n::getText("screen_user_list_title"); ?></h2>

<?php

	$collection = $view->getContent("users");
	
	$paginator = $view->getContent("paginator");
	
	if(count($collection) > 0)
	{
		echo $paginator->standardPrint(Library_Qframe_Manage_ResourceManager::getRequestData()->getParam("page"));
		
		echo '<div id="users"><ul>';
		
		foreach($collection as $user)
		{
			echo '<li>' . $user->getPrinter()->paginationPrint() . '</li>';
		}
			
		echo '</ul></div>';
		
		echo $paginator->standardPrint(Library_Qframe_Manage_ResourceManager::getRequestData()->getParam("page"));
	}
	else
	{
		echo Library_Qframe_I18n_I18n::getText('screen_common_pagination_noresults');
	}

?>