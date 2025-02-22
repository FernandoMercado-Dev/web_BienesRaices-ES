<?php
    // Autenticación de usuario

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

    require 'includes/app.php';
    estadoAutenticado();

    // Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el código después de que el usuario envie el formulario
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
            $resultado = $propiedad->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error) :  ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include 'includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php 
    incluirTemplate('footer');
?>