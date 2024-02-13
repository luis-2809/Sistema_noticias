<?php
require_once INCLUDES . 'login/inc_headerlog.php'
    ?>
<div class="main-container _loginbackground ">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="_logincolor rounded-5 _logintextinput">
            <div class="d-flex justify-content-center mb-2">
                <img class="_loginimg img-fluid" src="<?php echo IMG . 'logo_gpm_tucanal_periodico.png' ?>"
                    alt="ico-login">
            </div>
            <div class="text-center _logintext fw-bold _logintxttittle  mb-3">INICIAR SESIÓN</div>
            <form id="formlogin" class="formlogin" data-form-id="formlogin" name="formlogin" action="">

                <div class="error"><span id="errorcredencial"></span></div>
                <div class="input-group p-2">
                    <div class="input-group-text _logindivico">
                        <i class="bi bi-person-fill _loginicoinput"></i>
                    </div>
                    <input class="form-control _logininput" type="email" name="correo" id="correo"
                        placeholder="Correo " autocomplete="off">
                </div>
                <div class="error" id="erroremail"></div>
                <div class="input-group p-2">
                    <div class="input-group-text _logindivico">
                        <i class="bi bi-lock-fill _loginicoinput"></i>
                    </div>
                    <input class="form-control _logininput " autocomplete="off" type="password" id="contrasena" name="contrasena"
                        placeholder="Contraseña">
                </div>
                <div class="error" id="errorcontrasena"></div>
                <div class="d-flex  justify-content-around p-2 flex-md-row mb-3" >
                    <div class="d-flex align-items-center text-white fw-bold gap-1 " >
                        <input style="display: none;" class="form-check-input _logincheck" name="recuerdame" type="checkbox">
                        <div class="pt-1 _logintext" style="display: none;">Recuerdame</div>
                    </div>
                    <div class="pt-1">
                        <a class=" fw-semibold _logintext fst-italic _loginlink" href="#" style="display: none;">Olvidaste tu
                            contraseña</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center _loginbottonper"><input type="submit"
                        class="btn _arial _btnlogin" value="Iniciar Sesión"></div>
            </form>
        </div>
    </div>
</div>

<?php
require_once INCLUDES . 'login/inc_footerlog.php'
    ?>