<?php 

class contactoController extends Controller
{
    function __construct()
    {

    }
    function index()
    {
        
        
        $data = [
            'title' => 'Contacto',
            'id' => 1,
            'bg' => '_bg-base2'
        ];

        Views::render('contacto', $data);
    }

   

}