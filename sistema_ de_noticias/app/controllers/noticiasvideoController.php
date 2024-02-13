<?php

class noticiasvideoController extends Controller {
    function __construct() {

    }
    function index() {


        $data = [
            'title' => 'Videos',
            'id' => 1,
            'bg' => 'blue'
        ];

        Views::render('video', $data);
    }

    function noticia() {

        // En tu controlador PHP (por ejemplo, videos.php)

        // Verifica si se han pasado los parámetros id y titulo en la URL
        if(isset($_GET['id']) && isset($_GET['titulo'])) {
            // Obtén los valores de los parámetros
            $id = $_GET['id'];
            $titulo2 = $_GET['titulo'];

            // Llama a la función videos con los parámetros obtenidos
            $data = new videoModel();
            $data->id = $id;
            $video = $data->selectvideosp();
            if($video) {

                $titulo = $video[0]['titulo'];

                if($titulo == $titulo2) {
                    
                    $data = [
                        'title' => 'Videos',
                        'id' => $video[0]['idvideo'],
                        'bg' => 'blue',
                        'titulo' => $video[0]['titulo'],
                        'autor' => $video[0]['autor'],
                        'descripcion' => $video[0]['descripcion_corta'],
                        'url_video' => $video[0]['url_video'],
                        'fechacrea' => $video[0]['fecha_de_creacion'],
                    ];

                    Views::render('vervideo', $data);




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