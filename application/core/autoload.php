<?php

class autoload
{
    public static function register()
    {
        if (function_exists('__autoload')) {
            spl_autoload_register('__autoload');
        }

        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            return spl_autoload_register(array('autoload', 'load'), true, true);
        } else {
            return spl_autoload_register(array('autoload', 'load'));
        }
    }

    private static function type($str)
    {
        $list = array(
            'm' => 'models',
            'c' => 'controllers',
            'a' => 'api',
            'l' => 'libraries',
        );

        return ($list[$str]) ?: '';
    }

    private static function load($className)
    {
        if (class_exists($className, false)) {
            return false;
        }

        $className = ltrim($className, '\\');
        $fileName = '';

        $dectectClass = array();
        preg_match('/(^[mca]?)([\w]*)/', $className, $dectectClass);

        if (empty($dectectClass)) {
            require '../vendor/autoload.php';
        } else {
            $type = $dectectClass[1];
            $class = $dectectClass[2];

            if (!empty($class) && !empty($type)) {
                $fileName .= APPPATH . self::type($type) . DIRECTORY_SEPARATOR . $class . '.PHP';
            } else {
                $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
                $fileName = APPPATH . 'core' . DIRECTORY_SEPARATOR . $fileName;
            }

            if ((file_exists($fileName) === false) || (is_readable($fileName) === false)) {
                return false;
            } else {
                require $fileName;
            }
        }
    }
}

autoload::register();
