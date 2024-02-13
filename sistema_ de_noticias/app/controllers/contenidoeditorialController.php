<?php

class contenidoeditorialController extends Controller
{
    function __construct()
    {

    }
    function index()
    {
        
        
        $data = [
            'title' => 'Contenido Editorial',
            'id' => 1,
            'bg' => 'blue'
        ];

        Views::render('contenido', $data);
    }

    function noticia() {

        // En tu controlador PHP (por ejemplo, videos.php)

        // Verifica si se han pasado los parámetros id y titulo en la URL
        if(isset($_GET['id']) && isset($_GET['titulo'])) {
            // Obtén los valores de los parámetros
            $id = $_GET['id'];
            $titulo2 = $_GET['titulo'];

            // Llama a la función videos con los parámetros obtenidos
            $data = new contenidoModel();
            $data->id = $id;
            $video = $data->selectcontenidosp();
            if($video) {

                $titulo = $video[0]['titulo'];

                if($titulo == $titulo2) {
                    

                    
                    $data = [
                        'title' => 'Contenido Editorial',
                        'id' => $video[0]['id'],
                        'bg' => 'blue',
                        'titulo' => $video[0]['titulo'],
                        'autor' => $video[0]['autor'],
                        'contenido' => $video[0]['contenido'],
                        'fechacrea' => $video[0]['fecha_de_creacion'],
                    ];

                      Views::render('vercontenido', $data);




                } else {
                    Redirect::to('error');
                }

            } else {
                Redirect::to('error');
            }
        } else {
            // Manejo de error si los parámetros no están presentes
            Redirect::to('error');
        }

    }
}