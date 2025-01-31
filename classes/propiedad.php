<?php

namespace App;

class Propiedad {
    // Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    // Errores
    protected static $errores = [];


    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    // Definir la conexión a la DB
    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO propiedades (";
            // Convertir las llaves de los atributos sanitizados a un string
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' "; 
            // Convertir los valores de los atributos sanitizados a un string
            $query .= join("' , '", array_values($atributos));
            $query .= " ') ";
        // //////////////

        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Encargado de iterar cada atributo; identificando y uniendo los atributos de la DB
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
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
        return self::$errores;
    }

    public function validar() {

        if(!$this->titulo) {
            self::$errores[] = "Debes de añadir un titulo"; 
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es Obligatorio";
        }

        if( strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen) {
            self::$errores[] = 'La imagen es Obligatoria';
        }

        return self::$errores;
    }

    public function setImagen($imagen) {
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // **** Lista todas las propiedades y cambio de arreglo a objeto ****
    // // Crear query
    public static function all() {
        $query = " SELECT * FROM propiedades ";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Consulta a la DB
    public static function consultarSQL($query) {
        // Consultar la DB
        $resultado = self::$db->query($query);

        // Iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // // Cambiar el array de la DB a un objeto
    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

}