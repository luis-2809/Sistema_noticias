<?php

final class publicidadController extends Controller
{

    function __construct()
    {
        $session = Auth::validate();
        if (!$session) {
            Redirect::to('login');
        }
    }

    function index()
    {
        $date = [
            'title' => 'Visualizar Publicidad',
            'id' => 12
        ];

        Views::render('publicidad', $date);
    }

    function new()
    {
        $date = [
            'title' => 'Agregar Publicidad',
            'id' => 13
        ];

        Views::render('add', $date);
    }

    function add()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        
            $addpublicidad = new publicidadModel();
            $user = Users::fromSession();
            $addpublicidad->idusuario = $user->getId();
            $addpublicidad->titulo = $_POST["titulo"];
            $addpublicidad->empresa = $_POST["empresa"];
            $addpublicidad->descripcion = $_POST["descripcioncor"];

            $addpublicidad->estado = $_POST["estado"];

            $urldestacada = uploadImage($_FILES["imgdes"], "/publicidad");
            if (!isJson($urldestacada)) {
               $addpublicidad->img_destacada = $urldestacada;
               $addpublicidad->add();
               echo json_encode(['success' => 'success', 'msg' => 'El contenido ah sido agregado correctamente']);
            }
            else{
                echo $urldestacada;
            }
            


    }

    function selectpublicidad()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $data = new publicidadModel();
        $user = Users::fromSession();
        $data->idusuario = $user->getId();
        $contenido = $data->selecttodos();
        $response = array(
            "data" => $contenido
        );
        print_r(json_encode($response));
    }

    function verpublicidad()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $iddata = $_POST['iddata'];
        $mostrar = new publicidadModel();
        $mostrar->id = $iddata;
        $array = $mostrar->select();
        echo json_encode($array);
    }

    function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        if (empty($_POST['titulo2'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El título está vacío']);
            exit;
        }
        if (empty($_POST['empresa2'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El nombre de la empresa está vacía']);
            exit;
        }
        if (empty($_POST['descripcioncor1'])) {
            echo json_encode(['error' => 'error', 'msg' => 'La descripción está vacía']);
            exit;
        }
        if (empty($_POST['estado1'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El estado está vacío']);
            exit;
        }
        $imgdes = $_FILES['imgdes1'];
        $publicidad = new publicidadModel();
        $publicidad->id = $_POST['idpublicidad'];
        if ($imgdes['error'] == UPLOAD_ERR_NO_FILE) {
            $urlimg = $publicidad->select();
            foreach ($urlimg as $key) {
                $imgdes = $key['img_destacada'];
            }
        }


        
            $publicidad->titulo = $_POST['titulo2'];
            $publicidad->descripcion = $_POST['descripcioncor1'];
            $publicidad->estado = $_POST['estado1'];
            $publicidad->empresa = $_POST['empresa2'];


            if ($_FILES["imgdes1"]["error"] == UPLOAD_ERR_NO_FILE) {
                $publicidad->img_destacada = $imgdes;
            } else {

                $urlimgdes = uploadImage($_FILES["imgdes1"], "/publicidad");


                if (!isJson($urlimgdes)) {
                    $urldes = $publicidad->select();
                    foreach ($urldes as $data) {
                        $urldele = UPLOADS_PATH . $data["img_destacada"];
                        if (file_exists($urldele)) {
                            unlink($urldele);
                        }

                    }
                }
                else{
                    echo $urlimgdes;
                    exit;
                }
                $publicidad->img_destacada = $urlimgdes;
            }
            $update = $publicidad->update();
            if ($update) {
                echo json_encode(['success' => 'success', 'msg' => 'Datos actualizados correctamente']);
            } else {
                echo json_encode(['error' => 'error', 'msg' => 'Error al guardar en la base de datos']);
            }

        


    }

    function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $idcont = $_POST["eliminarpublicidad"];

        $contenido = new publicidadModel();
        $contenido->id = $idcont;
        $iduser = Users::fromSession();
        $contenido->idusuario = $iduser->getId();
        $data = $contenido->select();
        $imgdestacada = null;
        foreach ($data as $key) {
            $imgdestacada = $key["img_destacada"];
        }



        if ($imgdestacada != null) {
            $urldele = UPLOADS_PATH . $imgdestacada;
            if (file_exists($urldele)) {
                unlink($urldele);
            }

            $contenido->delete();
            echo json_encode(['success' => 'success', 'msg' => 'La publicidad ah sido eliminada correctamente']);
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'Error al eliminar la publicidad']);
        }

    }
}
