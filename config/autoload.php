<?php

/**
 * Système d'autoload. 
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction 
 * et chercher dans les divers dossiers (ici models, controllers, views, services) s'il trouve 
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */

spl_autoload_register(function ($className) {
    // On va voir dans le dossier Service si la classe existe.//
    if (file_exists('services/'.$className.'.php')) {
        require_once 'services/'.$className.'.php';
    }

     // Permet de voir si dans le dossier Model si la classe existe.//
    if (file_exists('models/'.$className.'.php')) {
        require_once 'models/'.$className.'.php';
    }
    
    //Permet de voir si dans le dossier models entity si la classe existe//
    if (file_exists('models/entity/'.$className.'.php')) {
        require_once 'models/entity/'.$className.'.php';
    }
    //Permet de voir si dans le dossier models/Manager si la classe existe//
    if (file_exists('models/manager/'.$className.'.php')) {
        require_once 'models/manager/'.$className.'.php';
    }

    // permet de voir dans si le dossier Controller si la classe existe.//
    if (file_exists('controllers/'.$className.'.php')) {
        require_once 'controllers/'.$className.'.php';
    }

     // permet de voir si dans le dossier View si la classe existe.//
    if (file_exists('views/'.$className.'.php')) {
        require_once 'views/'.$className.'.php';
    }
});