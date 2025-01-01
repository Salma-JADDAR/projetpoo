<?php

class Autoloader {

    public static function register() {
        spl_autoload_register(function ($class) {
            
             $class = str_replace("App\\", "", $class);
             $class = str_replace("\\", "/", $class);
             $file = __DIR__ . "/app/" . $class . ".php";

              if (file_exists($file)) {
                 require_once $file;
               } else {
                echo "Fichier $file introuvable";
            }
        });
    }
}
?>
