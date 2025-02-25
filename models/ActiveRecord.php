<?php

namespace Model;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    // Definir la conexión a la DB
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear un nuevo registro
            $this->crear();
        }
    }

    public function crear() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " (";
            // Convertir las llaves de los atributos sanitizados a un string
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' "; 
            // Convertir los valores de los atributos sanitizados a un string
            $query .= join("' , '", array_values($atributos));
            $query .= " ') ";
        // //////////////

        $resultado = self::$db->query($query);
        // Redireccionar al usuario
        if($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 ";
        // //////////////

        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    // Eliminar registro
    public function eliminar() {
        $query = " DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    // Encargado de iterar cada atributo; identificando y uniendo los atributos de la DB
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Encargado de Sanitizar la iteración
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        // iterar atributos entre llave y valor (['titulo'] => Casa en la playa)
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {

        static::$errores = [];
        return static::$errores;
    }

    // Subida de archivos
    public function setImagen($imagen) {
        // Eliminar imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Eliminar archivo
    public function borrarImagen() {
        // Comprobar si hay imagen
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // **** Lista todas las propiedades y cambio de arreglo a objeto ****
    // // Crear query
    public static function all() {
        $query = " SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtener determinado número de registros
    public static function get($cantidad) {
        $query = " SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Buscar registro por ID
    public static function find($id) {
        $query = " SELECT * FROM " . static::$tabla . " WHERE id = {$id} ";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    // Consulta a la DB
    public static function consultarSQL($query) {
        // Consultar la DB
        $resultado = self::$db->query($query);

        // Iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // // Cambiar el array de la DB a un objeto
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios del usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}