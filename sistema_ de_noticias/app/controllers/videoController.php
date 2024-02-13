<?php

class VideoController
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
            'title' => 'Visualizar Videos',
            'id' => 12
        ];

        Views::render('videos', $date);
    }
    function new()
    {
        $date = [
            'title' => 'Agregar Video',
            'id' => 11
        ];

        Views::render('add', $date);

    }

    function add()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $urlvideo = $_POST["video"];

        if (isYouTubeURL($urlvideo)) {
            $addvideo = new videoModel();
            $user = Users::fromSession();
            $addvideo->idusuario = $user->getId();
            $addvideo->titulo = $_POST["titulo"];
            $addvideo->autor = $_POST["autor"];
            $addvideo->descripcion_corta = $_POST["descripcioncor"];

            $addvideo->estado = $_POST["estado"];

            $videoyoutube = convertToEmbedURL($urlvideo);
            $addvideo->url_video = $videoyoutube;

            $urldestacada = uploadImage($_FILES["imgdes"], "/img_des_video");
            if (!isJson($urldestacada)) {
                $addvideo->img_destacada = $urldestacada;
                $addvideo->deletemeses();
                $addvideo->add();
                echo json_encode(['success' => 'success', 'msg' => 'El video ah sido agregado correctamente']);
            } else {
                echo $urldestacada;
            }
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'Url no válida, inserte una de Youtube']);
        }


    }

    function selectvideo()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $data = new videoModel();
        $user = Users::fromSession();
        $data->idusuario = $user->getId();
        $contenido = $data->selecttodos();
        $response = array(
            "data" => $contenido
        );
        print_r(json_encode($response));
    }

    function vervideo()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $iddata = $_POST['iddata'];
        $mostrar = new videoModel();
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
        if (empty($_POST['autor2'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El autor está vacío']);
            exit;
        }
        if (empty($_POST['descripcioncor1'])) {
            echo json_encode(['error' => 'error', 'msg' => 'La descripción está vacía']);
            exit;
        }
        $descripcion = $_POST['descripcioncor1'];

        if (strlen($descripcion) > 160) {
            echo json_encode(['error' => 'error', 'msg' => 'La descripción debe tener como máximo 160 caracteres']);
            exit;
        }
        if (empty($_POST['estado1'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El estado está vacío']);
            exit;
        }
        $imgdes = $_FILES['imgdes1'];
        $urlvideo = $_POST['mivideo2'];
        $video = new videoModel();
        $video->id = $_POST['idvideo'];
        if ($imgdes['error'] == UPLOAD_ERR_NO_FILE) {
            $urlimg = $video->select();
            foreach ($urlimg as $key) {
                $imgdes = $key['img_destacada'];
            }
        }
        if (empty($urlvideo)) {
            $videos = $video->select();
            foreach ($videos as $key) {
                $urlvideo = $key['url_video'];
            }
        }


        if (isYouTubeURL($urlvideo)) {
            $video->titulo = $_POST['titulo2'];
            $video->autor = $_POST['autor2'];
            $video->descripcion_corta = $_POST['descripcioncor1'];
            $video->estado = $_POST['estado1'];
            $rutevideo = convertToEmbedURL($urlvideo);
            $video->url_video = $rutevideo;
            if ($_FILES["imgdes1"]["error"] == UPLOAD_ERR_NO_FILE) {
                $video->img_destacada = $imgdes;
            } else {

                $urlimgdes = uploadImage($_FILES["imgdes1"], "/img_des_video");



                if (!isJson($urlimgdes)) {
                    $urldes = $video->select();
                    foreach ($urldes as $data) {
                        $urldele = UPLOADS_PATH . $data["img_destacada"];
                        if (file_exists($urldele)) {
                            unlink($urldele);
                        }
                    }

                } else {
                    echo $urlimgdes;
                    exit;
                }
                $video->img_destacada = $urlimgdes;
            }
            $update = $video->update();
            if ($update) {
                echo json_encode(['success' => 'success', 'msg' => 'Datos actualizados correctamente']);
            } else {
                echo json_encode(['error' => 'error', 'msg' => 'Error al actualizar en la base de datos']);
            }

        } else {
            echo json_encode(['error' => 'error', 'msg' => 'Url de youtube invalida']);
            return;
        }


    }

    function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $idcont = $_POST["eliminarvideo"];

        $contenido = new videoModel();
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
            echo json_encode(['success' => 'success', 'msg' => 'El video ah sido video correctamente']);
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'Error al eliminar el video']);
        }

    }

    function graficas() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }


        $conn = new videoModel();
        $datos = $conn->selectgrafix();
        echo json_encode($datos);
    }

}