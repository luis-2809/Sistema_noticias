<?php

class Av
{

    //propiedades del framework
    private $framework = 'Av Framework';
    private $version = '1.0.0';
    private $uri = [];

    //la funcion principal que se ejecuta al instanciar nuestra clase 
    function __construct()
    {
        
        $this->init();
        //parametroget
        $this->filter_url();
    }

    /** 
     * Metodo para ejecutar cada *metodo* de forma subsecuente
     * @return void 
     */
    private function init()
    {
        $this->init_session();
        $this->init_load_config();
        $this->init_load_functions();
        $this->init_autoload();
        $this->init_csrf();
        $this->dispatch();
    }

    /** 
     * Metodo para iniciar la session en el sistema 
     * @return void 
     */
    private function init_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return;
    }

    /**
     * Metodo para cargar archivo de configuracion
     * @return void 
     */
    private function init_load_config()
    {
        $file = 'av_config.php';
        if (!is_file('app/config/' . $file)) {
            die(sprintf('El archivo no se encuentra, es requerido para que funcione' . $file . $this->framework));
        }
        //cargamos el archivo de configuracion
        require_once 'app/config/' . $file;

        return;
    }

    /**
     * Metodo para cargar todas las funciones del siste a y del usuario
     * @return void 
     */
    private function init_load_functions()
    {
        $file = 'av_core_functions.php';
        if (!is_file(FUNCTIONS . $file)) {
            die(sprintf('El archivo no se encuentra, es requerido para que funcione' . $file . $this->framework));
        }
        //cargamos el archivo de functions core
        require_once FUNCTIONS . $file;

        $file = 'av_custom_functions.php';
        if (!is_file(FUNCTIONS . $file)) {
            die(sprintf('El archivo no se encuentra, es requerido para que funcione' . $file . $this->framework));
        }
        //cargamos el archivo de functions custom
        require_once FUNCTIONS . $file;
        return;
    }

    /**
     * Metodo para cargar todos los archivos de forma automatica
     * @return void 
     */
    private function init_autoload()
    {
        require_once CLASSES . 'Autoloader.php';
        Autoloader::init();
        // require_once CLASSES . 'Db.php';
        // require_once CLASSES . 'Model.php';
        // require_once CLASSES . 'Views.php';
        // require_once CLASSES . 'Controller.php';
        // require_once CONTROLLERS . DEFAULT_CONTROLLER . 'Controller.php';
        //  require_once CONTROLLERS . DEFAULT_ERROR_CONTROLLER . 'Controller.php';
        // require_once CONTROLLERS . 'usersController.php'; 
        return;
    }


    /**
     * Metodo para crear un nuevo token de la sesion de usuario
     * @return void 
     */

    private function init_csrf()
    {
      $csrf = new Csrf();
    }



    /**
     * Metodo para filtrar y descomponer los elementos de la  url y uri
     * @return void 
     */
    private function filter_url()
    {
        if (isset($_GET['uri'])) {
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri, '/');
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/', strtolower($this->uri));
            return $this->uri;

        }

    }

    /**
     * Metodo para ejecutar y cargar de maner automatica el controlador solicitado por el usuario
     * su metodo y pasar parametros a el
     * @return void 
     */
    private function dispatch()
    {
        //filtrar url  y separar la uri
        $this->filter_url();

        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        //Nesesitamos saber si se esta pasando el nombre de un controlador en nuertro uri
        //$this->uri[0]  es el controlador en cuestion
        if (isset($this->uri[0])) {
            $current_controller = $this->uri[0]; //usuarios Controller.php
            unset($this->uri[0]);
        } else {
            $current_controller = DEFAULT_CONTROLLER; //home Controller.php
        }

        //Ejecucion del controlador
        //Verificamos si existe una clase con el controlador solicitado

        $controller = $current_controller . 'Controller';
        if (!class_exists($controller)) {
            $current_controller = DEFAULT_ERROR_CONTROLLER; //para que el CONTROLLER sea error
            $controller = DEFAULT_ERROR_CONTROLLER . 'Controller';

        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        //Ejecucion del metodo solicitado 
        if (isset($this->uri[1])) {
            $method = str_replace('-', '_', $this->uri[1]);
            //existe o no el metodo dentro de la clase a ejecutar (controllador)
            if (!method_exists($controller, $method)) {
                $controller = DEFAULT_ERROR_CONTROLLER . 'Controller';
                $current_method = DEFAULT_METHOD; //index
                $current_controller = DEFAULT_ERROR_CONTROLLER;
            } else {
                $current_method = $method;
            }
            unset($this->uri[1]);
        } else {
            $current_method = DEFAULT_METHOD; // index
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //crear constantes para utilizar mas adelante 
        define('CONTROLLER', $current_controller);
        define('METHOD', $current_method);

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //ejecutando controlador y metodo segun se aga la peticion 
        $controller = new $controller;
        $param = array_values(empty($this->uri) ? [] : $this->uri);

        //llamada al metodo que solicita el usuario
        if (empty($param)) {
            call_user_func([$controller, $current_method]);
        } else {
            call_user_func_array([$controller, $current_method], $param);
        }

        return;
    }

    /**
     * 
     * Correr el framework
     * @return void 
     */
    public static function fly()
    {
        $av = new self();
        return;
    }
}