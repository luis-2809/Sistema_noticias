<?php
require_once INCLUDES . 'dashboard/inc_headerdash.php';
?>

<div style="">
  <h2 class="_arial _colortext my-2 mx-2">AGREGAR CONTENIDO EDITORIAL</h2>
</div>
<div class="container-fluid _contenddark rounded-3 py-2">
  <div class=" error" id="errorcontenido"></div>
  <div class="" style=" ">
    <form action="" class="add_contenido" data-form-id="form-add-contenido">
      <div class="row mt-3">
        <div class="col-sm-6">
          <div class="mb-3 mx-3">
            <input class="form-control _inputs " type="text" name="titulo" id="titulo" placeholder="Titulo">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3 mx-3">
            <input class="form-control _inputs" id="autor" name="autor" type="text" placeholder="Autor">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="mb-3 mx-3">
            <textarea class="form-control _inputs" id="descripcioncor" name="descripcioncor"
              placeholder="Descripcion corta" name="" id="" cols="30" rows="3"></textarea>
          </div>
        </div>
        <div class="col-sm-6">

          <div class="mb-3 mx-3">
            <select class="form-control _inputs" name="estado" id="estado">
              <option value="">-- Selecciona una opción --</option>
              <option value="activo">Activo</option>
              <option value="inactivo">inactivo</option>
            </select>
          </div>
          <div class="mb-3 mx-3">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="mb-4 mx-3">
            <br>
            <span class="_colortext">*La imagen destacada debe de ser de 800X533 px</span>
            <br>
            <br>
            <label for="" class="mb-1 _colortext fs-6 _arial">Imagen destacada</label>
            <input class="form-control _inputs" type="file" name="imgdes" id="imgdes">
          </div>
        </div>
        <div class="col-sm-6"> </div>
      </div>

      <div class="mx-3 mb-3">
        <br>
        <span class="_colortext">*Las imagenes del contenido deben de ser de 600X400 px</span>
        <br>
        <label class="fs-4 mb-3 _arial _colortext d-flex justify-content-center" for="">Agregar contenido</label>

        <iframe frameborder="0" style="width: 100%; height: 60vh" id="iframe2"></iframe>
      </div>

      <div class=" d-flex justify-content-center mb-3">
        <input class="btn btn-success" type="submit" name="btncontenido" value="Agregar Contenido Editorial"
          id="btncontenido">
      </div>
    </form>
  </div>
</div>



<?php
require_once INCLUDES . 'dashboard/inc_footerdash.php';
?>