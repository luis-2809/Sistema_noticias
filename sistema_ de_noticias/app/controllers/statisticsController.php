<?php

class statisticsController extends Controller
{
    private $session;
    function __construct()
    {
        $this->session = Auth::validate();
        if (!$this->session) {
            Redirect::to('login');
        }
    }
    function index()
    {
        $date = [
            'title' => 'Estadisticas',
            'id' => 8
        ];

        Views::render('statistics',$date);

    }
    
}