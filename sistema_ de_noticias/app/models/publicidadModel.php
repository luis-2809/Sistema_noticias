<?php

class publicidadModel extends Db
{
    public $id;
    public $idusuario;
    public $titulo;
    public $descripcion;
    public $empresa;
    public $img_destacada;
    public $estado;
    public $fecha_de_creacion;
    public $fecha_actualizacion;
    public $data;

     /**
     * agregar publicidad 
     * @return mixed
     */
    function add()
    {
        $sql = 'INSERT INTO publicidad(idusuario,titulo,descripcion,empresa,img_destacada,estado) 
                VALUES (:idusuario,:titulo,:descripcion,:empresa,:img_destacada,:estado)';
        $parametros = [
            'idusuario' => $this->idusuario,
            'titulo' => $this->titulo,
            'descripcion'=> $this->descripcion,
            'empresa'=> $this->empresa,
            'img_destacada' => $this->img_destacada,
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
        $sql = "SELECT publicidad.* , CONCAT(usuarios.nombre,' ',usuarios.apellidos) as usuarios FROM publicidad, usuarios
                WHERE publicidad.idusuario = usuarios.id and idpublicidad=:id";
        $parametros = [
            'id' => $this->id
        ];
        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    function selecttodos()
    {
        $sql = "SELECT publicidad.*, CONCAT(usuarios.nombre, ' ', usuarios.apellidos) as usuarios_name ,usuarios.rol 
        FROM publicidad JOIN usuarios ON usuarios.id = publicidad.idusuario WHERE (usuarios.id =:id AND usuarios.rol = 'usuario') 
        OR EXISTS (SELECT 1 FROM usuarios WHERE id=:id AND rol = 'administrador')";


        $parametros = [
            'id' => $this->idusuario
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
        $sql = 'UPDATE publicidad SET titulo=:titulo,descripcion=:descripcion_corta,empresa=:empresa,img_destacada=:img_destacada,estado=:estado
        WHERE idpublicidad=:id';
        $parametros = [
            'titulo' => $this->titulo,
            'descripcion_corta' => $this->descripcion,
            'empresa'=> $this->empresa,
            'img_destacada' => $this->img_destacada,
            'estado' => $this->estado,
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
        $sql = 'DELETE FROM publicidad WHERE idpublicidad=:id';
        $parametros = [
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function publicidadli()
    {
        $sql = "SELECT * FROM publicidad where estado='activo' ORDER BY RAND() LIMIT 5";
       
        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
