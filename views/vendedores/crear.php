<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error) :  ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" action="/vendedores/crear" method="POST">
        <?php include 'formulario.php' ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>
</main>