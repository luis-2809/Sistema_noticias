<?php 

class Users
{
    private $id;
    private $data;

    // Constructor que recibe el id y los datos del usuario.
    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    // Método para obtener el ID del usuario.
    public function getId()
    {
        return $this->id;
    }

    // Método para obtener un dato específico del usuario.
    public function getData($key)
    {
        return $this->data[$key] ?? null;
    }

    // Método estático para obtener una instancia del usuario a partir de la sesión.
    public static function fromSession()
    {
        if (Auth::validate()) {
            $sessionData = $_SESSION[Auth::SESSION_VAR];
            return new self($sessionData['id'], $sessionData['user']);
        }
        return null;
    }
}
