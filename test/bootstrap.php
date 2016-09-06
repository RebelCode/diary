<?php

error_reporting(E_ALL | E_STRICT);

// Set timezone
date_default_timezone_set('UTC');

// Load autoloader
require_once implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), '..', 'vendor', 'autoload.php'));
