<?php
require_once INCLUDES . 'dashboard/inc_headerdash.php';
?>

<div style="">
  <h2 class="_arial _colortext my-2 mx-2">Estadisticas</h2>
</div>
<div class="container-fluid _contenddark rounded-3 py-2">
  <div class=" error" id="errorpublicidad"></div>
  <div class="m-4" style=" ">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8 rounded-3 p-3" style="background-color:#ffffff;">
        <canvas id="graficoVistas"  style=" width: 100%;"></canvas>
      </div>
      <div class="col-md-8 rounded-3 mt-5 p-3" style="background-color:#ffffff;">
        <canvas id="graficoVistas2"  style=" width: 100%;"></canvas>
      </div>
    </div>
  </div>
</div>



<?php
require_once INCLUDES . 'dashboard/inc_footerdash.php';
?>