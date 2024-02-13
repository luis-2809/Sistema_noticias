<?php
require_once INCLUDES . 'dashboard/inc_headerdash.php';
?>
<div style="">
  <h2 class="_arial _colortext my-2 mx-2">USUARIOS</h2>
</div>
<div class="container-fluid _contenddark rounded-3 py-2 _colortext fs-6 _arial">
  <table id="miTabla" class="table py-3" style="">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Estado</th>
        <th>Fecha de registro</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody id="mitbody">
    </tbody>
  </table>
</div>



<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
  tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Actualización de datos</h1>
        <button type="button" id="closedmodal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class=" error" id="errorcontenido2"></div>
        <div class="" style=" ">
          <form action="" class="add_contenido" id="formupdate" data-form-id="form-update-user2">
            <div class="row mt-3">
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for="" class="mb-1  fs-6 _arial"><b>Nombre: </b></label>
                  <input class="form-control  " type="text" name="nombre" id="nombre" placeholder="Nombre">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for="" class="mb-1  fs-6 _arial"><b>Apellidos: </b></label>
                  <input class="form-control " id="apellidos" name="apellidos" type="text" placeholder="Apellidos">
                </div>
              </div>
              
            </div>
            <div class="row pb-4">
              <div class="col-sm-6">
                <div class="mb-3 mx-3">
                  <label for="" class="mb-1  fs-6 _arial"><b>Selecciona un rol</b></label>
                  <select class="form-control " name="rol" id="rol">
                    <option value="">-- Selecciona una opción --</option>
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">

                <div class="mb-3 mx-3">
                  <label for="" class="mb-1  fs-6 _arial"><b>Selecciona un estado</b></label>
                  <select class="form-control " name="estado" id="estado">
                    <option value="">-- Selecciona una opción --</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                  </select>
                </div>
                <div class="mb-3 mx-3">
                </div>
              </div>
            </div>

            <input type="hidden" id="idu" name="idu">

            <div class=" d-flex justify-content-center mb-3">
              <input class="btn btn-success" type="submit" name="btncontenido" value="Agregar" id="btncontenido">
            </div>
          </form>
          <br>
          <h5>Cambiar contraseña</h5>
          <div class="modal-body _arial">
            <div class="">
              <div class=" error" id="errorcontenido2"></div>
              <span class="py-2">La nueva contraseña tiene que tener al menos: </span><br>
              <span class="py-2">* 1 caracter especial</span><br>
              <span class="py-2">* 1 letra mayuscula</span><br>
              <span class="py-2">* 1 letra minuscula</span><br>
              <span class="py-2">* 1 caracter numerico</span><br>
              <span class="py-2">* Minimo 8 caracteres</span><br>
              <br>
            </div>
            <div class="" style=" ">
              <form action="" class="add_contenido _arial" id="" data-form-id="form-update-userc2">
                <div class="row mt-3">
                  <div class="col-sm-6">
                    <div class="mb-3 mx-3">
                      <label for=""><b>Contraseña Actual:</b></label><br>
                      <span id="contrasena2"></span>
                      <input class="form-control  " type="hidden" name="contrasena" id="contrasena"
                        autocomplete="Contraseña actual">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3 mx-3">
                      <label for=""><b>Nueva contraseña:</b></label><br>
                      <input class="form-control " id="contrasena1" name="contrasena1" type="password"
                        autocomplete="Nueva Contraseña">
                    </div>
                  </div>
                </div>

                <div class=" d-flex justify-content-center">
                  <input class="btn btn-success" type="submit" name="btncontenido3" value="Actualizar"
                    id="btncontenido3">
                </div>
                <div>
                  <input type="hidden" id="idc" name="idc">
                </div>
              </form>
            </div>
          </div>


          <br>
          <h5>Cambiar correo</h5>
          <div class="modal-body _arial">
            <div class="">
              <div class=" error" id="errorcontenido2"></div>

            </div>
            <div class="" style=" ">
              <form action="" class="add_contenido _arial" id="formupdatec2" data-form-id="form-update-userco2">
                <div class="row">
                  <label for=""><b>Ingrese el nuevo correo:</b></label><br>
                  <input class="form-control my-3" id="email3" name="email3" type="email"
                    autocomplete="Nueva Contraseña">
                </div>

                <div class=" d-flex justify-content-center">
                  <input class="btn btn-success" type="submit" name="btncontenido6" value="Actualizar"
                    id="btncontenido6">
                </div>
                <div>
                  <input type="hidden" id="ida" name="ida">
                </div>
              </form>
            </div>
          </div>


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
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Eliminar usuario</h1>
        <button type="button" id="elclosed" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" data-form-id="form-delete-user">

        <div class="modal-body d-flex justify-content-center ">
          <p id="texteli"></p>
          <input id="eliminaruser" name="eliminaruser" type="hidden">
        </div>
        <div class="modal-footer d-flex justify-content-center">

          <input class="btn btn-danger" type="submit" name="btnecontenido" value="Eliminar usuario" id="btnecontenido">

        </div>
      </form>
    </div>
  </div>
</div>
<?php
require_once INCLUDES . 'dashboard/inc_footerdash.php';
?>