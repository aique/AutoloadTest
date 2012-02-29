<h2><?php echo Library_I18n_I18n::getText("screen_user_list_title"); ?></h2>

<ul>
	
	<?php echo $view["paginator"]->show(Library_Manage_ResourceManager::getURLData()->getParam("page")); ?>
	
</ul>