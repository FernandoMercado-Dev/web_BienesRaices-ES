<?php
    // Base de datos

    require 'includes/config/database.php';
    $db = conectarDB();

    // Consulta para obterner los vendedores
    $consulta = " SELECT * FROM vendedores ";
    $resultado = mysqli_query($db, $consulta);


    require 'includes/funciones.php';
    incluirTemplate('header');

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamietno = '';
    $vendedorId = '';

    // Ejecutar el código después de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string($db, $_POST['titulo'] ?? '');
        $precio = mysqli_real_escape_string($db, $_POST['precio'] ?? '');
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] ?? '');
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] ?? '');
        $wc = mysqli_real_escape_string($db, $_POST['wc'] ?? '');
        $estacionamietno = mysqli_real_escape_string($db, $_POST['estacionamietno'] ?? '');
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor'] ?? '');
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = "Debes de añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "El precio es Obligatorio";
        }

        if( strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc) {
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamietno) {
            $errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$vendedorId) {
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = 'La imagen es Obligatoria';
        }

        // Validar por tamaño (1 MB máximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy grande';
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) {

            // Subida de archivos

            // Crear carpeta
            $carpetaImagenes = 'imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generar un nombre único
            $nombreImagen = md5(uniqid( rand(), true )) . ".jpg";

            // Subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            // Insertar en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamietno', '$creado', '$vendedorId') ";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario

                header('Location: /admin');
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamietno">Estacionamietno:</label>
                <input type="number" id="estacionamietno" name="estacionamietno" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamietno; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="" selected disabled>-- Selecciona --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php 
    incluirTemplate('footer');
?>