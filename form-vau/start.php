<?php

// Загрузка классов «на лету»

function __autoload($class_name)
{

    $filename = strtolower($class_name) . '.php';
    $file = site_path . 'classes' . DIRSEP . $filename;

    if (file_exists($file) == false) {
        return false;
    }
    include($file);
}

error_reporting(E_ALL);

if (version_compare(phpversion(), '5.1.0', '<') == true) {
    die ('PHP5.1 Only');
}


// Константы:

define('DIRSEP', DIRECTORY_SEPARATOR);
define('DB_USER', 'feedback_usr');
define('DB_PASSWORD', '1234rewq');
define('DB_HOST', 'localhost');
define('DB_NAME', 'feedback');
define('DB_VALIDATION', 'column_validation');
define('DB_VALID_TYPE', 'valid_type');
define('DB_INPUTS', 'inputs');
define('DB_FORMS', 'forms');
define('DB_INPUT_TYPES', 'input_types');
define('DB_INPUT_VALIDATION', 'input_validation');


// Узнаём путь до файлов сайта

$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define('site_path', $site_path);

$registry = new Registry;