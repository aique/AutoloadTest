<h2><?php echo Library_Qframe_I18n_I18n::getText("screen_user_list_title"); ?></h2>

<?php echo $view->getContent("paginator")->standardPrint(Library_Qframe_Manage_ResourceManager::getRequestData()->getParam("page")); ?>