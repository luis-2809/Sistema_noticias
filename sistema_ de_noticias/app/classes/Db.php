<?php

class Db
{
    private $link;
    private $engine;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $charset;

    /**
     * Contructor para la clase
     */
    public function __construct()
    {
        $this->engine = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->name = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->user = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass = IS_LOCAL ? LDB_PASS : DB_PASS;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;

        //  return $this;  retorna para trabajar de  manera consistente
    }

    /**
     * Metodo para abrir una coneccion a la base de datos }
     * 
     * @return  PDO 
     * 
     */
    private function conec(): PDO
    {
        try {
            $this->link = new PDO($this->engine . ':host=' . $this->host . ';dbname=' . $this->name . ';charset=' . $this->charset, $this->user, $this->pass);
            return $this->link;
        } catch (PDOException $e) {
            die(sprintf('no hay conexion a la base de datos, hubo un error: %s', $e->getMessage()));
        }

    }

    /**
     * Metodo para aser un query ala base de datos 
     * 
     * @param string $sql
     * @param  array $params 
     * @return bool|array|int|string
     * 
     */
    public static function querry($sql, $params = [])
    {
        $db = new self();
        $link = $db->conec(); // muestra la conexion ala base de datos

        // Detecta si es una operacion DLL
        $isDDL = (strpos($sql, 'ALTER TABLE') !== false) ||
            (strpos($sql, 'DROP TABLE') !== false);

        // Si no es DLL Comienza una transision 
        if (!$isDDL) {
            $link->beginTransaction(); // check point
        }

        $query = $link->prepare($sql);

        // manejando errores en el query o la peticion ala base de datos 
        if (!$query->execute($params)) {
            $link->rollback();
            $error = $query->errorinfo();
            // index 0 es el tipo de error
            // index 1 es el codigo de error 
            // index 2 es el mensaje de error
            throw new Exception($error[2]);
        }

        // SELECT / INSERT / UPDATE / DELETE    
        //manejado el tipo de query
        if (strpos($sql, 'SELECT') !== false) {
            return $query->rowCount() > 0 ? $query->fetchAll() : false;

        } elseif (strpos($sql, 'INSERT') !== false) {
            $id = $link->lastInsertId();
            $link->commit();
            return $id;
        } elseif (strpos($sql, 'UPDATE') !== false) {
            $link->commit();
            return true;
        } elseif (strpos($sql, 'DELETE') !== false) {

            if ($query->rowCount() > 0) {
                $link->commit();
                return true;
            }

            $link->rollBack();
            return false; // nada a sido borrado 
        } else {
            // ALTER TABLE / DROP TABLE
            if (!$isDDL) {
                $link->commit();
            }
            return true;
        }

    }
}