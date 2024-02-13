<?php
require_once INCLUDES . 'pagprincipal/inc_headernav.php';


date_default_timezone_set("America/Mexico_city");

// Verificar si la cookie de usuario_id ya está presente
if (!isset($_COOKIE['usuario_id'])) {
    // Si no hay cookie, asignar un identificador único y establecer la cookie
    $usuario_id = uniqid();
    setcookie('usuario_id', $usuario_id, time() + (30 * 24 * 60 * 60), '/');
} else {
    // Obtener el identificador de usuario desde la cookie
    $usuario_id = $_COOKIE['usuario_id'];
}

$id = $d->id;

$davideo = new contenidoModel();
$davideo->id = $id;
$davideo->fechavista = date("Y-m-d  H:i:s");
//$davideo->usuario_id = $usuario_id;

$sqlConsultar = $davideo->selectvista();



if ($sqlConsultar) {
    $fecha = "";
    foreach ($sqlConsultar as $key) {
        $fecha = $key["fecha_vista"];
    }
    $fechaRegistro = $fecha;
    $fechaActual = date("Y-m-d H:i:s");
    $nuevaFecha = strtotime($fechaRegistro . "+ 30 seconds");
    $nuevaFecha = date("Y-m-d H:i:s", $nuevaFecha);

    if ($fechaActual >= $nuevaFecha) {
        $sqlInsertar = $davideo->newvista();
    }
} else {
    $sqlIser = $davideo->newvista();
}

$visitas = $davideo->selectview2();
$contar = 0;

foreach ($visitas as $key) {
    $contar = $key['total'];
}

echo $contar;


?>
<div class="container-fluid">

    <div class=" pt-4 container-fluid px-5 _paddingverpublis">
        <div class="row">
            <div class="card pt-3 col-lg-9" style="border: none;">
                <h2 class="text-info-emphasis"><b>Contenido editorial</b></h2>

                <div>
                    <h1>
                        <b>
                            <?php echo $d->titulo; ?>
                        </b>
                    </h1>
                    <div class="py-2 fs-5 text-dark">
                        <?php echo $d->contenido; ?>

                    </div>
                    <p class="text-secondary py-3">
                        <?php
                        $fechaConHora = $d->fechacrea;
                        ;
                        $fechaSinHora = date("Y-m-d", strtotime($fechaConHora));
                        echo 'Por ' . $d->autor . ', GPMtuCanal Publicado el: ' . $fechaSinHora; ?>

                    </p>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Obtener todos los elementos figure dentro del contenedor
                        var figures = document.querySelectorAll('.py-2.fs-5.text-dark figure');

                        figures.forEach(function (figure) {
                            // Obtener el elemento iframe dentro de figure
                            var iframe = figure.querySelector('iframe');

                            if (iframe) {
                                // Crear un nuevo div
                                var divWrapper = document.createElement('div');

                                // Agregar las clases al nuevo div
                                divWrapper.classList.add('ratio', 'ratio-16x9');

                                // Obtener los atributos width y height del iframe
                                var widthAttribute = iframe.getAttribute('width');
                                var heightAttribute = iframe.getAttribute('height');

                                // Quitar los atributos width y height del iframe
                                iframe.removeAttribute('width');
                                iframe.removeAttribute('height');

                                // Crear la estructura adicional con las clases de Bootstrap
                                var rowDiv = document.createElement('div');
                                rowDiv.classList.add('row');

                                var col1Div = document.createElement('div');
                                col1Div.classList.add('col-lg-1');

                                var col2Div = document.createElement('div');
                                col2Div.classList.add('col-lg-10');

                                // Envolver el iframe con el nuevo div y agregar a la estructura adicional
                                figure.replaceChild(divWrapper, iframe);
                                divWrapper.appendChild(iframe);

                                col2Div.appendChild(divWrapper);
                                rowDiv.appendChild(col1Div);
                                rowDiv.appendChild(col2Div);

                                // Insertar la estructura adicional antes de figure
                                figure.parentNode.insertBefore(rowDiv, figure);
                            }

                            // Agregar la clase 'text-center' si no existe
                            if (!figure.classList.contains('text-center')) {
                                figure.classList.add('text-center');
                            }

                            // Obtener el elemento img dentro de figure
                            var img = figure.querySelector('img');

                            // Agregar la clase 'img-fluid' al elemento img si no existe
                            if (img && !img.classList.contains('img-fluid')) {
                                img.classList.add('img-fluid');
                            }
                        });
                    });

                </script>
                <div class="alert alert-success mb-5" role="alert">
                    ¿Quieres ver nuestros contenidos editoriales ? ¡Haz clic <a
                        href="<?php echo URL . "contenidoeditorial" ?>" class="alert-link">aquí</a> para
                    explorar más!
                </div>
                <div class="alert alert-info mb-5" role="alert">
                    ¿Quieres ver nuestros videos ? ¡Haz clic <a href="<?php echo URL . "noticiasvideo" ?>"
                        class="alert-link">aquí</a> para
                    explorar más!
                </div>

            </div>
            <div class="col-lg-3">
                <div class="container-fluid">
                    <h3 class="d-flex justify-content-center">Sección de publicidad</h3>
                    <?php
                    require_once INCLUDES . 'atajos/publicidad.php';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row mb-5 mt-5">


        <?php
        require_once INCLUDES . 'atajos/secciones.php';
        ?>

    </div>
</div>
<?php
require_once INCLUDES . 'pagprincipal/inc_footer.php';

?>