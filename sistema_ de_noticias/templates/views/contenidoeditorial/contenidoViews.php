<?php
require_once INCLUDES . 'pagprincipal/inc_headernav.php';


?>


<div class="container-fluid">

    <div class=" pt-4 container-fluid px-5 _paddingverpublis">
        <div class="row">
            <div class="card pt-3 col-lg-9" style="border: none;">
                <h2><b>Contenido Editorial</b></h2>
                <div class="container-fluid p-2">

                    <?php
                    if (!empty($_REQUEST['name'])) {
                        $_REQUEST['name'];
                    } else {
                        $_REQUEST['name'] = '1';
                    }
                    if ($_REQUEST['name'] == "") {
                        $_REQUEST["name"] = "1";
                    }
                    $data = new contenidoModel();
                    $videos = $data->selectcontenido();
                    if ($videos) {
                        $tamanoarray = count($videos);
                    } else {
                        $tamanoarray = 0;
                    }
                    $registros = 15;
                    $pagina = $_REQUEST['name'];

                    if (is_numeric($pagina)) {
                        $inicio = (($pagina - 1) * $registros);
                    } else {
                        $inicio = 0;


                    }

                    $data->inicio = $inicio;
                    $data->registro = $registros;
                    $datosvideo = $data->selectcontenidoli();
                    $paginas = ceil($tamanoarray / $registros);

                    if (is_array($datosvideo) && count($datosvideo) > 0) {

                        echo '<div class="container-cards row">';
                        foreach ($datosvideo as $key) {
                            ?>
                            <div class=" card col-lg-4 mb-3 text-white _arial " style="border: none; ">
                                <a class="text-decoration-none"
                                    href="<?php echo URL . 'contenidoeditorial/noticia?' . 'id=' . $key['id'] . '&titulo=' . $key['titulo'] ?>">
                                    <div class=" rounded-4 border _selectcard p-1 my-3" style="">
                                        <span class="d-flex  justify-content-end  pe-1" style="color:#737477">
                                            <?php $fechaConHora = $key['fecha_de_creacion'];
                                            $fechaSinHora = date("Y-m-d", strtotime($fechaConHora));
                                            echo $fechaSinHora; ?>
                                        </span>
                                        <img src="<?php echo UPLOADS . $key["img_destacada"] ?>" class="card-img-top" alt="...">
                                        <div class="card-body" style="padding: none !important;">
                                            <h5 class="card-title" style="color: #222222;">
                                                <b>
                                                    <?php echo $key['titulo'] ?>
                                                </b>
                                            </h5>
                                            <p class="card-text" style="color:#000000;">
                                                <?php echo $key['descripcion_corta'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        echo '</div>';
                    } else {
                        // Manejo de la situación donde $datosvideo no es un array válido
                        echo 'No hay datos disponibles.';
                    }
                    ?>

                    <div class="container-fluid col-12">
                        <?php

                        if ($tamanoarray != 0) {
                            // Calcula el número total de páginas
                            $paginas = ceil($tamanoarray / $registros);

                            // Verifica si hay más de una página antes de mostrar la navegación
                            if ($paginas > 1) {
                                echo '<ul class="pagination pg-dark justify-content-center pb-5 pt-5 mb-0" style="float=none;">';
                                echo '<li>';

                                if ($_REQUEST['name'] != '1') {
                                    $ant = $_REQUEST['name'] - 1;
                                    echo '<a class="page-link" aria-label="previous" href="' . URL . 'contenidoeditorial?name=' . $ant . '"><span aria-hidden="true" >&laquo;</span><span class="sr-only">anterior</span></a>';

                                    if ($pagina > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="' . URL . 'contenidoeditorial?name=' . ($pagina - 1) . '">' . $ant . '</a></li>';
                                    }
                                }

                                echo '<li class="page-item active"><a class="page-link">' . $_REQUEST['name'] . '</a></li>';

                                if ($pagina < $paginas && $paginas > 1) {
                                    $sigui = $_REQUEST["name"] + 1;
                                    echo '<li class="page-item"><a class="page-link" href="' . URL . 'contenidoeditorial?name=' . ($pagina + 1) . '">' . $sigui . '</a></li>';
                                    echo '<li class="page-item"><a class="page-link" aria-label="Next" href="' . URL . 'contenidoeditorial?name=' . ($pagina + 1) . '"><span aria-hidden="true" >&raquo;</span><span class="sr-only">siguiente</span></a></li>';
                                }

                                echo '</li>';
                                echo '</ul>';
                            }
                            if ($_REQUEST['name'] > $paginas) {
                                Redirect::to("contenidoeditorial?name=1");
                                exit;
                            }
                        }
                        ?>



                    </div>

                </div>

                <div class="alert alert-success mb-5" role="alert">
                    ¿Quieres ver nuestra seccion de videos? ¡Haz clic <a href="<?php echo URL . "noticiasvideo" ?>"
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