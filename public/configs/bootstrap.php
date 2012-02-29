<?php

// Project path
defined('PROJECT_PATH') || define('PROJECT_PATH', realpath(dirname(__FILE__) . '/../..'));

require_once PROJECT_PATH . '/library/manage/AutoloadManager.php';
AutoloadManager::getInstance()->register();

// Default environment
defined('DEFAULT_ENVIRONMENT') || define('DEFAULT_ENVIRONMENT', "development");

Library_Loader_AppLoader::load();

$content = Library_Loader_AppLoader::dispatchRequest();