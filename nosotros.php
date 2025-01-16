<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem, nobis. Sunt explicabo consequuntur, natus enim dolore ad hic officia voluptas sed facilis unde libero soluta laborum ipsum laboriosam reprehenderit aut? Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam quam, consequatur et animi laborum. Veniam officiis quos, placeat explicabo dignissimos, eos accusamus praesentium tempora sequi magnam temporibus. Iusto, eveniet?</p>

                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam veritatis ab animi in porro, architecto temporibus impedit atque beatae iure explicabo? Adipisci, laborum sed. Accusamus in fuga qui dignissimos laudantium?</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Voluptatem adipisci error sequi magnam vel atque deleniti tempore! Corporis, illo, aliquam perferendis debitis hic, corrupti fugit porro optio provident animi pariatur.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Voluptatem adipisci error sequi magnam vel atque deleniti tempore! Corporis, illo, aliquam perferendis debitis hic, corrupti fugit porro optio provident animi pariatur.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Voluptatem adipisci error sequi magnam vel atque deleniti tempore! Corporis, illo, aliquam perferendis debitis hic, corrupti fugit porro optio provident animi pariatur.</p>
            </div>
        </div>
    </section>


<?php 
    incluirTemplate('footer');
?>