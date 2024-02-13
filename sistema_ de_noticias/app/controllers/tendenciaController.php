<?php

class tendenciaController extends Controller
{
    function __construct()
    {

    }
    function index()
    {
        
        
        $data = [
            'title' => 'Tendencia',
            'id' => 1,
            'bg' => 'blue'
        ];

        Views::render('tendencia', $data);
    }
}