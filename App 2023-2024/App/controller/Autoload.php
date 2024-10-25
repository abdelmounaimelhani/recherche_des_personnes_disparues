<?php 

class Autoloader
{     
    public static function Require_controller() {
        spl_autoload_register(function ($class) {
            // Convert namespace separators to directory separators
            $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            // Assuming your controllers are in the 'App/controller' directory
            $file = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php'; 
            
            if (file_exists($file)) {
                require_once $file;
            }
        });
    }

    public static function Require_Model() {
        spl_autoload_register(function ($class) {
            // Convert namespace separators to directory separators
            $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            
            // Assuming your models are in the 'App/Model' directory
            $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . $class . '.php';
            
            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}