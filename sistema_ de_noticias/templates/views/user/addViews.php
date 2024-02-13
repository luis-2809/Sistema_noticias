<?php
require_once INCLUDES . 'dashboard/inc_headerdash.php';
?>

<div style="">
    <h2 class="_arial _colortext my-2 mx-2">AGREGAR USUARIOS</h2>
</div>
<div class="container-fluid _contenddark rounded-3 py-2">
    <div class=" error" id="erroruser"></div>
    <div class="" style=" ">
        <form action="" class="add_contenido" data-form-id="form-add-user">
            <div class="row mt-3">
                <div class="col-sm-4">
                    <div class="mb-3 mx-3">
                        <input class="form-control _inputs " type="text" name="nombre" id="nombre" placeholder="Nombre">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="mb-3 mx-3">
                        <input class="form-control _inputs" id="apellidos" name="apellidos" type="text"
                            placeholder="Apellidos">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3 mx-3">
                        <input class="form-control _inputs" id="email" name="email" type="text" autocomplete="" placeholder="Correo">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 mx-3">
                        <label for="" class="mb-1 _colortext fs-6 _arial">Selecciona un rol</label>
                        <select class="form-control _inputs" name="rol" id="rol">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="usuario">Usuario</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="mb-3 mx-3">
                        <label for="" class="mb-1 _colortext fs-6 _arial">Selecciona un estado</label>
                        <select class="form-control _inputs" name="estado" id="estado">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="mb-3 mx-3">
                    </div>
                </div>
            </div>

            <div class="px-3 py-4 _arial _colortext">
                <span class="py-2">La nueva contraseña tiene que tener al menos: </span><br>
                <span class="py-2">* 1 caracter especial</span><br>
                <span class="py-2">* 1 letra mayuscula</span><br>
                <span class="py-2">* 1 letra minuscula</span><br>
                <span class="py-2">* 1 caracter numerico</span><br>
                <span class="py-4">* Minimo 8 caracteres</span><br>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-4 mx-3">
                        <label for="" class="mb-1 _colortext fs-6 _arial">Contraseña</label>
                        <input class="form-control _inputs" type="password" value="" autocomplete="new-password" name="con" id="con">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-4 mx-3">
                        <label for="" class="mb-1 _colortext fs-6 _arial">Repita contraseña</label>
                        <input class="form-control _inputs" type="password" autocomplete="off" name="con1" id="con1">
                    </div>
                </div>
            </div>



            <div class=" d-flex justify-content-center mb-3">
                <input class="btn btn-success" type="submit" name="btnvideo" value="Agregar" id="btnpublicidad">
            </div>
        </form>
    </div>
</div>



<?php
require_once INCLUDES . 'dashboard/inc_footerdash.php';
?>