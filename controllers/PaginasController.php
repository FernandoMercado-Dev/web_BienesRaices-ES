<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;

class PaginasController {
    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);
        $inicio = true;
        
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        
        $router->render('paginas/nosotros');
    }

    public static function propiedades() {
        echo "Hola ;)";
    }

    public static function propiedad() {
        echo "Hola ;)";
    }

    public static function blog() {
        echo "Hola ;)";
    }

    public static function entrada() {
        echo "Hola ;)";
    }

    public static function contacto() {
        echo "Hola ;)";
    }
}