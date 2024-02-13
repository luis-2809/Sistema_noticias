<?php

class errorController extends Controller
{

    function __construct()
    {
        
    }
    function index(){
      
        $data=[
            'title'=>'pagina no encontrada'
        ];
        Views::render('404',$data);
    }
}