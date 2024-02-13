<?php

class imgModel extends Model
{

    public $id;
    public $idcontenido;
    public $ruteimg;
    public $data;
    
    public $user;

    function add()
    {
        $sql = 'INSERT INTO imgcontenido(idcontenido,ruteimg) VALUES (:idcontenido,:ruteimg)';
        $parametros = [
            'idcontenido' => $this->idcontenido,
            'ruteimg' => $this->ruteimg
        ];
        try {
            return ($this->id = (parent::querry($sql, $parametros)) ? $this->id : false);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function select()
    {
        $sql = "SELECT * FROM imgcontenido WHERE imgcontenido.idcontenido =:id";
        $parametros = [
            'id' => $this->idcontenido
        ];
        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : [];
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    function delete()
    {
        $sql = 'DELETE FROM imgcontenido WHERE idcontenido=:id and ruteimg=:ruta';
        $parametros = [
            'id' => $this->idcontenido,
            'ruta'=>$this->ruteimg
        ];
        try {
            return (parent::querry($sql, $parametros) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }
   
}