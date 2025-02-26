<main class="contenedor seccion">
    <h1>Crear</h1>
    
    <form class="formulario" action="/admin/propiedades/crear.php" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>
