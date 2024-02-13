<?php

class Views{
    public static function render($view, $data =[]){
        $d=to_object($data);
        if(!is_file(VIEWS.CONTROLLER.DS.$view.'Views.php')){
            die(sprintf('No existe la vista %sViews en la carpeta %s',$view,CONTROLLER));
        }

        require_once VIEWS.CONTROLLER.DS.$view.'Views.php';
        exit();
    }
}