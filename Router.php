<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    // Llenar el arreglo de rutasGET con las url y funciones asociadas
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }
    
    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if($fn) {
            // La url existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada";
        }
    }

    // Muestra una vista
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            // $$ Variable de la variable (el nombre que este en el array lo usara como nombre de variable)
            $$key = $value;
        }

        // Inicia el almacenamiento en memoria durante un tiempo almacenando lo que se esriba despues en el codigo...
        ob_start();
        include __DIR__ . "/views/$view.php";

        // Limpiamos lo almacenado en la memoria y almacena todo lo anterior en la variable
        $contenido = ob_get_clean();
        // Se carga el master layout y carga la variable dentro de este
        include __DIR__ . "/views/layout.php";
    }
}