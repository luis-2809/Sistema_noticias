<?php

class buscadorModel extends model
{
    


    public $data;

    public $texto;
    /**
     * buscar noticias y videos
     * @return mixed
     */
    function select()
    {
        $sql = "SELECT contenidoeditorial.id, titulo, 'editorial' AS tipo FROM contenidoeditorial 
                WHERE titulo LIKE :texto UNION SELECT videos.idvideo, titulo, 'video' 
                AS tipo FROM videos WHERE titulo LIKE :texto ;";
        $parametros = [
            'texto' => $this->texto
        ];
        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }

    }
}

