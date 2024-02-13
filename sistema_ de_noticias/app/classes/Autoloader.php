<?php

class Autoloader
{
    /**
     * Metodo encargado de Ejecutar el autocargador de forma estatica
     * 
     * @return void
     * 
     */
    public static function init()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Metodo encargado de Ejecutar el autocargador de forma estatica
     * 
     * @return void
     * 
     */
    private static function autoload($class_name)
    {
        if (is_file(CLASSES . $class_name . '.php')) {
            require_once CLASSES . $class_name . '.php';
        } elseif (is_file(CONTROLLERS . $class_name . '.php')) {
            require_once(CONTROLLERS . $class_name . '.php');
        } elseif (is_file(MODELS . $class_name . '.php')) {
            require_once(MODELS . $class_name . '.php');
        } 
        return;

    }
}