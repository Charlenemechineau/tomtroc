<?php

spl_autoload_register(function ($className) {
    if (file_exists('services/'.$className.'.php')) {
        require_once 'services/'.$className.'.php';
    }

    if (file_exists('models/'.$className.'.php')) {
        require_once 'models/'.$className.'.php';
    }

    if (file_exists('models/entity/'.$className.'.php')) {
        require_once 'models/entity/'.$className.'.php';
    }

    if (file_exists('models/manager/'.$className.'.php')) {
        require_once 'models/manager/'.$className.'.php';
    }


    if (file_exists('controllers/'.$className.'.php')) {
        require_once 'controllers/'.$className.'.php';
    }

    if (file_exists('views/'.$className.'.php')) {
        require_once 'views/'.$className.'.php';
    }
});