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

        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
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

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);

        $vendedores =  Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        // Método post para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar atributos
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
    
            // Validación
            $errores = $propiedad->validar();
    
            // Generar un nombre único para la imagen
            $nombreImagen = md5(uniqid( rand(), true )) . ".jpg";
    
            // Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                // Instanciar Intervention Image
                $manager = new Image(Driver::class);
                // Leer imagen y escala  imagen
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                // Envio del nombre unico al metodo de la clase propiedad
                $propiedad->setImagen($nombreImagen);
            }
    
            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Almacenar imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
    
                // Insertar en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {

                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}