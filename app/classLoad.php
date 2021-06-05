<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

spl_autoload_register(function ($myClass) {
    if (file_exists('../model/'.$myClass.'.php')) {
        include('../model/'.$myClass.'.php');
    }
    if (file_exists('../controller/'.$myClass.'.php')) {
        include('../controller/'.$myClass.'.php');
    }
    if (file_exists('../app/'.$myClass.'.php')) {
        include('../app/'.$myClass.'.php');
    }
    if (file_exists('../lib/'.$myClass.'.php')) {
        include('../lib/'.$myClass.'.php');
    }
    if (file_exists('../service/'.$myClass.'.php')) {
        include('../service/'.$myClass.'.php');
    }
});

require('../lib/pagination.php');
