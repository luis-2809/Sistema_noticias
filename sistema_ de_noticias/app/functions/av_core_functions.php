<?php

function to_object($array)
{
    return json_decode(json_encode($array));
}

function get_sitename()
{
    return 'GPM tu canal';
}

function now()
{
    return date('Y-m-d H:i:s');
}

/**
 * hase output como body como json
 * 
 * @param array $json
 * @param boolean $die
 */
function json_output($json, $die = true)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');

    if (is_array($json)) {
        $json = json_encode($json);
    }

    echo $json;

    if ($die) {
        die;
    }

    return true;
}

/**
 * construye un nuevo script json 
 * @param integer $status 
 * @param array $data
 * @param string $msg
 * @return mixed
 */
function json_build($status = 200, $data = null, $msg = '', $error_code = null)
{
    if (empty($msg) || $msg = '') {
        switch ($status) {
            case 200:
                $msg = "Ok";
                break;
            case 201:
                $msg = "Created";
                break;
            case 400:
                $msg = "Invalit request";
                break;
            case 403:
                $msg = "Access denied";
                break;
            case 404:
                $msg = "not found";
                break;
            case 500;
                $msg = "Internal server error";
                break;
            case 550;
                $msg = "permission denied";
                break;
            default:
                break;
        }
    }

    $json = [
        'status' => $status,
        'error' => false,
        'msg' => $msg,
        'data' => $data
    ];

    if (in_array($status, [200, 201, 400, 403, 404, 500, 550])) {
        $json['error'] = true;
    }

    if ($error_code !== null) {
        $json['error'] = $error_code;
    }

    return json_encode($json);
}

function uploadImage($file, $urlcar = "/contenido/destacadas",$width = 800, $height = 533)
{
    $target_dir = UPLOADS_PATH . $urlcar;

    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // Genera un nombre de archivo único
    $uniqueName = uniqid() . "." . $imageFileType;
    $target_file = $target_dir . "/" . $uniqueName;
    $url = $urlcar . "/" . $uniqueName;

    // Verificar si la imagen es real
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return json_encode(['error' => 'error', 'msg' => 'Imagen de extención inválida inserte png, jpg']);
        ;
    }

    // Verificar si ya existe el archivo (aunque con uniqid() es muy poco probable)
    if (file_exists($target_file)) {
        return json_encode(['error' => 'error', 'msg' => 'El nombre imagen destacada ya existe']);
        ;
    }

    // Verificar tamaño de archivo (por ejemplo, menos de 2MB)
    if ($file["size"] > 2000000) {
        return json_encode(['error' => 'error', 'msg' => 'El tamaño máximo de imagen destacada es de 2MB']);
        ;
    }

    // Permitir ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return json_encode(['error' => 'error', 'msg' => 'Imagen de extención inválida inserte png, jpg']);
    }

    // Validar dimensiones
    list($width_orig, $height_orig) = getimagesize($file["tmp_name"]);
    if ($width_orig != $width || $height_orig != $height) {
        return json_encode(['error' => 'error', 'msg' => 'Las dimensiones de la imagen deben ser de ' . $width . 'x' . $height . ' píxeles.']);
    }

    // Intentar mover el archivo cargado al directorio de destino
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $url; // Retorna la ruta del archivo en el servidor
    } else {
        return json_encode(['error' => 'error', 'msg' => 'Error al subir imagen']);
        ; // En caso de error
    }

}
function isJson($string)
{
    if (!is_string($string)) {
        return false;
    }
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}
function handlerimgupload($images)
{
    $urlsImagenes = [];
    $validImageTypes = ['png', 'jpg', 'jpeg'];
    $desiredWidth = 600;
    $desiredHeight = 400;

    foreach ($images as $img) {
        $imgSrc = $img->getAttribute('src');

        if (preg_match('/^data:image\/(.*?);base64,/', $imgSrc, $matches)) {
            $imageType = $matches[1];

            if (!in_array($imageType, $validImageTypes)) {
                return json_encode(['error' => 'error', 'msg' => 'La imagen insertada en el contenido no cuenta con el formato jpg o png']);
            }

            $imageData = base64_decode(str_replace('data:image/' . $imageType . ';base64,', '', $imgSrc));

            // Obtener las dimensiones sin utilizar imagecreatefromstring
            $dimensions = @getimagesizefromstring($imageData);
            if (!$dimensions) {
                return json_encode(['error' => 'error', 'msg' => 'Error al obtener las dimensiones de la imagen']);
            }

            list($width, $height) = $dimensions;

            // Verificar las dimensiones
            if ($width != $desiredWidth || $height != $desiredHeight) {
                return json_encode(['error' => 'error', 'msg' => 'Las dimensiones de la imagen deben ser de ' . $desiredWidth . 'x' . $desiredHeight . ' píxeles.']);
            }

            // Guardar la imagen
            $imageName = uniqid() . '.' . $imageType;
            $imagePath = UPLOADS_PATH . "/contenido/contenidoedi/" . $imageName;
            file_put_contents($imagePath, $imageData);

            // Agregar la ruta de la imagen al array
            $urlsImagenes[] = "contenido/contenidoedi/" . $imageName;

            // Reemplazar la referencia de la imagen en el contenido con el ID de la imagen (o con la URL si prefieres)
            $imgurl = UPLOADS . "contenido/contenidoedi/" . $imageName;
            $img->setAttribute('src', $imgurl);
        }
    }

    return $urlsImagenes;
}




