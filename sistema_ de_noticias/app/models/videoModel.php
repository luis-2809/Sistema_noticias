<?php

class videoModel extends Model
{
    public $id;
    public $idusuario;
    public $titulo;
    public $autor;
    public $descripcion_corta;
    public $img_destacada;
    public $url_video;
    public $estado;
    public $data;

    public $inicio;
    public $registro;

    public $fechavista;
    /**
     * agregar videos 
     * @return mixed
     */
    function add()
    {
        $sql = 'INSERT INTO videos(idusuario,titulo,autor,descripcion_corta,img_destacada,url_video,estado) 
                VALUES (:idusuario,:titulo,:autor,:descripcion_corta,:img_destacada,:url_video,:estado)';
        $parametros = [
            'idusuario' => $this->idusuario,
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'descripcion_corta' => $this->descripcion_corta,
            'img_destacada' => $this->img_destacada,
            'url_video' => $this->url_video,
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
        $sql = "SELECT 
        videos.*,
        CONCAT(usuarios.nombre, ' ', usuarios.apellidos) as usuarios,
        COALESCE(SUM(vistasvideo.vistas), 0) as vistas
    FROM 
        videos
    JOIN 
        usuarios ON usuarios.id = videos.idusuario
    LEFT JOIN 
        vistasvideo ON vistasvideo.idvideo = videos.idvideo
    WHERE 
        videos.idvideo = :id
    GROUP BY 
        videos.idvideo;
    ";
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
        $sql = "SELECT 
        videos.*,
        CONCAT(usuarios.nombre, ' ', usuarios.apellidos) as usuarios_name,
        usuarios.rol,
        COALESCE(SUM(vistasvideo.vistas), 0) as vistas
    FROM 
        videos
    JOIN 
        usuarios ON usuarios.id = videos.idusuario
    LEFT JOIN 
        vistasvideo ON vistasvideo.idvideo = videos.idvideo
    WHERE 
        (usuarios.id = :id AND usuarios.rol = 'usuario') 
        OR EXISTS (SELECT 1 FROM usuarios WHERE id = :id AND rol = 'administrador')
    GROUP BY 
        videos.idvideo;
    ";


        $parametros = [
            'id' => $this->idusuario
        ];
        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
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
        $sql = 'UPDATE videos SET titulo=:titulo,autor=:autor,
        descripcion_corta=:descripcion_corta,img_destacada=:img_destacada,url_video=:url_video,estado=:estado 
        WHERE idvideo=:id';
        $parametros = [
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'descripcion_corta' => $this->descripcion_corta,
            'img_destacada' => $this->img_destacada,
            'estado' => $this->estado,
            'url_video' => $this->url_video,
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
        $sql = 'DELETE FROM videos WHERE idvideo=:id';
        $parametros = [
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selectvideos()
    {
        $sql = "SELECT videos.* FROM videos where estado='activo'  ORDER BY fecha_de_creacion DESC;";

        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selectvideosli()
    {
        $sql = "SELECT videos.* FROM videos  where estado='activo' ORDER BY fecha_de_creacion DESC LIMIT $this->inicio, $this->registro";

        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function videostendencia()
    {

        $sql = "SELECT * FROM videos where estado='activo'
        ORDER BY fecha_de_creacion DESC
        LIMIT 6;";

        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }


    function selectvideosp()
    {
        $sql = "SELECT videos.* FROM videos  where idvideo=:id ;";

        $parametros = [
            'id' => $this->id
        ];

        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selectvista()
    {
        $sql = "SELECT * FROM vistasvideo WHERE idvideo=:id ORDER BY id DESC LIMIT 1;";

        $parametros = [
            'id' => $this->id
        ];

        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function newvista()
    {

        $sql = " INSERT INTO vistasvideo (idvideo, fecha_vista, vistas)
                 VALUES (:idVideo, :fechaActual, 1)
                 ON DUPLICATE KEY UPDATE vistas = vistas + 1;";

        $parametros = [
            'idVideo' => $this->id,
            'fechaActual' => $this->fechavista
        ];

        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selectview2()
    {
        $sql = "SELECT SUM(vistas) AS total FROM vistasvideo WHERE idvideo = :id ";

        $parametros = [
            'id' => $this->id
        ];

        try {
            return ($this->data = parent::querry($sql, $parametros)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }


    function selectgrafix()
    {
        $sql = "SELECT YEAR(fecha_vista) as anio, MONTH(fecha_vista) as mes, COUNT(*) as total FROM vistasvideo GROUP BY anio, mes;";


        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function deletemeses()
    {
        $sql = 'DELETE FROM videos  WHERE `fecha_de_creacion` < DATE_SUB(NOW(), INTERVAL 3 MONTH);';
        
        try {
            return (parent::querry($sql) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }

}

