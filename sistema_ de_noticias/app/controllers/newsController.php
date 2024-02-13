<?php

class newsController extends Controller
{
    private $session;

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
            'title' => 'Visualizar noticia',
            'id' => 9
        ];

        Views::render('contenido', $date);
    }
    function new()
    {
        $date = [
            'title' => 'Agregar noticia',
            'id' => 10
        ];

        Views::render('add', $date);
    }
    function add()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        if (empty($_POST['ckeditor'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El contenido está vacío']);
            exit;
        }

        $ckeditor = $_POST['ckeditor'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descripcioncor = $_POST['descripcioncor'];
        $imgdes = $_FILES['imgdes'];
        $estado = $_POST['estado'];
        $user = Users::fromSession();
        $idusu = $user->getId();
        $contenido = new contenidoModel();
        $contenido->titulo = $titulo;
        $contenido->autor = $autor;
        $contenido->descripcion_corta = $descripcioncor;
        $contenido->estado = $estado;
        $contenido->idusuario = $idusu;

        $url = uploadImage($imgdes);
        if (!isJson($url)) {

            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML('<?xml encoding="utf-8" ?>' . $ckeditor, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $doc->getElementsByTagName('img');

            $oembeds = $doc->getElementsByTagName('oembed');

            if ($oembeds->length > 0) {
                handleroembeds($oembeds, $doc);
            }

            if ($images->length > 0) {
                $urlsImagenes = handlerimgupload($images);
                if (isJson($urlsImagenes)) {
                    echo $urlsImagenes;
                    return;
                }
            }
            $contenidoActualizado = $doc->saveHTML();
            $contenido->contenido = $contenidoActualizado;
            // Aquí insertas $url en la base de datos
            $contenido->img_destacada = $url;
            $contenido->deletemeses();
            $idcontenido = $contenido->add();            
            if ($images->length > 0) {
                if ($idcontenido) {
                    foreach ($urlsImagenes as $key) {
                        $addimg = new imgModel;
                        $addimg->idcontenido = $idcontenido;
                        $addimg->ruteimg = $key;
                        $addimg->add();
                    }
                }
            }
            echo json_encode(['success' => 'success', 'msg' => 'Datos guardados con éxito']);
        } else {
            echo $url;
        }

    }
    function iframe()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        Views::render('ckeditor');
    }
    function selectnews()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $data = new contenidoModel();
        $user= Users::fromSession();
        $data->idusuario=$user->getId();
        $contenido = $data->selecttodos();
        $response = array(
            "data" => $contenido
        );
        print_r(json_encode($response));

    }
    function verconte()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $iddata = $_POST['iddata'];
        $mostrar = new contenidoModel();
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
        if (empty($_POST['ckeditor'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El contenido está vacío']);
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
            echo json_encode(['error' => 'error', 'msg' => 'El estado esta vacío']);
            exit;
        }

        $idconte = $_POST['idcont'];
        $contenido = new contenidoModel();
        $contenido->id = $idconte;

        $user = Users::fromSession();

        $contenido->idusuario = $user->getId();
        $contenido->titulo = $_POST["titulo2"];
        $contenido->autor = $_POST["autor2"];
        $contenido->descripcion_corta = $_POST["descripcioncor1"];
        $contenido->estado = $_POST["estado1"];



        $urlimgdes = null;
        if ($_FILES["imgdes1"]["error"] == UPLOAD_ERR_NO_FILE) {
            $urldes = $contenido->select();
            foreach ($urldes as $data) {
                $urlimgdes = $data["img_destacada"];
            }

        } else {

            $urlimgdes = uploadImage($_FILES["imgdes1"]);
            if (!isJson($urlimgdes)) {
                $urldes = $contenido->select();
                foreach ($urldes as $data) {
                    $urldele = UPLOADS_PATH . $data["img_destacada"];
                    if (file_exists($urldele)) {
                        unlink($urldele);
                    }

                }
            }

        }

        if (isJson($urlimgdes)) {
            echo $urlimgdes;
            exit;
        }

        if ($urlimgdes != null) {


            $ckeditor = $_POST['ckeditor'];
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML('<?xml encoding="utf-8" ?>' . $ckeditor, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $doc->getElementsByTagName('img');

            $oembeds = $doc->getElementsByTagName('oembed');

            if ($oembeds->length > 0) {
                handleroembeds($oembeds, $doc);
            }

            $imgupdate = [];
            $imgdelete = [];


            $arrayimg = [];
            foreach ($images as $img) {
                $arrayimg[] = $img->getAttribute('src');
            }
            $arrayimguploads = new imgModel();
            $arrayimguploads->idcontenido = $idconte;
            $associativeArray = $arrayimguploads->select();

            $indexedArray = array_map(function ($record) {
                return UPLOADS . $record['ruteimg'];
            }, $associativeArray);

            ////var_dump($associativeArray);

            $arrayupdate = array_diff($arrayimg, $indexedArray);
            if (count($arrayupdate) > 0) {
                $imgupdate = updateimgupload($arrayupdate);


                if (isJson($imgupdate)) {
                    echo $imgupdate;
                    return;
                }
                foreach ($images as $index => $img) {
                    $imgSrc = $img->getAttribute('src');
                    if (preg_match('/^data:image\/(.*?);base64,/', $imgSrc)) {
                        // Solo actualiza las que eran base64 (es decir, las que procesaste)
                        if (isset($imgupdate[$index])) {
                            $img->setAttribute('src', UPLOADS . $imgupdate[$index]);
                        }
                    }
                }
            }

            $arraydelete = array_diff($indexedArray, $arrayimg);
            if (count($arraydelete) > 0) {
                foreach ($arraydelete as $filePath) {
                    $filePath = str_replace(UPLOADS, "", $filePath);
                    $filePath = UPLOADS_PATH . '/' . $filePath;
                    echo $filePath;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    } else {
                        echo "no existe";
                    }
                }
                $imgdelete = $arraydelete;
            }

            $contenidoActualizado = $doc->saveHTML();
            $contenido->contenido = $contenidoActualizado;
            // Aquí insertas $url en la base de datos
            $contenido->img_destacada = $urlimgdes;
            $contenido->update();

            if (count($imgupdate) > 0) {
                foreach ($imgupdate as $key) {
                    $addimg = new imgModel;
                    $addimg->idcontenido = $idconte;
                    $addimg->ruteimg = $key;
                    $addimg->add();
                }
            }

            if (count($imgdelete) > 0) {
                foreach ($imgdelete as $key) {
                    $addimg = new imgModel;
                    $addimg->idcontenido = $idconte;
                    $addimg->ruteimg = str_replace(UPLOADS, "", $key);
                    $addimg->delete();
                }
            }



            echo json_encode(['success' => 'success', 'msg' => 'Datos guardados con éxito']);

        } else {
            echo json_encode(['error' => 'error', 'msg' => 'Error al subir la imagen destacada']);
        }


    }
    function deletecont()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $idcont = $_POST["eliminarcont"];

        $contenido = new contenidoModel();
        $contenido->id = $idcont;
        $iduser = Users::fromSession();
        $contenido->idusuario = $iduser->getId();
        $data = $contenido->select();
        $imgdestacada = null;
        foreach ($data as $key) {
            $imgdestacada = $key["img_destacada"];
        }

        $imgcont = new imgModel();
        $imgcont->idcontenido = $idcont;
        $imgdeletecont = $imgcont->select();

        if ($imgdestacada != null) {
            $urldele = UPLOADS_PATH . $imgdestacada;
            if (file_exists($urldele)) {
                unlink($urldele);
            }

            if (!empty($imgdeletecont)) {
                $indexedArray = array_map(function ($record) {
                    return UPLOADS . $record['ruteimg'];
                }, $imgdeletecont);

                foreach ($indexedArray as $key) {
                    $urldele = UPLOADS_PATH . '/' . $key;
                    if (file_exists($urldele)) {
                        unlink($urldele);
                    }
                }
            }
            $contenido->delete();
            echo json_encode(['success' => 'success', 'msg' => 'El contenido ah sido eliminado correctamente']);
        }
        else{
            echo json_encode(['error' => 'error', 'msg' => 'Error al eliminar el contenido']);
        }

    }

    function graficas() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }


        $conn = new contenidoModel();
        $datos = $conn->selectgrafix();
        echo json_encode($datos);
    }
}