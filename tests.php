<?php

require 'src\\autoload.php';
diaryAutoloader()->add('Aventura\\Diary', '.\\src\\');

exec('phpunit --bootstrap src\autoload.php --testdox-html testresults.html tests');

if (file_exists('testresults.html')) {
	echo file_get_contents('testresults.html');
}
