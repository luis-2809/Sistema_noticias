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

$davideo = new videoModel();
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
                <h2 class="text-info-emphasis"><b>Videos</b></h2>

                <h1>
                    <b>
                        <?php echo $d->titulo; ?>
                    </b>
                </h1>
                <p class="py-2 fs-5 text-dark">
                    <?php echo $d->descripcion; ?>
                </p>

                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="ratio ratio-16x9">
                            <iframe src="<?php echo $d->url_video; ?>" allowfullscreen frameborder="0"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <p class="text-secondary py-3">
                    <?php
                    $fechaConHora = $d->fechacrea;
                    ;
                    $fechaSinHora = date("Y-m-d", strtotime($fechaConHora));
                    echo 'Por ' . $d->autor . ', GPMtuCanal Publicado el: ' . $fechaSinHora; ?>

                </p>

                <div class="alert alert-success mb-5" role="alert">
                    ¿Quieres ver nuestros mas de nuestros videos ? ¡Haz clic <a
                        href="<?php echo URL . "noticiasvideo" ?>" class="alert-link">aquí</a> para
                    explorar más!
                </div>
                <div class="alert alert-info mb-5" role="alert">
                    ¿Quieres ver nuestros contenidos editoriales ? ¡Haz clic <a
                        href="<?php echo URL . "contenidoeditorial" ?>" class="alert-link">aquí</a> para
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