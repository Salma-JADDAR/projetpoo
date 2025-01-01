<?php

class Autoloader {

    public static function register() {
        spl_autoload_register(function ($class) {
            
            $file = __DIR__ . '/app/Entities/' . $class . '.php';

              if (file_exists($file)) {
                 require_once $file;
               } else {
                echo "Fichier $file introuvable";
            }
        });
    }
}
?>
