<h2><?php echo Library_Qframe_I18n_I18n::getText("screen_user_detail_title", array($view->getContent("user")->getName())); ?></h2>

<?php echo $view->getContent("user")->getPrinter()->profilePrint(); ?>