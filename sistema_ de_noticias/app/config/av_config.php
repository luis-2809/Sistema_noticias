<?php

// saber si esta si estamos trabajando de manera local o remota 
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));

// definir el timezone del sistema
date_default_timezone_set('America/Mexico_City');

// crear el lenguaje 
define('LANG', 'es');

//Ruta base de nuestro proyecto
define('BASEPATH', IS_LOCAL ? '/framework/' : '___EL BASE PATH EN PRODUCCION___');

//la sal del sistema
define('AUTH_SALT', 'avFramework');

//puerto y url del sitio
define('PORT', '80');
define('URL', IS_LOCAL ? 'http://127.0.0.1:' . PORT . '/framework/' : '___URL EN PRODUCCION___');

//rutas de directorios y archivos
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', getcwd() . DS);
define('APP', ROOT . 'app' . DS);
define('CONTROLLERS', APP . 'controllers' . DS);
define('FUNCTIONS', APP . 'functions' . DS);
define('CONFIG', APP . 'config' . DS);
define('CLASSES', APP . 'classes' . DS);
define('MODELS', APP . 'models' . DS);

define('TEMPLATES', ROOT . 'templates' . DS);
define('INCLUDES', TEMPLATES . 'includes' . DS);
define('MODULES', TEMPLATES . 'modules' . DS);
define('VIEWS', TEMPLATES . 'views' . DS);

//rutas de archivos assets base url
define('ASSETS', URL . 'assets/');
define('CSS', ASSETS . 'CSS/');
define('FAVICON', ASSETS . 'favicon/');
define('FONTS', ASSETS . 'fonts/');
define('IMG', ASSETS . 'img/');
define('JS', ASSETS . 'js/');
define('PLUGINS', ASSETS . 'plugins/');
define('UPLOADS', ASSETS . 'uploads/');
define('UPLOADS_PATH', IS_LOCAL ? 'C:\xampp\htdocs\framework\assets\uploads' : '/home/username/public_html/framework/assets/uploads');


//credenciales de la base de datos 
//set para conexion local o de desarrollo
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'gpm_tu_canal_v1');
define('LDB_USER', 'root');
define('LDB_PASS', '');
define('LDB_CHARSET', 'utf8mb4');

//set para conexion en produccion o servidor real
define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '___REMOTE DB___');
define('DB_USER', '___REMOTE DB___');
define('DB_PASS', '___REMOTE DB___');
define('DB_CHARSET', 'utf8mb4');

// el controlador por defecto, el metodo por defecto y el controlador de errores
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ERROR_CONTROLLER', 'error');
define('DEFAULT_METHOD', 'index');