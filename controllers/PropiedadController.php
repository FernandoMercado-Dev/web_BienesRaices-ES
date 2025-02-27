<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropiedadController {
    
    public static function index(Router $router) {

        $propiedades = Propiedad::all();
        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores =  Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único para la imagen
            $nombreImagen = md5(uniqid( rand(), true )) . ".jpg";

            if($_FILES['propiedad']['tmp_name']['imagen']) {
                // Instanciar Intervention Image
                $manager = new Image(Driver::class);
                // Leer imagen y escala  imagen
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                // Envio del nombre unico al metodo de la clase propiedad
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {

                // **SUBIDA DE ARCHIVOS**

                // Revision y creacion de la carpeta de imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en el servidor (proyecto)
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar en DB
                $propiedad->guardar();
            }
        }
        
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar() {
        echo "Actualizar Propiedad";
    }
}