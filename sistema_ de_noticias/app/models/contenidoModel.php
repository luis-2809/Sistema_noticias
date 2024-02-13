<?php

class contenidoModel extends Model
{
    public $id;
    public $idusuario;
    public $titulo;
    public $contenido;
    public $autor;
    public $descripcion_corta;
    public $img_destacada;
    public $estado;
    public $data;

    public $inicio;

    public $registro;

    public $fechavista;

    /**
     * Agregar contenido editorial
     * @return mixed
     */
    function add()
    {
        $sql = 'INSERT INTO contenidoeditorial(idusuario,titulo,contenido,autor,descripcion_corta,img_destacada,estado) 
                VALUES (:idusuario,:titulo,:contenido,:autor,:descripcion_corta,:img_destacada,:estado)';
        $parametros = [
            'idusuario' => $this->idusuario,
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'autor' => $this->autor,
            'descripcion_corta' => $this->descripcion_corta,
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
     * Extraer datos de contenido editorial
     * @return mixed
     */

    function select()
    {
        $sql = "SELECT 
        contenidoeditorial.*,
        CONCAT(usuarios.nombre, ' ', usuarios.apellidos) as usuarios,
        COALESCE(SUM(vistascontenido.vistas), 0) as vistas
    FROM 
        contenidoeditorial
    JOIN 
        usuarios ON usuarios.id = contenidoeditorial.idusuario
    LEFT JOIN 
        vistascontenido ON vistascontenido.idconte = contenidoeditorial.id
    WHERE 
        contenidoeditorial.id = :id
    GROUP BY 
        contenidoeditorial.id;
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
        contenidoeditorial.*, 
        CONCAT(usuarios.nombre, ' ', usuarios.apellidos) as usuarios_name,
        usuarios.rol,
        COALESCE(SUM(vistascontenido.vistas), 0) as vistas
    FROM contenidoeditorial
    JOIN usuarios ON usuarios.id = contenidoeditorial.idusuario
    LEFT JOIN vistascontenido ON vistascontenido.idconte = contenidoeditorial.id
    WHERE (usuarios.id = :id AND usuarios.rol = 'usuario') 
        OR EXISTS (SELECT 1 FROM usuarios WHERE id = :id AND rol = 'administrador')
    GROUP BY contenidoeditorial.id;
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
     * Actualizar datos de tabla contenido
     * @return mixed
     */

    function update()
    {
        $sql = 'UPDATE contenidoeditorial SET titulo=:titulo,contenido=:contenido,autor=:autor,
                   descripcion_corta=:descripcion_corta,img_destacada=:img_destacada,estado=:estado 
                   WHERE id=:id';
        $parametros = [
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'autor' => $this->autor,
            'descripcion_corta' => $this->descripcion_corta,
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
     * Eliminar datos de contenido editorial
     * @return mixed
     */

    function delete()
    {
        $sql = 'DELETE FROM contenidoeditorial WHERE id=:id';
        $parametros = [
            'id' => $this->id
        ];
        try {
            return (parent::querry($sql, $parametros) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }


    function selectcontenido()
    {
        $sql = "SELECT contenidoeditorial.* FROM contenidoeditorial  where estado='activo' ORDER BY fecha_de_creacion DESC;";

        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selectcontenidoli()
    {
        $sql = "SELECT contenidoeditorial.* FROM contenidoeditorial where estado='activo' ORDER BY fecha_de_creacion DESC LIMIT $this->inicio, $this->registro";

        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function contenidotendencia()
    {

        $sql = "SELECT * FROM contenidoeditorial where estado='activo'
        ORDER BY fecha_de_creacion DESC
        LIMIT 6;";

        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function selectcontenidosp()
    {
        $sql = "SELECT contenidoeditorial.* FROM contenidoeditorial  where id=:id ;";

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
        $sql = "SELECT * FROM vistascontenido WHERE idconte=:id ORDER BY id DESC LIMIT 1;";

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

        $sql = " INSERT INTO vistascontenido (idconte, fecha_vista, vistas)
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
        $sql = "SELECT SUM(vistas) AS total FROM vistascontenido WHERE idconte = :id ";

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
        $sql = "SELECT YEAR(fecha_vista) as anio, MONTH(fecha_vista) as mes, COUNT(*) as total FROM vistascontenido GROUP BY anio, mes;";


        try {
            return ($this->data = parent::querry($sql)) ? $this->data : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function deletemeses()
    {
        $sql = 'DELETE FROM contenidoeditorial  WHERE `fecha_de_creacion` < DATE_SUB(NOW(), INTERVAL 3 MONTH);';
        
        try {
            return (parent::querry($sql) ? true : false);
        } catch (Exception $e) {
            throw $e;
        }
    }



}