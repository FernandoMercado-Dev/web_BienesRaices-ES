<?php include 'includes/templates/header.php' ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem, nobis. Sunt explicabo consequuntur, natus enim dolore ad hic officia voluptas sed facilis unde libero soluta laborum ipsum laboriosam reprehenderit aut? Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam quam, consequatur et animi laborum. Veniam officiis quos, placeat explicabo dignissimos, eos accusamus praesentium tempora sequi magnam temporibus. Iusto, eveniet?</p>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam veritatis ab animi in porro, architecto temporibus impedit atque beatae iure explicabo? Adipisci, laborum sed. Accusamus in fuga qui dignissimos laudantium?</p>
        </div>
    </main>

<?php include 'includes/templates/footer.php' ?>