function handleroembeds($oembeds, $doc)
{
    foreach ($oembeds as $oembed) {
        $url = $oembed->getAttribute('url');
        $videoId = null;

        // Si es un enlace simple de YouTube
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_\-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // Si es un enlace corto youtu.be
        elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_\-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // Si es un enlace embed de YouTube
        elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_\-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }

        if ($videoId !== null) {
            $embedUrl = "https://www.youtube.com/embed/" . $videoId;

            $iframe = $doc->createElement('iframe');
            $iframe->setAttribute('width', '560');
            $iframe->setAttribute('height', '315');
            $iframe->setAttribute('src', $embedUrl);
            $iframe->setAttribute('frameborder', '0');
            $iframe->setAttribute('allowfullscreen', '');

            // Reemplazar el elemento oembed con el iframe
            $oembed->parentNode->replaceChild($iframe, $oembed);
        }
    }
}


function is_assoc_array($arr)
{
    if (!is_array($arr)) {
        return false;
    }
    return array_keys($arr) !== range(0, count($arr) - 1);
}


function updateimgupload($images)
{
    $urlsImagenes = [];
    $validImageTypes = ['png', 'jpg', 'jpeg'];
    $desiredWidth = 600;
    $desiredHeight = 400;

    foreach ($images as $imgSrc) {
        if (preg_match('/^data:image\/(.*?);base64,/', $imgSrc, $matches)) {
            $imageType = $matches[1];

            if (!in_array($imageType, $validImageTypes)) {
                return json_encode(['error' => 'error', 'msg' => 'La imagen insertada en el contenido no cuenta con el formato jpg o png']);
            }

            $imageData = base64_decode(str_replace('data:image/' . $imageType . ';base64,', '', $imgSrc));

            // Obtener las dimensiones sin utilizar imagecreatefromstring
            $dimensions = @getimagesizefromstring($imageData);
            if (!$dimensions) {
                return json_encode(['error' => 'error', 'msg' => 'Error al obtener las dimensiones de la imagen']);
            }

            list($width, $height) = $dimensions;

            // Verificar las dimensiones
            if ($width != $desiredWidth || $height != $desiredHeight) {
                return json_encode(['error' => 'error', 'msg' => 'Las dimensiones de la imagen deben ser de ' . $desiredWidth . 'x' . $desiredHeight . ' píxeles.']);
            }

            $imageName = uniqid() . '.' . $imageType;
            $imagePath = UPLOADS_PATH . "/contenido/contenidoedi/" . $imageName;

            // Guardar la imagen
            file_put_contents($imagePath, $imageData);

            $urlsImagenes[] = "contenido/contenidoedi/" . $imageName;
        } else {
            // Esta imagen ya tiene una URL y no necesita ser procesada, así que simplemente continúa con la siguiente imagen.
            continue;
        }
    }

    return $urlsImagenes;
}


function isYouTubeURL($url)
{
    $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
    return preg_match($pattern, $url);
}

function convertToEmbedURL($url)
{
    // Si ya está en formato embed
    if (strpos($url, "youtube.com/embed/") !== false) {
        return $url;
    }
    // Para URLs en formato largo (https://www.youtube.com/watch?v=ID_VIDEO)
    if (preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches)) {
        $id = $matches[1];
    }
    // Para URLs en formato corto (https://youtu.be/ID_VIDEO)
    elseif (preg_match('/youtu\.be\/([^\\?\\&]+)/', $url, $matches)) {
        $id = $matches[1];
    }
    // Construir la URL embed
    $embedURL = 'https://www.youtube.com/embed/' . $id;

    return $embedURL;
}

function showNewsInCards($resultados)
{
    foreach ($resultados as $key => $resultado) {
        // Iniciar una nueva fila en cada tercer elemento (índice 0 es el primer elemento)
        if ($key % 3 == 0) {
            echo '<div class="row">';
        }

        // Agregar una columna Bootstrap para cada elemento
        echo '<div class="col-md-4">';
        echo '<div class="card" style="width: 18rem;">';
        echo '<img src="' . $resultado['imagen'] . '" class="card-img-top" alt="Imagen de la noticia">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $resultado['titulo'] . '</h5>';
        echo '<p class="card-text">' . $resultado['contenido'] . '</p>';
        echo '<a href="' . $resultado['enlace'] . '" class="btn btn-primary">Leer más</a>';
        echo '</div></div>';
        echo '</div>';

        // Cerrar la fila después de cada tercer elemento
        if (($key + 1) % 3 == 0 || ($key + 1) == count($resultados)) {
            echo '</div>';
        }
    }
}
