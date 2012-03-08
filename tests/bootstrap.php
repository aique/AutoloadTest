<?php

// Project path
defined('PROJECT_PATH') || define('PROJECT_PATH', realpath(dirname(__FILE__) . '/..'));

require_once PROJECT_PATH . '/library/app/Autoloader.php';
Library_App_Autoloader::getInstance()->register();

// Default environment
defined('DEFAULT_ENVIRONMENT') || define('DEFAULT_ENVIRONMENT', Library_Consts_Environment::TESTING_ENV);

Library_App_Loader::load();