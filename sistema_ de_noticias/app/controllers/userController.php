<?php

class userController
{
    function __construct()
    {
        $session = Auth::validate();
        if (!$session) {
            Redirect::to('login');
        }
    }

    function index()
    {
        $date = [
            'title' => 'Visualizar Usuarios',
            'id' => 14
        ];

        Views::render('usuarios', $date);

    }

    function new()
    {
        $date = [
            'title' => 'Agregar user',
            'id' => 13
        ];

        Views::render('add', $date);
    }

    function add()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $Contrasena = $_POST["con"];
        $Contrasena2 = $_POST["con1"]; // Reemplaza esto con la contraseña que deseas validar

        // Define una expresión regular que verifica los requisitos
        $patron = '/^(?=.*[!@#$%^&*()])(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)\S{8,}$/';

        if (preg_match($patron, $Contrasena)) {
            if ($Contrasena == $Contrasena2) {
                $email = [];
                $addusuarios = new usuarioModel();
                $correos = $addusuarios->selecttodos2();

                foreach ($correos as $key) {
                    $email[] = $key['email'];
                }

                if (in_array($_POST['email'], $email)) {
                    echo json_encode(['error' => 'error', 'msg' => 'El correo ya esta en uso']);
                } else {


                    $addusuarios = new usuarioModel();
                    $addusuarios->nombre = $_POST['nombre'];
                    $addusuarios->apellidos = $_POST['apellidos'];
                    $addusuarios->email = $_POST['email'];
                    $addusuarios->estado = $_POST['estado'];
                    $addusuarios->contrasena = $Contrasena;
                    $addusuarios->rol = $_POST['rol'];
                    $addusuarios->add();
                    echo json_encode(['success' => 'success', 'msg' => 'El usuario ah sido agregado correctamente']);
                }

            } else {
                echo json_encode(['error' => 'error', 'msg' => 'Las contraseñas no son iguales favor de verificar']);
            }
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'La nueva contraseña no comple con los requisitos']);
        }

    }

    function selectuser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $data = new usuarioModel();
        $user = Users::fromSession();
        $data->id = $user->getId();
        $contenido = $data->selecttodos();
        $response = array(
            "data" => $contenido
        );
        print_r(json_encode($response));
    }

    function veruser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $iddata = $_POST['iddata'];
        $mostrar = new usuarioModel();
        $mostrar->id = $iddata;
        $array = $mostrar->select();
        echo json_encode($array);
    }

    function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        if (empty($_POST['nombre'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El nombre esta vacio']);
            exit;
        }
        if (empty($_POST['apellidos'])) {
            echo json_encode(['error' => 'error', 'msg' => 'Los apellidos estan vacios']);
            exit;
        }
        if (empty($_POST['rol'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El rol esta vacio']);
            exit;
        }
        if (empty($_POST['estado'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El estado esta vacio']);
            exit;
        }




        $data = new usuarioModel();
        $data->id = $_POST['idu'];
        $data->nombre = $_POST['nombre'];
        $data->apellidos = $_POST['apellidos'];
        $data->estado = $_POST['estado'];
        $data->rol = $_POST['rol'];

        if ($data->update()) {
            echo json_encode(['success' => 'success', 'msg' => 'Usuario agregado correctamente']);
        } else {
            echo json_encode(['error' => 'erorr', 'msg' => 'No se ah podido agregar el usuario']);
        }


    }

    function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $idcont = $_POST["eliminaruser"];

        $contenido = new usuarioModel();
        $contenido->id = $idcont;

        if ($contenido->delete()) {
            echo json_encode(['success' => 'success', 'msg' => 'El usuario ah sido eliminado correctamente']);
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'Error al eliminar el usuario']);
        }

    }

    function updatecontra()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        if (empty($_POST['contrasena'])) {
            echo json_encode(['error' => 'error', 'msg' => 'La contraseña actual esta vacia']);
            exit;
        }
        if (empty($_POST['contrasena1'])) {
            echo json_encode(['error' => 'error', 'msg' => 'La contraseña nueva esta vacia']);
            exit;
        }

        $data = new usuarioModel();
        $user = Users::fromSession();
        $data->id = $user->getId();
        $pass = $data->selectcon();
        $contrasenasAnteriores = [];
        foreach ($pass as $key) {
            $contrasenasAnteriores[] = $key['contrasena'];
        }

        if (in_array($_POST['contrasena'], $contrasenasAnteriores)) {
            $nuevaContrasena = $_POST["contrasena1"]; // Reemplaza esto con la contraseña que deseas validar

            // Define una expresión regular que verifica los requisitos
            $patron = '/^(?=.*[!@#$%^&*()])(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)\S{8,}$/';

            if (preg_match($patron, $nuevaContrasena)) {
                $data->contrasena = $nuevaContrasena;
                $data->contraupdate();
                echo json_encode(['success' => 'success', 'msg' => 'La contraseña actualizada correctamente']);
            } else {
                echo json_encode(['error' => 'error', 'msg' => 'La nueva contraseña no comple con los requisitos']);
            }
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'La contraseña actual no coinside']);
        }

    }

    function myuser()
    {
        $date = [
            'title' => 'Configuracion Usuario',
            'id' => 14
        ];

        Views::render('miusuario', $date);

    }

    function vermyuser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        $data = new usuarioModel();
        $user = Users::fromSession();
        $data->id = $user->getId();
        $contenido = $data->select();
        print_r(json_encode($contenido));

    }

    function actconfig()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        if (empty($_POST['nombre2'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El nombre esta vacia']);
            exit;
        }
        if (empty($_POST['apellidos2'])) {
            echo json_encode(['error' => 'error', 'msg' => ' apellidos estan vacios']);
            exit;
        }





        $data = new usuarioModel();
        $data->nombre = $_POST['nombre2'];
        $data->apellidos = $_POST['apellidos2'];
        $user = Users::fromSession();
        $data->id = $user->getId();

        if ($data->myupdate()) {
            echo json_encode(['success' => 'success', 'msg' => 'Usuario actualizado correctamente']);
        } else {
            echo json_encode(['error' => 'erorr', 'msg' => 'No se ah podido actualizar el usuario']);
        }

    }

    function updatecontra2()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        if (empty($_POST['contrasena'])) {
            echo json_encode(['error' => 'error', 'msg' => 'La contraseña actual esta vacia']);
            exit;
        }
        if (empty($_POST['contrasena1'])) {
            echo json_encode(['error' => 'error', 'msg' => 'La contraseña nueva esta vacia']);
            exit;
        }

        $data = new usuarioModel();
        $data->id = $_POST['idc'];
        $pass = $data->selectcon();
        $contrasenasAnteriores = [];
        foreach ($pass as $key) {
            $contrasenasAnteriores[] = $key['contrasena'];
        }

        if (in_array($_POST['contrasena'], $contrasenasAnteriores)) {
            $nuevaContrasena = $_POST["contrasena1"]; // Reemplaza esto con la contraseña que deseas validar

            // Define una expresión regular que verifica los requisitos
            $patron = '/^(?=.*[!@#$%^&*()])(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)\S{8,}$/';

            if (preg_match($patron, $nuevaContrasena)) {
                $data->contrasena = $nuevaContrasena;
                $data->contraupdate();
                echo json_encode(['success' => 'success', 'msg' => 'La contraseña actualizada correctamente']);
            } else {
                echo json_encode(['error' => 'error', 'msg' => 'La nueva contraseña no comple con los requisitos']);
            }
        } else {
            echo json_encode(['error' => 'error', 'msg' => 'La contraseña actual no coinside']);
        }

    }

    function updatecorreo()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        if (empty($_POST['email3'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El correo esta vacio']);
            exit;
        }


        $email = [];
        $addusuarios = new usuarioModel();
        $correos = $addusuarios->selecttodos2();

        foreach ($correos as $key) {
            $email[] = $key['email'];
        }

        if (in_array($_POST['email3'], $email)) {
            echo json_encode(['error' => 'error', 'msg' => 'El correo ya esta en uso']);
        } else {
            $data = new usuarioModel();
            $data->email = $_POST['email3'];
            $user = Users::fromSession();
            $data->id = $user->getId();

            if ($data->myupdatecorreo()) {
                echo json_encode(['success' => 'success', 'msg' => 'Usuario actualizado correctamente']);
            } else {
                echo json_encode(['error' => 'erorr', 'msg' => 'No se ah podido actualizar el usuario']);
            }
        }
    }

    function updatecorreo2()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }

        if (empty($_POST['email3'])) {
            echo json_encode(['error' => 'error', 'msg' => 'El correo esta vacio']);
            exit;
        }


        $email = [];
        $addusuarios = new usuarioModel();
        $correos = $addusuarios->selecttodos2();

        foreach ($correos as $key) {
            $email[] = $key['email'];
        }

        if (in_array($_POST['email3'], $email)) {
            echo json_encode(['error' => 'error', 'msg' => 'El correo ya esta en uso']);
        } else {
            $data = new usuarioModel();
            $data->email = $_POST['email3'];
            $data->id = $_POST['ida'];

            if ($data->myupdatecorreo()) {
                echo json_encode(['success' => 'success', 'msg' => 'Usuario actualizado correctamente']);
            } else {
                echo json_encode(['error' => 'erorr', 'msg' => 'No se ah podido actualizar el usuario']);
            }
        }
    }
}
