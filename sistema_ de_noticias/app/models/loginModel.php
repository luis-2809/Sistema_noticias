<?php

class loginModel extends Model
{

    private $correo;
    private $contrasena;
    private $data;

    public function exist_user($contrasena,$correo)
    {
        $this->contrasena=$contrasena;
        $this->correo=$correo;
        $sql = "SELECT * FROM usuarios WHERE email=:email and contrasena=:contrasena ";
        $parametros = [
            "email" => $this->correo,
            "contrasena" => $this->contrasena
        ];
        try {
            return ($this->data=parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function getOldestAdminUser() 
    {
        $sql = "SELECT * FROM usuarios where rol='administrador'&& estado='activo' ORDER BY fecha_registro ASC LIMIT 1";
       
        try {
            return ($this->data=parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    
   

}