<?php

// Project path
defined('PROJECT_PATH') || define('PROJECT_PATH', realpath(dirname(__FILE__) . '/..'));

require_once PROJECT_PATH . '/library/qframe/app/Autoloader.php';
Library_Qframe_App_Autoloader::getInstance()->register();

// Default environment
defined('DEFAULT_ENVIRONMENT') || define('DEFAULT_ENVIRONMENT', Library_Qframe_Consts_Environment::TESTING_ENV);

Library_Qframe_App_Loader::load();

$content = Library_Qframe_App_Dispatcher::dispatchRequest(Library_Qframe_Manage_ResourceManager::getRequestData());