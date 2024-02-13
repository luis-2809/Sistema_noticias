<?php
require_once INCLUDES . 'dashboard/inc_headerdash.php';
?>
<div style="">
    <h2 class="_arial _colortext my-2 mx-2">CONFIGURACIONES DE MI PERFIL</h2>
</div>

<div class="_arial _colortext container-fluid _contenddark rounded-3 py-2">
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="mb-3 mx-3">
                <label for=""><b>Nombre:</b></label><br>
                <span id="nombre"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 mx-3">
                <label for=""><b>Apellidos:</b></label><br>
                <span id="apellidos"></span>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="mb-3 mx-3">
                <label for=""><b>Email:</b></label><br>
                <span id="email"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 mx-3">
                <label for=""><b>Rol:</b></label><br>
                <span id="rol"></span>
            </div>
        </div>
    </div>
    <div class="row mt-3 mb-1">
        <div class="col-sm-6">
            <div class="mb-3 mx-3">
                <label for=""><b>Estado:</b></label><br>
                <span id="estado"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 mx-3">
                <label for=""><b>Fecha y hora de registro:</b></label><br>
                <span id="fecha"></span>
            </div>
        </div>
    </div>
    <div>
        <div class=" px-3 mb-5">
            <form action="">
                <input type="hidden" id="iduser">
                <input class="btn btn-success" type="submit" name="" value="Actualizar datos" id="btncontenido3">
            </form>
        </div>
      <hr>

        <div class="row mt-3  mb-1">
            <span class="px-3" id="estado2"> Cambiar correo</span>
        </div>

        <div class="px-3 mb-3">
            <form action="">
                <input type="hidden" id="iduser3">
                <input class="btn btn-danger" type="submit" name="" value="Cambiar correo" id="btncontenido5">
            </form>
        </div>

        <div class="row mt-3  mb-1">
            <span class="px-3" id="estado"> Cambiar contraseña</span>
        </div>

        <div class="px-3 mb-3">
            <form action="">
                <input type="hidden" id="iduser2">
                <input class="btn btn-danger" type="submit" name="" value="Cambiar contraseña" id="btncontenido4">
            </form>
        </div>
    </div>




    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="color:black;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Actualización</h1>
                    <button type="button" id="elclosed" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class=" error" id="errorcontenido2"></div>
                    <div class="" style=" ">
                        <form action="" class="add_contenido _arial" id="formupdate" data-form-id="form-update-user">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="mb-3 mx-3">
                                        <label for=""><b>Nombre:</b></label><br>
                                        <input class="form-control  " type="text" name="nombre2" id="nombre2"
                                            placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 mx-3">
                                        <label for=""><b>Apellidos:</b></label><br>
                                        <input class="form-control " id="apellidos2" name="apellidos2" type="text"
                                            placeholder="Apellidos">
                                    </div>
                                </div>
                            </div>
                           

                            <div class=" d-flex justify-content-center">
                                <input class="btn btn-success" type="submit" name="btncontenido3" value="Actualizar"
                                    id="btncontenido">
                            </div>
                            <div>
                                <input type="hidden" id="idu" name="idu">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="color:black;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Actualizar contraseña</h1>
                    <button type="button" id="ulclosed" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body _arial">
                    <div class="">
                        <div class=" error" id="errorcontenido2"></div>
                        <span class="py-2">La nueva contraseña tiene que tener al menos: </span><br>
                        <span class="py-2">* 1 caracter especial</span><br>
                        <span class="py-2">* 1 letra mayuscula</span><br>
                        <span class="py-2">* 1 letra minuscula</span><br>
                        <span class="py-2">* 1 caracter numerico</span><br>
                        <span class="py-2">* Minimo 8 caracteres</span><br>
                    </div>
                    <div class="" style=" ">
                        <form action="" class="add_contenido _arial" id="formupdatec" data-form-id="form-update-userc">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="mb-3 mx-3">
                                        <label for=""><b>Contraseña Actual:</b></label><br>
                                        <input class="form-control  " type="password" name="contrasena" id="contrasena"
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
                                <input class="btn btn-success" type="submit" name="btncontenido2" value="Actualizar"
                                    id="btncontenido2">
                            </div>
                            <div>
                                <input type="hidden" id="idc" name="idc">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content" style="color:black;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Actualizar correo</h1>
                    <button type="button" id="ucclosed" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body _arial">
                    <div class="">
                        <div class=" error" id="errorcontenido2"></div>
                       
                    </div>
                    <div class="" style=" ">
                        <form action="" class="add_contenido _arial" id="formupdatec2" data-form-id="form-update-userco">
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

<?php
require_once INCLUDES . 'dashboard/inc_footerdash.php';
?>