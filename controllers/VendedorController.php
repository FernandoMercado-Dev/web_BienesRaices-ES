<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) {

        $errores = Vendedor::getErrores();

        $vendedor = new Vendedor;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
        
            // Validar campos vacios
            $errores = $vendedor->validar();
        
            // No hay errores
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router) {

        $errores = Vendedor::getErrores();

        $id = validarORedireccionar('/admin');

        // Obterner datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los valores
            $args = $_POST['vendedor'];
        
            // Sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);
        
            // Validación
            $errores = $vendedor->validar();
        
            // Si no hay errores
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }
        
        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar() {
        echo "eliminar Vendedor";
    }
}