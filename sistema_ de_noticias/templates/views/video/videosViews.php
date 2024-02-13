<?php
require_once INCLUDES . 'dashboard/inc_headerdash.php';
?>
<div style="">
  <h2 class="_arial _colortext my-2 mx-2">VIDEOS</h2>
</div>
<div class="container-fluid _contenddark rounded-3 py-2 _colortext fs-6 _arial">
  <table id="miTabla" class="table py-3" style="">
    <thead>
      <tr>
        <th>titulo</th>
        <th>estado</th>
        <th>vistas</th>
        <th>fecha</th>
        <th>Nombre</th>
        <th>Opciones</th>

      </tr>
    </thead>
    <tbody id="mitbody">
    </tbody>
  </table>
</div>

<div class="modal fade" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true"
  aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Visualizacion de datos</h1>
        <button type="button" class="btn-close" id="closedmodal2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class=" error" id="errorcontenido"></div>
        <div class="" style=" ">
          <form action="" class="add_contenido" data-form-id="form-add-contenido">
            <div class="row mt-3">
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Titulo:</b></label><br>
                  <span id="titulo"></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Autor:</b></label><br>
                  <span id="autor"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Descripcion corta:</b></label><br>
                  <span id="descor"></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Vistas:</b></label><br>
                  <span id="vistas"></span>
                </div>
                <div class="mb-3 mx-3">
                  <label for=""><b>Estado:</b></label><br>
                  <span id="estado"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="mb-4 mx-3">
                  <label for="" class="mb-1  fs-6 _arial"><b>Imagen destacada</b></label><br>
                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 d-flex justify-content-center">
                      <img src="" class="_imgdes" id="imgdes" alt="" style="width: 100%; margin: 50px,50px,0px,0px; ">
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mx-3 mt-2 mb-3">
              <label class="fs-4 p-3 _arial  d-flex justify-content-center" for=""><b>Video</b></label>


              <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                  <div class="ratio ratio-16x9">
                    <iframe src="" frameborder="0" id="mivideo"></iframe>
                  </div>
                </div>
                <div class="col-lg-1"></div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-sm-4">
                <div class="mb-3 mx-3">
                  <label for=""><b>Usuario:</b></label><br>
                  <span id="user"></span>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3 mx-3">
                  <label for=""><b>fecha de creación:</b></label><br>
                  <span id="fcreacion"></span>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3 mx-3">
                  <label for=""><b>fecha de actualización:</b></label><br>
                  <span id="factua"></span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
  tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Actualización de Video</h1>
        <button type="button" id="closedmodal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class=" error" id="errorcontenido2"></div>
        <div class="" style=" ">
          <form action="" class="add_contenido" id="formupdate" data-form-id="form-update-video">
            <div class="row mt-3">
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Titulo:</b></label><br>
                  <input class="form-control  " type="text" name="titulo2" id="titulo2" placeholder="Titulo">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Autor:</b></label><br>
                  <input class="form-control " id="autor2" name="autor2" type="text" placeholder="Autor">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for=""><b>Descripcion corta:</b></label><br>
                  <textarea class="form-control " id="descripcioncor1" name="descripcioncor1"
                    placeholder="Descripcion corta" cols="30" rows="3"></textarea>
                </div>
              </div>
              <div class="col-sm-6">

                <div class="mb-3 mx-3">
                  <label for=""><b>Estado:</b></label><br>
                  <select class="form-control " name="estado1" id="estado1">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
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
                  <span class="">*La imagen destacada debe de ser de 800X533 px</span>
                  <br>
                  <label for=""><b>Imagen destacada:</b><span> (Opcional)</span></label><br>
                  <input class="form-control " type="file" name="imgdes1" id="imgdes1">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-4 mx-3">
                  <label for=""><b>Visualización de Imagen destacada mas resiente:</b></label><br>
                  <img class="img img-fluid" src="" id="imgdes2" alt="">
                </div>
              </div>
            </div>

            <div class=" row mx-3 mb-3">
              <div class="col-sm-6">
                <div class="mb-4 mx-3">
                  <label class=" mb-3 _arial " for=""><b>Agregar video</b><span> (Opcional)</span></label>
                  <input class="form-control " type="text" name="mivideo2" id="mivideo2">
                </div>
              </div>
              <div class="col-sm-6">

              </div>
            </div>
            <div class="mb-4 mx-3">
              <label for=""><b>Visualización de video mas resiente:</b></label><br>
              <iframe src="" class="_iframe" id="video1" frameborder="0"></iframe>
            </div>

            <div class=" d-flex justify-content-center mb-3">
              <input class="btn btn-success" type="submit" name="btncontenido" value="Actualizar Video"
                id="btncontenido">
            </div>
            <div>
              <input type="hidden" id="idvideo" name="idvideo">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
  tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Eliminar Video</h1>
        <button type="button" id="elclosed" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" data-form-id="form-delete-video">

        <div class="modal-body d-flex justify-content-center ">
          <p id="texteli"></p>
          <input id="eliminarvideo" name="eliminarvideo" type="hidden">
        </div>
        <div class="modal-footer d-flex justify-content-center">

          <input class="btn btn-danger" type="submit" name="btnecontenido" value="Eliminar video" id="btnecontenido">

        </div>
      </form>
    </div>
  </div>
</div>
<?php
require_once INCLUDES . 'dashboard/inc_footerdash.php';
?>