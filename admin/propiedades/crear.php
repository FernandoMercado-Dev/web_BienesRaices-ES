<?php
    // Autenticación de usuario
    require 'includes/app.php';

    // Usar namespace y crear objeto de la clase
    use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

    // Verificacion de autenticado
    estadoAutenticado();

    $propiedad = new Propiedad;

    // Consulta para obterner los vendedores
    $consulta = " SELECT * FROM vendedores ";
    $resultado = mysqli_query($db, $consulta);

    incluirTemplate('header');

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();



    // Ejecutar el código después de que el usuario envie el formulario
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
            $resultado = $propiedad->guardar();

            // Redireccionar al usuario
            if($resultado) {
                header('Location: /admin?resultado=1');
            }
        }
    }
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error) :  ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" action="/admin/propiedades/crear.php" method="POST" enctype="multipart/form-data">
            <?php include 'includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php 
    incluirTemplate('footer');
?>