<?php
require_once INCLUDES . 'pagprincipal/inc_headernav.php';
?>
<div class="container-fluid">

    <div class=" pt-4 container-fluid px-5 _paddingverpublis">
        <div class="row">
            <div class="card pt-3 col-lg-9" style="border: none;">
                <h2 class="text-center"><b>Tendencias</b></h2>
                <h3>Videos</h3>
                <div class="container-fluid p-2">

                    <?php

                    $data = new videoModel();
                    $datosvideo = $data->videostendencia();
                    if ($datosvideo) {
                        echo '<div class="container-cards row">';
                        foreach ($datosvideo as $key) {
                            ?>

                            <div class=" card col-lg-4 mb-3 text-white _arial " style="border: none; ">
                                <a class="text-decoration-none"
                                    href="<?php echo URL . 'noticiasvideo/noticia?' . 'id=' . $key['idvideo'] . '&titulo=' . $key['titulo'] ?>">
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
                        echo 'No hay datos disponibles.';
                    }
                    ?>

                </div>

                <div class="alert alert-success mb-5" role="alert">
                    ¿Quieres ver más videos ? ¡Haz clic <a href="<?php echo URL . "noticiasvideo" ?>"
                        class="alert-link">aquí</a> para
                    explorar más!
                </div>





                <h3>Contenido Editorial</h3>
                <div class="container-fluid p-2">

                    <?php
                    $data = new contenidoModel();
                    $datosvideo = $data->contenidotendencia();
                    if ($datosvideo) {
                        echo '<div class="container-cards row">';


                        foreach ($datosvideo as $key) {
                            ?>
                            <div class=" card col-lg-4 mb-3 text-white _arial " style="border: none; ">
                                <a href="<?php echo URL . 'contenidoeditorial/noticia?' . 'id=' . $key['id'] . '&titulo=' . $key['titulo'] ?>"
                                    class="text-decoration-none">
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
                        echo 'No hay datos disponibles.';
                    }

                    ?>

                </div>

                <div class="alert alert-success" role="alert">
                    ¿Quieres ver más contenidos editoriales ? ¡Haz clic <a
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