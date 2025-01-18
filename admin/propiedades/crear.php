<?php
    // Base de datos

    require 'includes/config/database.php';
    $db = conectarDB();


    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <form class="formulario" action="/admin/propiedades/crear.php" method="POST">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

                <label for="estacionamietno">Estacionamietno:</label>
                <input type="number" id="estacionamietno" name="estacionamietno" placeholder="Ej: 3" min="1" max="9">
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