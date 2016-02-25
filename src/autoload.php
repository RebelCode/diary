<?php

if (!function_exists('diaryAutoloader')) {

    /**
     * Gets the Diary library's autoloader instance.
     * 
     * @return Aventura\Diary\Autoloader
     */
    function diaryAutoloader()
    {
        /* @var $instance Aventura\Diary\Autoloader */
        static $instance = null;

        if (is_null($instance)) {
            $instance = newDiaryAutoloader();
            $instance->register();
        }

        return $instance;
    }

    /**
     * 
     * @return Aventura\Diary\Autoloader
     */
    function newDiaryAutoloader()
    {
        $className = 'Aventura\\Diary\\Autoloader';
        if (!class_exists($className)) {
            $dir = dirname(__FILE__);
            $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
            $classPath = "{$dir}/{$classPath}.php";
            require_once $classPath;
        }
        return new $className();
    }

}

$dir = dirname(__FILE__);
diaryAutoloader()->add('Aventura\\Diary', $dir);
