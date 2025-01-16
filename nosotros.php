<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="build/img/logo.svg" alt="logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="icono menuresponsive">
                </div>

                <div class="derecha">
                    <img src="build/img/dark-mode.svg" class="dark-mode-boton">

                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>
            </div> 
            <!-- .barra -->
        </div>
    </header>

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

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados 2024 &copy;</p>
    </footer>


    <script src="build/js/bundle.min.js"></script>
</body>
</html>