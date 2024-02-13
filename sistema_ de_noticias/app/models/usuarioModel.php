<?php

class usuarioModel extends Model
{
    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $contrasena;
    public $rol;
    public $estado;
    public $data;
    
	
	/**
     * agregar videos 
     * @return mixed
     */
    function add()
    {
        $sql = 'INSERT INTO usuarios(nombre,apellidos,email,contrasena,rol,estado) 
                VALUES (:nombre,:apellidos,:email,:contrasena,:rol,:estado)';
        $parametros = [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email'=> $this->email,
            'contrasena'=> $this->contrasena,
            'rol' => $this->rol,
            'estado' => $this->estado
        ];
        try {
            return ($this->id = parent::querry($sql, $parametros)) ? $this->id : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retornar datos de los videos 
     * @return mixed
     */
    function select()
    {
        $sql = "SELECT usuarios.*  FROM usuarios where id=:id";
        $parametros = [
            'id' => $this->id
        ];
        try {
            return ($this->data = parent::querry($sql,$parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selecttodos()
    {
        $sql = "SELECT usuarios.*  FROM usuarios where id!=:id";
        $parametros = [
            'id' => $this->id
        ];
        try {
            return ($this->data = parent::querry($sql,$parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selecttodos2()
    {
        $sql = "SELECT usuarios.email  FROM usuarios ";
        
        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selecttodos3()
    {
        $sql = "SELECT usuarios.email  FROM usuarios WHERE id!=:id";
        $parametros = [
            'id' => $this->id
        ];
        try {
            return ($this->data = parent::querry($sql,$parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }


    function selectcon()
    {
        $sql = "SELECT usuarios.contrasena  FROM usuarios where id=:id";
        $parametros = [
            'id' => $this->id
        ];
        try {
            return ($this->data = parent::querry($sql,$parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
   
    /**
     * Acualisa los campos de los videos
     * @return mixed
     */
    function update()
    {
        $sql = 'UPDATE usuarios SET nombre=:nombre,apellidos=:apellidos,rol=:rol,
        estado=:estado WHERE id=:id';
        $parametros = [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'rol' => $this->rol,
            'estado' => $this->estado,
            'id'=> $this->id
        ];
        try {
            return (parent::querry($sql, $parametros)) ? true : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function myupdate()
    {
        $sql = 'UPDATE usuarios SET nombre=:nombre,apellidos=:apellidos WHERE id=:id';
        $parametros = [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros)) ? true : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function contraupdate()
    {
        $sql = 'UPDATE usuarios SET contrasena=:contrasena WHERE id=:id';
        $parametros = [
            'contrasena' => $this->contrasena,
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros)) ? true : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Eliminar datos de videos
     * @return mixed
     */
    function delete()
    {
        $sql = 'DELETE FROM usuarios WHERE id=:id';
        $parametros = [
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualizar correo
     * @return mixed
     */

    function myupdatecorreo() 
    {
         
        $sql = 'UPDATE usuarios SET email=:correo WHERE id=:id';
        $parametros = [
            'correo' => $this->email,
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros)) ? true : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    

    
}