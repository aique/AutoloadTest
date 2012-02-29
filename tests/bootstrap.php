<?php

// Project path
defined('PROJECT_PATH') || define('PROJECT_PATH', realpath(dirname(__FILE__) . '/..'));

require_once PROJECT_PATH . '/library/manage/AutoloadManager.php';
AutoloadManager::getInstance()->register();

// Default environment
defined('DEFAULT_ENVIRONMENT') || define('DEFAULT_ENVIRONMENT', Application_Consts_EnvironmentConst::TESTING_ENV);

Library_Loader_AppLoader::load();