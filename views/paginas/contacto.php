<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php  
    if ($mensaje) {
        ?>
            <p class="alerta exito"> <?php echo $mensaje; ?> </p>
        <?php
    }
    ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form action="/contacto" class="formulario" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" require>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" require></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la Propiedad</legend>

            <label for="opciones">Vende o compra</label>
            <select id="opciones" name="contacto[tipo]" require>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[precio]" require>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" require>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" require>
            </div>

            <div id="contacto">

            </div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>