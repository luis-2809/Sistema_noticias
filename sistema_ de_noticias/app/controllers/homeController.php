<?php

class homeController extends Controller
{
    function __construct()
    {

    }
    function index()
    {


        $data = [
            'title' => 'Home',
            'id' => 1,
            'bg' => '_bg-base2'
        ];

        Views::render('home', $data);
    }

    function buscar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $buscar = new buscadorModel();

        if (isset($_POST["buscar"])) {
            if (!empty($_POST["buscar"])) {
                $buscar->texto = "%".$_POST["buscar"]."%";
                $datos = $buscar->select();


                if ($datos) {
                    $htmlResult = ''; // Variable para almacenar el código HTML resultante

                    foreach ($datos as $key) {
                        // Estructurar cada coincidencia en una etiqueta <a>
                        $direc= ($key['tipo']=='video')? 'noticiasvideo/noticia' : 'contenidoeditorial/noticia';
                        $htmlResult .= '<a class=" text-decoration-none" style="color:#3b4758;" href="'.URL.$direc.'?id='.$key['id'].'&titulo='.$key['titulo'].'"> 
                                        <div class=" rounded-2 py-2 px-1" style="border: 2px solid #0b2239;">' . $key['titulo'] . '</div></a><br> ';
                        // Puedes agregar más información según tus necesidades
                    }

                    echo '<div class=" mx-2">'.$htmlResult.'</div>';
                } else {
                    echo 'No hay resultados';
                }
            }
            else {
                // Si el término de búsqueda está vacío, no mostrar resultados
                echo '';
            }
        } else {
            echo '';
        }


    }


}