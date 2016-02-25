<?php

$dir = dirname(__FILE__);
$baseDir = realpath( sprintf('%s\\..\\src', $dir) );
$testDir = realpath( sprintf('%s\\src', $dir) );

// Load autoload file
require "$baseDir\\autoload.php";

// Set up default autoloader
diaryAutoloader()->add('Aventura\\Diary', $baseDir);
diaryAutoloader()->add('Aventura\\Diary\\Testing', $testDir);

// Set timezone
date_default_timezone_set('UTC');
