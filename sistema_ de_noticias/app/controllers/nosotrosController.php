<?php 

class nosotrosController extends Controller
{
    function __construct()
    {

    }
    function index()
    {
        
        
        $data = [
            'title' => 'Nosotros',
            'id' => 1,
            'bg' => '_bg-base2'
        ];

        Views::render('nosotros', $data);
    }

   

}