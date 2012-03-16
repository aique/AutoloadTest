<h2><?php echo Library_I18n_I18n::getText("screen_user_list_title"); ?></h2>

<?php echo $view["paginator"]->standardPrint(Library_Manage_ResourceManager::getRequestData()->getParam("page")); ?>