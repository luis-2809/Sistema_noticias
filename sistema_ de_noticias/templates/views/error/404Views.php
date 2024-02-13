<?php require_once INCLUDES . 'pagprincipal/inc_headernav.php' ?>




<div class="container-fluid">

    <div class=" row mt-5">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">

            <div class="_404Contenedor">
                <figure><img src="<?php echo IMG . '404_gpmtucanal.gif' ?>" class="img-fluid" alt=""></figure>
                <p>Lo sentimos, la página que buscas no fue encontrada.</p>
                <a href="<?php echo URL . 'home'; ?>">Volver al inicio</a>
            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>

    <hr>
    <div class="row mb-5 mt-5">
        <?php
        require_once INCLUDES . 'atajos/secciones.php';
        ?>
    </div>

</div>

<?php
require_once INCLUDES . 'pagprincipal/inc_footer.php'
    ?>