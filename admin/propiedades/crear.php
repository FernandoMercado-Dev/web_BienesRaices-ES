<?php
    // Base de datos

    require 'includes/config/database.php';
    $db = conectarDB();


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

        $titulo = $_POST['titulo'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $habitaciones = $_POST['habitaciones'] ?? '';
        $wc = $_POST['wc'] ?? '';
        $estacionamietno = $_POST['estacionamietno'] ?? '';
        $vendedorId = $_POST['vendedor'] ?? '';

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

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            // Insertar en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamietno', '$vendedorId'); ";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                echo "Insertado Correctamente";
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

        <form class="formulario" action="/admin/propiedades/crear.php" method="POST">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

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
                    <option value="1">Fernando</option>
                    <option value="2">Karen</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php 
    incluirTemplate('footer');
?>